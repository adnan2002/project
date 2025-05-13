<?php
// api/v1/leave_study_group.php

header('Content-Type: application/json');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle preflight OPTIONS request for CORS
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

// --- API Logic ---

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { // Using POST for consistency, could be DELETE
    sendJsonResponse(405, ['status' => 'error', 'error' => 'Method Not Allowed.']);
}

if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'error' => 'Unauthorized. You must be logged in to leave a group.']);
}
$userId = (int)$_SESSION['user_id'];

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid JSON input.']);
}

$groupId = isset($input['group_id']) ? filter_var($input['group_id'], FILTER_VALIDATE_INT) : null;

if (!$groupId) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Group ID is required.']);
}

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    $pdo->beginTransaction();

    // Check if group exists
    $stmtCheckGroup = $pdo->prepare("SELECT leader_id FROM study_groups WHERE group_id = :group_id");
    $stmtCheckGroup->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtCheckGroup->execute();
    $groupInfo = $stmtCheckGroup->fetch();

    if (!$groupInfo) {
        $pdo->rollBack();
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Study group not found.']);
    }
    
    // Prevent leader from leaving their own group via this API
    if ($groupInfo['leader_id'] == $userId) {
        $pdo->rollBack();
        sendJsonResponse(400, ['status' => 'error', 'error' => 'Group leader cannot leave the group. Delete the group instead.']);
    }

    // Remove user from group
    $stmtDelete = $pdo->prepare("DELETE FROM study_group_members WHERE group_id = :group_id AND user_id = :user_id");
    $stmtDelete->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtDelete->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtDelete->execute();

    if ($stmtDelete->rowCount() === 0) {
        $pdo->rollBack();
        sendJsonResponse(404, ['status' => 'error', 'error' => 'You are not a member of this group or group not found.']);
    }
    
    // Get new member count
    $stmtNewCount = $pdo->prepare("SELECT COUNT(*) as count FROM study_group_members WHERE group_id = :group_id");
    $stmtNewCount->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtNewCount->execute();
    $newMemberCountResult = $stmtNewCount->fetch();
    $newMemberCount = $newMemberCountResult ? (int)$newMemberCountResult['count'] : 0;

    $pdo->commit();

    sendJsonResponse(200, [
        'status' => 'success', 
        'message' => 'Successfully left the group.',
        'new_member_count' => $newMemberCount,
        'user_id_left' => $userId 
    ]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("Leave Group API Error: " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Could not leave group due to a server error.']);
}
?>