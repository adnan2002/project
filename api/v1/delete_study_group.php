<?php // api/v1/delete_study_group.php
header('Content-Type: application/json');
require_once __DIR__ . '/../../db/config.php'; // Ensure this path is correct for your db config
date_default_timezone_set('Asia/Bahrain');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    sendJsonResponse(405, ['status' => 'error', 'message' => 'Invalid request method. Only DELETE requests are accepted.']);
}

if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'message' => 'You must be logged in to delete a study group.']);
}

$group_id = null;
if (isset($_GET['group_id'])) { // Expect group_id as a query parameter for DELETE
    $group_id = filter_var($_GET['group_id'], FILTER_VALIDATE_INT);
}

if (!$group_id) {
    sendJsonResponse(400, ['status' => 'error', 'message' => 'Group ID is required or invalid.']);
}

$current_user_id = (int)$_SESSION['user_id'];
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
if (!empty($db_port)) { // Add port if it's defined and not empty
    $dsn .= ";port={$db_port}";
}
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    // Check if the current user is the leader of the group
    $stmt_check_leader = $pdo->prepare("SELECT leader_id FROM study_groups WHERE group_id = :group_id");
    $stmt_check_leader->bindParam(':group_id', $group_id, PDO::PARAM_INT);
    $stmt_check_leader->execute();
    $group_row = $stmt_check_leader->fetch();

    if (!$group_row) {
        sendJsonResponse(404, ['status' => 'error', 'message' => 'Study group not found.']);
    }

    if ((int)$group_row['leader_id'] !== $current_user_id) {
        sendJsonResponse(403, ['status' => 'error', 'message' => 'You are not authorized to delete this study group.']);
    }

    // Proceed with deletion. ON DELETE CASCADE in your DB schema
    // should handle related records in study_group_members and study_group_comments.
    $stmt_delete = $pdo->prepare("DELETE FROM study_groups WHERE group_id = :group_id AND leader_id = :leader_id");
    $stmt_delete->bindParam(':group_id', $group_id, PDO::PARAM_INT);
    $stmt_delete->bindParam(':leader_id', $current_user_id, PDO::PARAM_INT);
    
    if ($stmt_delete->execute()) {
        if ($stmt_delete->rowCount() > 0) {
            sendJsonResponse(200, ['status' => 'success', 'message' => 'Study group deleted successfully.']);
        } else {
            // Should not happen if leader check passed and group exists, but as a safeguard
            sendJsonResponse(404, ['status' => 'error', 'message' => 'Study group not found or you are not the leader (deletion check failed).']);
        }
    } else {
        sendJsonResponse(500, ['status' => 'error', 'message' => 'Failed to delete study group.']);
    }

} catch (PDOException $e) {
    error_log("API Error (delete_study_group): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'message' => 'Database error while deleting study group.']);
}
?>
