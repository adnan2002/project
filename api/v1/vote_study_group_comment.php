<?php
// api/v1/vote_study_group_comment.php

header('Content-Type: application/json');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Handle preflight OPTIONS request for CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); 
    exit;
}

require_once __DIR__ . '/../../db/config.php'; // Adjust path as needed

// Set default timezone for consistency (as established)
date_default_timezone_set('Asia/Bahrain');

// --- Helper Function to Send JSON Responses ---
function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

// --- API Logic ---

// 1. Check Request Method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(405, ['status' => 'error', 'error' => 'Method Not Allowed. Only POST requests are accepted.']);
}

// 2. Check User Login Status (Requires Session Started)
if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'error' => 'Unauthorized. You must be logged in to vote.']);
}
$userId = (int)$_SESSION['user_id'];

// 3. Get and Decode JSON Input
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid JSON input: ' . json_last_error_msg()]);
}

// 4. Validate Input Data
$commentId = isset($input['comment_id']) ? filter_var($input['comment_id'], FILTER_VALIDATE_INT) : null;

if (!$commentId) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Comment ID is required and must be a valid integer.']);
}

// 5. Database Connection
$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    error_log("DB Connection Error (vote_study_group_comment): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Database connection failed.']);
}

// 6. Database Operations (within a transaction)
try {
    $pdo->beginTransaction();

    // First, check if the comment itself exists
    $stmtCheckComment = $pdo->prepare("SELECT comment_id FROM study_group_comments WHERE comment_id = :comment_id");
    $stmtCheckComment->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $stmtCheckComment->execute();
    if ($stmtCheckComment->fetch() === false) {
        $pdo->rollBack();
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Comment not found.']);
    }

    // Check if the user has already voted for this comment
    $sqlCheckVote = "SELECT vote_id FROM study_group_comment_helpful_votes 
                     WHERE comment_id = :comment_id AND user_id = :user_id";
    $stmtCheckVote = $pdo->prepare($sqlCheckVote);
    $stmtCheckVote->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $stmtCheckVote->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtCheckVote->execute();
    $existingVote = $stmtCheckVote->fetch();

    if ($existingVote) {
        // User has already voted - remove the vote (unvote)
        $sqlDeleteVote = "DELETE FROM study_group_comment_helpful_votes 
                          WHERE comment_id = :comment_id AND user_id = :user_id";
        $stmtDeleteVote = $pdo->prepare($sqlDeleteVote);
        $stmtDeleteVote->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $stmtDeleteVote->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmtDeleteVote->execute();

        // Decrement helpful_count, ensuring it doesn't go below 0
        $sqlUpdateCount = "UPDATE study_group_comments 
                           SET helpful_count = GREATEST(0, helpful_count - 1) 
                           WHERE comment_id = :comment_id";
        $stmtUpdateCount = $pdo->prepare($sqlUpdateCount);
        $stmtUpdateCount->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $stmtUpdateCount->execute();
        $action = 'unvoted';
    } else {
        // User has not voted - add the vote
        $sqlInsertVote = "INSERT INTO study_group_comment_helpful_votes (comment_id, user_id) 
                          VALUES (:comment_id, :user_id)";
        $stmtInsertVote = $pdo->prepare($sqlInsertVote);
        $stmtInsertVote->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $stmtInsertVote->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmtInsertVote->execute();

        // Increment helpful_count
        $sqlUpdateCount = "UPDATE study_group_comments 
                           SET helpful_count = helpful_count + 1 
                           WHERE comment_id = :comment_id";
        $stmtUpdateCount = $pdo->prepare($sqlUpdateCount);
        $stmtUpdateCount->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $stmtUpdateCount->execute();
        $action = 'voted';
    }

    // Fetch the new helpful_count
    $sqlFetchCount = "SELECT helpful_count FROM study_group_comments WHERE comment_id = :comment_id";
    $stmtFetchCount = $pdo->prepare($sqlFetchCount);
    $stmtFetchCount->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $stmtFetchCount->execute();
    $result = $stmtFetchCount->fetch();
    
    $newHelpfulCount = $result ? (int)$result['helpful_count'] : 0;

    $pdo->commit();

    // 7. Send Success Response
    sendJsonResponse(200, [
        'status' => 'success',
        'action' => $action, // 'voted' or 'unvoted'
        'new_helpful_count' => $newHelpfulCount
    ]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("API Error (vote_study_group_comment): " . $e->getMessage());
    // Check for specific errors like unique constraint violation if a race condition happened (unlikely with this logic but good to be aware)
    // For example, MySQL error code 1062 is for duplicate entry
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to process vote due to a server error.']);
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("General Error (vote_study_group_comment): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'An unexpected error occurred.']);
}
?>