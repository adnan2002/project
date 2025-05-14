<?php
// api/v1/get_course_statistics.php

header('Content-Type: application/json');
require_once __DIR__ . '/../../db/config.php';

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if (!isset($_GET['course_code'])) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'course_code is required.']);
}
$courseCode = $_GET['course_code']; // Basic sanitization below

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    sendJsonResponse(500, ['error' => 'Database connection failed.']);
}

try {
    $stats = [
        'overall_rating_avg' => 0,
        'total_reviews_count' => 0,
        'rating_distribution' => ['5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0],
        'would_take_again_percentage' => 0,
        'difficulty_level_value' => 0,
        'difficulty_level_text' => 'N/A',
    ];

    // Total reviews and average overall rating for the course
    $stmtOverall = $pdo->prepare("SELECT COUNT(review_id) as total_reviews, AVG(overall_rating) as avg_overall_rating FROM course_reviews WHERE course_code = :course_code");
    $stmtOverall->bindParam(':course_code', $courseCode, PDO::PARAM_STR);
    $stmtOverall->execute();
    $overallData = $stmtOverall->fetch();

    if ($overallData && $overallData['total_reviews'] > 0) {
        $stats['total_reviews_count'] = (int)$overallData['total_reviews'];
        $stats['overall_rating_avg'] = round((float)$overallData['avg_overall_rating'], 1); // This is the course overall rating for the header

        // Rating Distribution (percentage)
        $stmtDist = $pdo->prepare("
            SELECT 
                FLOOR(overall_rating) as rating_group, 
                COUNT(review_id) as count
            FROM course_reviews 
            WHERE course_code = :course_code 
            GROUP BY rating_group
        ");
        $stmtDist->bindParam(':course_code', $courseCode, PDO::PARAM_STR);
        $stmtDist->execute();
        $distribution = $stmtDist->fetchAll();
        
        $tempDist = ['5' => 0, '4' => 0, '3' => 0, '2' => 0, '1' => 0];
        foreach ($distribution as $row) {
            $group = min(5, max(1, (int)$row['rating_group'])); // Ensure group is 1-5
            if ($group == 0 && (float)$row['rating_group'] < 1) $group = 1; // handle ratings < 1 if any
             if ($group == 5 && (float)$row['rating_group'] > 4) $group = 5; // handle ratings >= 5
            $tempDist[(string)$group] += (int)$row['count'];
        }
        foreach ($tempDist as $star => $count) {
            $stats['rating_distribution'][$star] = $stats['total_reviews_count'] > 0 ? round(($count / $stats['total_reviews_count']) * 100) : 0;
        }


        // Would take again percentage
        $stmtTakeAgain = $pdo->prepare("SELECT SUM(would_take_again) as yes_count FROM course_reviews WHERE course_code = :course_code");
        $stmtTakeAgain->bindParam(':course_code', $courseCode, PDO::PARAM_STR);
        $stmtTakeAgain->execute();
        $takeAgainData = $stmtTakeAgain->fetch();
        if ($takeAgainData && $stats['total_reviews_count'] > 0) {
            $stats['would_take_again_percentage'] = round(((int)$takeAgainData['yes_count'] / $stats['total_reviews_count']) * 100);
        }

        // Average difficulty
        $stmtAvgDiff = $pdo->prepare("SELECT AVG(difficulty_rating) as avg_difficulty FROM course_reviews WHERE course_code = :course_code");
        $stmtAvgDiff->bindParam(':course_code', $courseCode, PDO::PARAM_STR);
        $stmtAvgDiff->execute();
        $avgDiffData = $stmtAvgDiff->fetch();
        if ($avgDiffData) {
            $avgDifficulty = round((float)$avgDiffData['avg_difficulty'], 1);
            $stats['difficulty_level_value'] = $avgDifficulty;
            if ($avgDifficulty >= 4.0) $stats['difficulty_level_text'] = 'Hard';
            elseif ($avgDifficulty >= 2.5) $stats['difficulty_level_text'] = 'Moderate';
            elseif ($avgDifficulty > 0) $stats['difficulty_level_text'] = 'Easy';
            else $stats['difficulty_level_text'] = 'N/A';
        }
    } else { // No reviews for the course
         sendJsonResponse(200, ['status' => 'success', 'data' => $stats, 'message' => 'No reviews found for this course to calculate statistics.']);
         exit;
    }

    sendJsonResponse(200, ['status' => 'success', 'data' => $stats]);

} catch (PDOException $e) {
    error_log("API Error (get_course_statistics): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Failed to fetch course statistics.']);
}
?>