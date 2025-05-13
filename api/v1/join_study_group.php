<?php
// api/v1/join_study_group.php

header('Content-Type: application/json');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle preflight OPTIONS request for CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No Content for OPTIONS
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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(405, ['status' => 'error', 'error' => 'Method Not Allowed.']);
}

if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'error' => 'Unauthorized. You must be logged in to join a group.']);
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

    // Check if group exists and get max_members and current member count
    $stmtCheckGroup = $pdo->prepare("
        SELECT sg.group_id, sg.max_members, sg.leader_id, COUNT(sgm.group_member_id) as current_members
        FROM study_groups sg
        LEFT JOIN study_group_members sgm ON sg.group_id = sgm.group_id
        WHERE sg.group_id = :group_id
        GROUP BY sg.group_id
    ");
    $stmtCheckGroup->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtCheckGroup->execute();
    $groupInfo = $stmtCheckGroup->fetch();

    if (!$groupInfo) {
        $pdo->rollBack();
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Study group not found.']);
    }

    // Prevent leader from joining their own group as a regular member via this API
    // (They are implicitly a member by being the leader)
    if ($groupInfo['leader_id'] == $userId) {
         $pdo->rollBack();
         sendJsonResponse(400, ['status' => 'error', 'error' => 'Group leader cannot join as a regular member.']);
    }
    

    if ($groupInfo['max_members'] !== null && $groupInfo['current_members'] >= $groupInfo['max_members']) {
        $pdo->rollBack();
        sendJsonResponse(403, ['status' => 'error', 'error' => 'Study group is full.']);
    }

    // Check if user is already a member
    $stmtCheckMember = $pdo->prepare("SELECT group_member_id FROM study_group_members WHERE group_id = :group_id AND user_id = :user_id");
    $stmtCheckMember->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtCheckMember->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtCheckMember->execute();

    if ($stmtCheckMember->fetch()) {
        $pdo->rollBack();
        sendJsonResponse(409, ['status' => 'error', 'error' => 'You are already a member of this group.']);
    }

    // Add user to group
    $stmtInsert = $pdo->prepare("INSERT INTO study_group_members (group_id, user_id, joined_at) VALUES (:group_id, :user_id, NOW())");
    $stmtInsert->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtInsert->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtInsert->execute();

    // Get new member count
    $stmtNewCount = $pdo->prepare("SELECT COUNT(*) as count FROM study_group_members WHERE group_id = :group_id");
    $stmtNewCount->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtNewCount->execute();
    $newMemberCountResult = $stmtNewCount->fetch();
    $newMemberCount = $newMemberCountResult ? (int)$newMemberCountResult['count'] : $groupInfo['current_members'] + 1;

    // Get current user's info to return to frontend
    $stmtUserInfo = $pdo->prepare("SELECT user_id, first_name, last_name FROM users WHERE user_id = :user_id");
    $stmtUserInfo->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtUserInfo->execute();
    $userInfo = $stmtUserInfo->fetch();
    
    $pdo->commit();

    sendJsonResponse(200, [
        'status' => 'success', 
        'message' => 'Successfully joined the group.',
        'new_member_count' => $newMemberCount,
        'member_info' => $userInfo // Send user info for easy addition to frontend list
    ]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("Join Group API Error: " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Could not join group due to a server error.']);
}
?>