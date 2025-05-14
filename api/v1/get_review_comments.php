<?php
// api/v1/get_review_comments.php

header('Content-Type: application/json');
require_once __DIR__ . '/../../db/config.php'; // Adjust path as needed
date_default_timezone_set('Asia/Bahrain');


function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if (!isset($_GET['review_id']) || !filter_var($_GET['review_id'], FILTER_VALIDATE_INT)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Valid review_id is required.']);
}
$reviewId = (int)$_GET['review_id'];

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    sendJsonResponse(500, ['error' => 'Database connection failed.']);
}

try {
    // For now, fetching flat comments. Replies would need parent_id logic.
    $sql = "SELECT
                crc.comment_id,
                crc.user_id,
                u.first_name,
                u.last_name,
                crc.comment_text,
                crc.helpful_count,
                crc.created_at
            FROM course_review_comments crc
            JOIN users u ON crc.user_id = u.user_id
            WHERE crc.review_id = :review_id
            ORDER BY crc.created_at ASC"; // Or DESC for newest first

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll();

    $formattedComments = [];
    foreach ($comments as $comment) {
        // To match the mock 'page_comments' structure approximately
        $initials = (mb_strlen($comment['first_name']) > 0 ? mb_substr($comment['first_name'], 0, 1) : '') .
                    (mb_strlen($comment['last_name']) > 0 ? mb_substr($comment['last_name'], 0, 1) : '');
        
        // Calculate time_ago (simplified)
        $created = new DateTime($comment['created_at']);
        $now = new DateTime();
        $interval = $now->diff($created);
        $time_ago = "";
        if ($interval->y) $time_ago = $interval->y . " years ago";
        else if ($interval->m) $time_ago = $interval->m . " months ago";
        else if ($interval->d) $time_ago = $interval->d . " days ago";
        else if ($interval->h) $time_ago = $interval->h . " hours ago";
        else if ($interval->i) $time_ago = $interval->i . " minutes ago";
        else $time_ago = "Just now";


        $formattedComments[] = [
            'id' => $comment['comment_id'], // For keying in JS
            'initials' => strtoupper($initials),
            'name' => trim($comment['first_name'] . ' ' . $comment['last_name']),
            'avatar_bg' => 'bg-gray-400', // Placeholder, generate randomly or based on user ID
            'time_ago' => $time_ago,
            'text' => $comment['comment_text'],
            'helpful_count' => (int)$comment['helpful_count'],
            // 'reply' => [] // Placeholder for actual reply fetching logic if needed
        ];
    }

    sendJsonResponse(200, ['status' => 'success', 'data' => $formattedComments]);

} catch (PDOException $e) {
    error_log("API Error (get_review_comments): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Failed to fetch comments.']);
}
?>