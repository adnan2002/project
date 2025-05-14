<?php // api/v1/get_study_group_detail.php

// Ensure session is started for API endpoints that rely on session data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');
require_once __DIR__ . '/../../db/config.php'; // Your config file (defines $db_host, $db_port, $db_name, $db_user, $db_pass)
date_default_timezone_set('Asia/Bahrain');    // Your timezone setting

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

function formatTime($timeStr) {
    if (!$timeStr) return null;
    // Ensure time is treated as such, then format
    $timestamp = strtotime($timeStr);
    if ($timestamp === false) return null; // Invalid time string
    return date("g:i A", $timestamp);
}

// --- API Logic ---

if (!isset($_GET['group_id']) || !is_numeric($_GET['group_id'])) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Group ID is required and must be numeric.']);
}
$groupId = (int)$_GET['group_id'];

// Database connection details from config.php
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
if (isset($db_port) && !empty($db_port)) { // Check if $db_port is defined and not empty
    $dsn .= ";port={$db_port}";
}

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    // Fetch Group Details
    $sqlGroup = "SELECT 
                    sg.group_id, sg.title, sg.description, sg.max_members, sg.leader_id,
                    sg.start_time, sg.end_time, sg.day_schedule, sg.location,
                    sg.course_code, sg.created_at,
                    c.department AS subject_department,
                    u.first_name AS leader_first_name,
                    u.last_name AS leader_last_name
                 FROM study_groups sg
                 JOIN courses c ON sg.course_code = c.course_code
                 JOIN users u ON sg.leader_id = u.user_id
                 WHERE sg.group_id = :group_id";
    $stmtGroup = $pdo->prepare($sqlGroup);
    $stmtGroup->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtGroup->execute();
    $groupDetails = $stmtGroup->fetch();

    if (!$groupDetails) {
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Study group not found.']);
    }

    // Format times and create meeting time range
    $groupDetails['start_time_formatted'] = formatTime($groupDetails['start_time']);
    $groupDetails['end_time_formatted'] = formatTime($groupDetails['end_time']);
    $groupDetails['meeting_time_range'] = ($groupDetails['start_time_formatted'] && $groupDetails['end_time_formatted']) 
                                        ? $groupDetails['start_time_formatted'] . ' - ' . $groupDetails['end_time_formatted']
                                        : 'N/A';

    // Fetch Members and count them
    $sqlMembers = "SELECT u.user_id, u.first_name, u.last_name 
                   FROM study_group_members sgm
                   JOIN users u ON sgm.user_id = u.user_id
                   WHERE sgm.group_id = :group_id
                   ORDER BY sgm.joined_at ASC";
    $stmtMembers = $pdo->prepare($sqlMembers);
    $stmtMembers->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtMembers->execute();
    $members = $stmtMembers->fetchAll();
    $groupDetails['members_count'] = count($members); // Actual count of joined members

    // Fetch Comments (sending raw timestamp for JS formatting)
    $sqlComments = "SELECT 
                        sc.comment_id, sc.comment_text, sc.helpful_count, 
                        sc.created_at AS comment_created_at, 
                        u.first_name AS commenter_first_name, u.last_name AS commenter_last_name
                    FROM study_group_comments sc
                    JOIN users u ON sc.user_id = u.user_id
                    WHERE sc.group_id = :group_id
                    ORDER BY sc.created_at DESC";
    $stmtComments = $pdo->prepare($sqlComments);
    $stmtComments->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtComments->execute();
    $comments = $stmtComments->fetchAll();

    // Determine current user's status regarding the group
    $isCurrentUserMember = false;
    $currentUserId = null;
    $currentUserFirstName = null;
    $currentUserLastName = null;

    if (isset($_SESSION['user_id'])) {
        $currentUserId = (int)$_SESSION['user_id']; // Ensure it's an integer
        $currentUserFirstName = $_SESSION['first_name'] ?? null;
        $currentUserLastName = $_SESSION['last_name'] ?? null;

        // Check if the current logged-in user is explicitly listed as a member
        // This is separate from being the leader.
        $sqlCheckMembership = "SELECT 1 FROM study_group_members 
                               WHERE group_id = :group_id AND user_id = :user_id";
        $stmtCheckMembership = $pdo->prepare($sqlCheckMembership);
        $stmtCheckMembership->bindParam(':group_id', $groupId, PDO::PARAM_INT);
        $stmtCheckMembership->bindParam(':user_id', $currentUserId, PDO::PARAM_INT);
        $stmtCheckMembership->execute();
        if ($stmtCheckMembership->fetchColumn()) {
            $isCurrentUserMember = true;
        }
    }

    // Send the complete response
    sendJsonResponse(200, [
        'status' => 'success',
        'group_details' => $groupDetails,
        'members' => $members,
        'comments' => $comments,
        'is_current_user_member' => $isCurrentUserMember,
        'current_user_id' => $currentUserId,             // This is now correctly populated
        'current_user_first_name' => $currentUserFirstName,
        'current_user_last_name' => $currentUserLastName
    ]);

} catch (PDOException $e) {
    error_log("API Error (get_study_group_detail): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Database error while fetching study group details.']);
}
?>
