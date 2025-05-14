<?php
// api/v1/get_course_reviews.php

header('Content-Type: application/json');
// session_start(); // Only if needed for auth checks within API, not for this basic fetch

// Assuming db/config.php defines $db_host, $db_port, $db_name, $db_user, $db_pass
require_once __DIR__ . '/../../db/config.php';

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

$itemsPerPage = 3; // Display 3 reviews per page
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1; // Basic sanitization for numeric
if ($currentPage < 1) {
    $currentPage = 1;
}
$offset = ($currentPage - 1) * $itemsPerPage;

// Use variables as defined in your db/config.php (e.g., $db_host, not $db_config['host'])
// The following DSN assumes $db_host, $db_port, $db_name are directly available from config.php
$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Use variables $db_user, $db_pass directly from config.php
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    error_log("DB Connection Error (get_course_reviews): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Database connection failed. Please try again later.']);
}

try {
    $totalStmt = $pdo->query("SELECT COUNT(cr.review_id) FROM course_reviews cr");
    $totalItems = (int)$totalStmt->fetchColumn();
    $totalPages = $totalItems > 0 ? ceil($totalItems / $itemsPerPage) : 0; // Handle no items

    if ($currentPage > $totalPages && $totalItems > 0) {
        $currentPage = $totalPages;
        $offset = ($currentPage - 1) * $itemsPerPage;
    }
    if ($currentPage < 1 && $totalItems > 0) {
        $currentPage = 1;
        $offset = 0;
    }
     if ($totalItems === 0) { // If no items, set current page to 1 and total pages to 0
        $currentPage = 1;
        $totalPages = 0;
    }


    $sql = "SELECT
                cr.review_id,
                cr.course_code,
                c.course_title, /* Fetched from courses table */
                c.department AS course_department,
                cr.reviewer_id,
                u.first_name AS reviewer_first_name, /* Fetched from users table */
                u.last_name AS reviewer_last_name,   /* Fetched from users table */
                cr.difficulty_rating,
                cr.workload_rating,
                cr.overall_rating, /* This is the specific rating for THIS review */
                cr.would_take_again,
                cr.review_text,
                cr.pros,
                cr.cons,
                cr.advice,
                cr.helpful_votes_count,
                cr.created_at,
                YEAR(cr.created_at) as review_year,
                CASE
                    WHEN MONTH(cr.created_at) BETWEEN 1 AND 5 THEN 'Spring'
                    WHEN MONTH(cr.created_at) BETWEEN 6 AND 8 THEN 'Summer'
                    WHEN MONTH(cr.created_at) BETWEEN 9 AND 12 THEN 'Fall'
                    ELSE ''
                END as review_semester
            FROM
                course_reviews cr
            JOIN
                courses c ON cr.course_code = c.course_code
            JOIN
                users u ON cr.reviewer_id = u.user_id
            ORDER BY
                cr.created_at DESC
            LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $courseReviews = $stmt->fetchAll();

    foreach ($courseReviews as &$review) { // Pass by reference to modify
        $review['reviewer_name_full'] = trim($review['reviewer_first_name'] . ' ' . $review['reviewer_last_name']);
        // Short reviewer name like "Thomas L."
        $review['reviewer_name'] = $review['reviewer_first_name'] . ' ' . (mb_strlen($review['reviewer_last_name']) > 0 ? mb_substr($review['reviewer_last_name'], 0, 1) . '.' : '');

        $review['reviewer_term'] = (!empty($review['review_semester']) ? $review['review_semester'] . ' ' : '') . $review['review_year'];
        $review['review_snippet'] = mb_strimwidth($review['review_text'], 0, 150, "...");

        // This represents the rating given in THIS specific review.
        $review['individual_rating'] = $review['overall_rating'];
    }
    unset($review);

    sendJsonResponse(200, [
        'status' => 'success',
        'data' => $courseReviews,
        'pagination' => [
            'currentPage' => (int)$currentPage,
            'totalPages' => (int)$totalPages,
            'itemsPerPage' => (int)$itemsPerPage,
            'totalItems' => (int)$totalItems
        ]
    ]);

} catch (PDOException $e) {
    error_log("API Error (get_course_reviews): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Failed to fetch course reviews. Please try again later.']);
}
?>