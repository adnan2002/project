<?php
// api/v1/vote_on_review.php

header('Content-Type: application/json');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/../../db/config.php';
date_default_timezone_set('Asia/Bahrain');

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(405, ['status' => 'error', 'error' => 'Method Not Allowed. Only POST requests are accepted.']);
}

if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'error' => 'Unauthorized. You must be logged in to vote.']);
}
$userId = (int)$_SESSION['user_id'];

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid JSON input: ' . json_last_error_msg()]);
}

$reviewId = isset($input['review_id']) ? filter_var($input['review_id'], FILTER_VALIDATE_INT) : null;
$voteType = isset($input['vote_type']) ? strtolower(trim($input['vote_type'])) : null; // 'yes' or 'no'

if (!$reviewId || $reviewId <= 0) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Review ID is required and must be a valid positive integer.']);
}
if ($voteType !== 'yes' && $voteType !== 'no') {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid vote_type. Must be "yes" or "no".']);
}

$newVoteResultBoolean = ($voteType === 'yes'); // TRUE for 'yes', FALSE for 'no'

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    error_log("DB Connection Error (vote_on_review): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Database connection failed.']);
}

try {
    $pdo->beginTransaction();

    $stmtCheckReview = $pdo->prepare("SELECT review_id FROM course_reviews WHERE review_id = :review_id");
    $stmtCheckReview->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    $stmtCheckReview->execute();
    if ($stmtCheckReview->fetch() === false) {
        $pdo->rollBack();
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Review not found.']);
    }

    $sqlCheckVote = "SELECT vote_id, result FROM course_review_votes WHERE review_id = :review_id AND user_id = :user_id";
    $stmtCheckVote = $pdo->prepare($sqlCheckVote);
    $stmtCheckVote->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    $stmtCheckVote->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtCheckVote->execute();
    $existingVote = $stmtCheckVote->fetch();

    $action = '';
    $currentUserVoteStatus = null; // 'yes', 'no', or null if unvoted

    if ($existingVote) {
        $existingVoteResultBoolean = (bool)$existingVote['result'];
        if ($existingVoteResultBoolean === $newVoteResultBoolean) {
            // Unvoting
            $sqlDelete = "DELETE FROM course_review_votes WHERE vote_id = :vote_id";
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->bindParam(':vote_id', $existingVote['vote_id'], PDO::PARAM_INT);
            $stmtDelete->execute();
            $action = $newVoteResultBoolean ? 'unvoted_yes' : 'unvoted_no';
            $currentUserVoteStatus = null; 
        } else {
            // Changing vote
            $sqlUpdate = "UPDATE course_review_votes SET result = :result WHERE vote_id = :vote_id";
            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':result', $newVoteResultBoolean, PDO::PARAM_BOOL);
            $stmtUpdate->bindParam(':vote_id', $existingVote['vote_id'], PDO::PARAM_INT);
            $stmtUpdate->execute();
            $action = $newVoteResultBoolean ? 'changed_to_yes' : 'changed_to_no';
            $currentUserVoteStatus = $newVoteResultBoolean ? 'yes' : 'no';
        }
    } else {
        // New vote
        $sqlInsert = "INSERT INTO course_review_votes (review_id, user_id, result) VALUES (:review_id, :user_id, :result)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
        $stmtInsert->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmtInsert->bindParam(':result', $newVoteResultBoolean, PDO::PARAM_BOOL);
        $stmtInsert->execute();
        $action = $newVoteResultBoolean ? 'voted_yes' : 'voted_no';
        $currentUserVoteStatus = $newVoteResultBoolean ? 'yes' : 'no';
    }

    // Update aggregate counts in course_reviews table
    $stmtYesCount = $pdo->prepare("SELECT COUNT(*) FROM course_review_votes WHERE review_id = :review_id AND result = TRUE");
    $stmtYesCount->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    $stmtYesCount->execute();
    $currentYesCount = (int)$stmtYesCount->fetchColumn();

    $stmtNoCount = $pdo->prepare("SELECT COUNT(*) FROM course_review_votes WHERE review_id = :review_id AND result = FALSE");
    $stmtNoCount->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    $stmtNoCount->execute();
    $currentNoCount = (int)$stmtNoCount->fetchColumn();

    $sqlUpdateCounts = "UPDATE course_reviews SET helpful_votes_count = :yes_count, unhelpful_votes_count = :no_count WHERE review_id = :review_id";
    $stmtUpdateCounts = $pdo->prepare($sqlUpdateCounts);
    $stmtUpdateCounts->bindParam(':yes_count', $currentYesCount, PDO::PARAM_INT);
    $stmtUpdateCounts->bindParam(':no_count', $currentNoCount, PDO::PARAM_INT);
    $stmtUpdateCounts->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    $stmtUpdateCounts->execute();

    $pdo->commit();

    sendJsonResponse(200, [
        'status' => 'success',
        'action' => $action,
        'new_helpful_count' => $currentYesCount,
        'new_unhelpful_count' => $currentNoCount,
        'current_user_vote_status' => $currentUserVoteStatus, // Added for frontend styling
        'review_id' => $reviewId
    ]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("API Error (vote_on_review): " . $e->getMessage() . " for review_id: " . $reviewId);
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to process vote. Please check server logs.']);
}
?>
