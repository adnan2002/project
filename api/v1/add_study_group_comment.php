<?php
// api/v1/add_study_group_comment.php

// IMPORTANT: Ensure session is started. This is usually done in a global header file.
// If not, uncomment the line below or make sure it's called before any output.

header('Content-Type: application/json');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle preflight OPTIONS request for CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No Content for OPTIONS
    exit;
}

require_once __DIR__ . '/../../db/config.php'; // Adjust path as needed

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
// Make sure session_start() is called somewhere before this (e.g., in header.php or config.php)
if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'error' => 'Unauthorized. You must be logged in to comment.']);
}
$userId = $_SESSION['user_id'];

// 3. Get and Decode JSON Input
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true); // Decode as associative array

if (json_last_error() !== JSON_ERROR_NONE) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid JSON input: ' . json_last_error_msg()]);
}

// 4. Validate Input Data
$groupId = isset($input['group_id']) ? filter_var($input['group_id'], FILTER_VALIDATE_INT) : null;
$commentText = isset($input['comment_text']) ? trim($input['comment_text']) : '';

if (!$groupId) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Group ID is required and must be a valid integer.']);
}
if (empty($commentText)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Comment text cannot be empty.']);
}
if (mb_strlen($commentText) > 65535) { // TEXT field limit check (approx)
     sendJsonResponse(400, ['status' => 'error', 'error' => 'Comment text is too long.']);
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
    error_log("DB Connection Error (add_study_group_comment): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Database connection failed.']);
}

// 6. Insert Comment into Database
try {
    // Optional: Verify group_id exists
    $checkGroupSql = "SELECT 1 FROM study_groups WHERE group_id = :group_id";
    $checkStmt = $pdo->prepare($checkGroupSql);
    $checkStmt->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $checkStmt->execute();
    if ($checkStmt->fetchColumn() === false) {
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Study group not found.']);
    }

    // Insert the comment
    $sqlInsert = "INSERT INTO study_group_comments (group_id, user_id, comment_text) 
                  VALUES (:group_id, :user_id, :comment_text)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    
    $stmtInsert->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtInsert->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtInsert->bindParam(':comment_text', $commentText, PDO::PARAM_STR);
    
    $stmtInsert->execute();
    
    $newCommentId = $pdo->lastInsertId();

    // 7. Fetch the newly inserted comment details for the response
    $sqlFetchNew = "SELECT 
                        sc.comment_id,
                        sc.group_id,
                        sc.user_id,
                        sc.comment_text,
                        sc.helpful_count,
                        sc.created_at AS comment_created_at,
                        u.first_name AS commenter_first_name,
                        u.last_name AS commenter_last_name
                    FROM study_group_comments sc
                    JOIN users u ON sc.user_id = u.user_id
                    WHERE sc.comment_id = :comment_id";
    
    $stmtFetchNew = $pdo->prepare($sqlFetchNew);
    $stmtFetchNew->bindParam(':comment_id', $newCommentId, PDO::PARAM_INT);
    $stmtFetchNew->execute();
    $newComment = $stmtFetchNew->fetch();

    if (!$newComment) {
         // Should not happen if insert succeeded, but handle just in case
        sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to retrieve the created comment.']);
    }


    // 8. Send Success Response
    sendJsonResponse(201, [ // 201 Created is appropriate here
        'status' => 'success',
        'message' => 'Comment posted successfully.',
        'comment' => $newComment 
    ]);

} catch (PDOException $e) {
    error_log("API Error (add_study_group_comment): " . $e->getMessage());
    // Check for specific errors like foreign key constraints if needed
    if ($e->getCode() == '23000') { // Integrity constraint violation
         sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid data provided (e.g., non-existent user or group).']);
    } else {
         sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to post comment due to a server error.']);
    }
} catch (Exception $e) {
     error_log("General Error (add_study_group_comment): " . $e->getMessage());
     sendJsonResponse(500, ['status' => 'error', 'error' => 'An unexpected error occurred.']);
}

?>