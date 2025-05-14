<?php
// api/v1/get_review_detail.php

header('Content-Type: application/json');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../db/config.php'; 
date_default_timezone_set('Asia/Bahrain');

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if (!isset($_GET['review_id']) || !filter_var($_GET['review_id'], FILTER_VALIDATE_INT) || ((int)$_GET['review_id'] <= 0) ) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Valid positive review_id is required.']);
}
$reviewId = (int)$_GET['review_id'];
$current_user_id_for_query = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : 0;

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = null; 
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    error_log("FATAL DB Connection Error (get_review_detail): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Database connection failed. Critical error. Check server logs.']);
}

$sql = ""; 
try {
    // Using LEFT JOIN to fetch current user's vote status
    $sql = "SELECT
                cr.review_id,
                cr.course_code,
                c.course_title,
                c.attendance_required AS course_attendance_policy,
                cr.reviewer_id,
                u.first_name AS reviewer_first_name,
                u.last_name AS reviewer_last_name,
                cr.difficulty_rating,
                cr.workload_rating,
                cr.overall_rating AS individual_rating,
                cr.would_take_again,
                cr.review_text,
                cr.pros,
                cr.cons,
                cr.advice,
                cr.helpful_votes_count,
                cr.unhelpful_votes_count,    -- Must exist in 'course_reviews'
                cr.created_at AS review_created_at,
                YEAR(cr.created_at) as review_year,
                CASE
                    WHEN MONTH(cr.created_at) BETWEEN 1 AND 5 THEN 'Spring'
                    WHEN MONTH(cr.created_at) BETWEEN 6 AND 8 THEN 'Summer'
                    WHEN MONTH(cr.created_at) BETWEEN 9 AND 12 THEN 'Fall'
                    ELSE ''
                END as review_semester,
                urv.result AS current_user_vote_result_raw -- Fetches TRUE (1), FALSE (0), or NULL
            FROM
                course_reviews cr
            JOIN
                courses c ON cr.course_code = c.course_code
            JOIN
                users u ON cr.reviewer_id = u.user_id
            LEFT JOIN
                course_review_votes urv ON urv.review_id = cr.review_id AND urv.user_id = :current_user_id -- Table 'course_review_votes' and column 'result' must exist
            WHERE
                cr.review_id = :review_id";

    $stmt = $pdo->prepare($sql);
    // Bind parameters
    $stmt->bindParam(':current_user_id', $current_user_id_for_query, PDO::PARAM_INT);
    $stmt->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    
    $stmt->execute();
    $reviewDetail = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reviewDetail) {
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Review not found for ID: ' . $reviewId]);
    }

    // Process fetched data (same as before)
    $reviewDetail['id'] = (int)$reviewDetail['review_id'];
    $reviewDetail['reviewer_name'] = trim($reviewDetail['reviewer_first_name'] . ' ' . (mb_strlen($reviewDetail['reviewer_last_name']) > 0 ? mb_substr($reviewDetail['reviewer_last_name'], 0, 1) . '.' : ''));
    $reviewDetail['review_term'] = (!empty($reviewDetail['review_semester']) ? $reviewDetail['review_semester'] . ' ' : '') . $reviewDetail['review_year'];
    $reviewDetail['professor_name'] = "Prof. Placeholder"; 
    $reviewDetail['difficulty_value'] = (float)$reviewDetail['difficulty_rating'];
    $reviewDetail['difficulty'] = $reviewDetail['difficulty_value'] >= 4 ? 'Hard' : ($reviewDetail['difficulty_value'] >= 2.5 ? 'Moderate' : 'Easy');
    $reviewDetail['workload_value'] = (float)$reviewDetail['workload_rating'];
    $reviewDetail['workload'] = $reviewDetail['workload_value'] >= 4 ? 'Heavy' : ($reviewDetail['workload_value'] >= 2.5 ? 'Average' : 'Light');
    $reviewDetail['attendance_required'] = (bool)$reviewDetail['course_attendance_policy'];
    $reviewDetail['helpful_yes_count'] = (int)$reviewDetail['helpful_votes_count'];
    $reviewDetail['helpful_no_count'] = (int)$reviewDetail['unhelpful_votes_count'];
    
    $reviewDetail['current_user_vote'] = null;
    if ($current_user_id_for_query > 0 && $reviewDetail['current_user_vote_result_raw'] !== null) {
        $reviewDetail['current_user_vote'] = (bool)$reviewDetail['current_user_vote_result_raw'] ? 'yes' : 'no';
    }
    unset($reviewDetail['current_user_vote_result_raw']);

    sendJsonResponse(200, ['status' => 'success', 'data' => $reviewDetail]);

} catch (PDOException $e) {
    error_log("API SQL Error (get_review_detail): " . $e->getMessage() . " for review_id: " . $reviewId . ". Attempted SQL: " . $sql);
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to fetch review details. Please check server logs for more information.']);
}
?>
