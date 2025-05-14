<?php
// api/v1/get_other_reviews_for_course.php

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
$courseCode = $_GET['course_code'];

$excludeReviewId = isset($_GET['exclude_review_id']) && filter_var($_GET['exclude_review_id'], FILTER_VALIDATE_INT)
    ? (int)$_GET['exclude_review_id']
    : 0;

$limit = isset($_GET['limit']) && filter_var($_GET['limit'], FILTER_VALIDATE_INT)
    ? (int)$_GET['limit']
    : 2; // Default to 2 other reviews
if ($limit <= 0) $limit = 2;


$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    sendJsonResponse(500, ['error' => 'Database connection failed.']);
}

try {
    $sql = "SELECT
                cr.review_id as id, /* Alias to match mock data 'id' */
                u.first_name AS reviewer_first_name,
                u.last_name AS reviewer_last_name,
                cr.overall_rating as rating, /* Alias to match mock data 'rating' */
                cr.review_text,
                YEAR(cr.created_at) as review_year,
                CASE
                    WHEN MONTH(cr.created_at) BETWEEN 1 AND 5 THEN 'Spring'
                    WHEN MONTH(cr.created_at) BETWEEN 6 AND 8 THEN 'Summer'
                    WHEN MONTH(cr.created_at) BETWEEN 9 AND 12 THEN 'Fall'
                    ELSE ''
                END as review_semester
            FROM course_reviews cr
            JOIN users u ON cr.reviewer_id = u.user_id
            WHERE cr.course_code = :course_code AND cr.review_id != :exclude_review_id
            ORDER BY cr.created_at DESC
            LIMIT :limit";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':course_code', $courseCode, PDO::PARAM_STR);
    $stmt->bindParam(':exclude_review_id', $excludeReviewId, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $otherReviews = $stmt->fetchAll();

    foreach ($otherReviews as &$review) {
        $review['reviewer_name'] = trim($review['reviewer_first_name'] . ' ' . (mb_strlen($review['reviewer_last_name']) > 0 ? mb_substr($review['reviewer_last_name'], 0, 1) . '.' : ''));
        $review['review_term'] = (!empty($review['review_semester']) ? $review['review_semester'] . ' ' : '') . $review['review_year'];
        $review['snippet'] = mb_strimwidth($review['review_text'], 0, 120, "..."); // Snippet for "other reviews"
        unset($review['review_text']); // Don't need full text for snippets
        unset($review['reviewer_first_name']);
        unset($review['reviewer_last_name']);
        unset($review['review_year']);
        unset($review['review_semester']);
    }
    unset($review);

    sendJsonResponse(200, ['status' => 'success', 'data' => $otherReviews]);

} catch (PDOException $e) {
    error_log("API Error (get_other_reviews_for_course): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Failed to fetch other reviews.']);
}
?>