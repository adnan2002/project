<?php
// api/v1/get_study_group_detail.php

header('Content-Type: application/json');

// Ensure session is started (you might have this in header.php or similar)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../db/config.php'; // Your config file
date_default_timezone_set('Asia/Bahrain');    // Your timezone setting

// --- Helper Functions (sendJsonResponse, formatTime, formatCommentTimestamp) ---
// ... (Keep your existing helper functions here) ...
function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

function formatTime($timeStr) {
    if (!$timeStr) return null;
    return date("g:i A", strtotime($timeStr));
}

function formatCommentTimestamp($timestampStr) { // Or your JS equivalent if you fully moved it
    if (!$timestampStr) return 'Some time ago';
    try {
        $date = new DateTime($timestampStr);
        $now = new DateTime();
        $interval = $now->diff($date);
        if ($interval->y > 0) return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
        if ($interval->m > 0) return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        if ($interval->d > 0) return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
        if ($interval->h > 0) return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        if ($interval->i > 0) return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
        return 'Just now';
    } catch (Exception $e) {
        return 'Some time ago';
    }
}


// --- API Logic ---

if (!isset($_GET['group_id']) || !is_numeric($_GET['group_id'])) {
    sendJsonResponse(400, ['error' => 'Group ID is required and must be numeric.']);
}
$groupId = (int)$_GET['group_id'];

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    // ... (Your existing code to fetch $groupDetails) ...
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
        sendJsonResponse(404, ['error' => 'Study group not found.']);
    }
    $groupDetails['start_time_formatted'] = formatTime($groupDetails['start_time']);
    $groupDetails['end_time_formatted'] = formatTime($groupDetails['end_time']);
    $groupDetails['meeting_time_range'] = $groupDetails['start_time_formatted'] . ' - ' . $groupDetails['end_time_formatted'];


    // ... (Your existing code to fetch $members) ...
    // Ensure this query correctly counts members from study_group_members
    $sqlMembers = "SELECT u.user_id, u.first_name, u.last_name 
                   FROM study_group_members sgm
                   JOIN users u ON sgm.user_id = u.user_id
                   WHERE sgm.group_id = :group_id
                   ORDER BY sgm.joined_at ASC";
    $stmtMembers = $pdo->prepare($sqlMembers);
    $stmtMembers->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtMembers->execute();
    $members = $stmtMembers->fetchAll();
    $groupDetails['members_count'] = count($members); // This is the count of actual joined members


    // ... (Your existing code to fetch $comments) ...
    // If you moved time_ago formatting to JS, remove it from here
    $sqlComments = "SELECT 
                        sc.comment_id, sc.comment_text, sc.helpful_count, 
                        sc.created_at AS comment_created_at, -- Send raw timestamp
                        u.first_name AS commenter_first_name, u.last_name AS commenter_last_name
                    FROM study_group_comments sc
                    JOIN users u ON sc.user_id = u.user_id
                    WHERE sc.group_id = :group_id
                    ORDER BY sc.created_at DESC";
    $stmtComments = $pdo->prepare($sqlComments);
    $stmtComments->bindParam(':group_id', $groupId, PDO::PARAM_INT);
    $stmtComments->execute();
    $comments = $stmtComments->fetchAll();
    // Remove PHP-side time_ago formatting if moved to JS:
    // foreach($comments as &$comment) {
    //     $comment['time_ago'] = formatCommentTimestamp($comment['comment_created_at']);
    // }
    // unset($comment);


    // +++ START OF NEW/MODIFIED SECTION +++
    $isCurrentUserMember = false;
    $currentUserId = null;
    $currentUserFirstName = null;
    $currentUserLastName = null;

    if (isset($_SESSION['user_id'])) {
        $currentUserId = (int)$_SESSION['user_id'];
        $currentUserFirstName = $_SESSION['first_name'] ?? null; // Get from session
        $currentUserLastName = $_SESSION['last_name'] ?? null;   // Get from session

        // Check if the current user is a member (excluding the leader, 
        // as leader status is separate from explicit membership in study_group_members)
        // If the leader is also in study_group_members, this will correctly identify them as a member too.
        if ($groupDetails['leader_id'] != $currentUserId) { // Only check non-leaders here for the join/leave button logic
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
        // Note: The group leader ($groupDetails['leader_id']) is implicitly part of the group
        // and should not see a "Join/Leave" button in the same way. The frontend will handle this.
    }
    // +++ END OF NEW/MODIFIED SECTION +++

    sendJsonResponse(200, [
        'status' => 'success',
        'group_details' => $groupDetails,
        'members' => $members,
        'comments' => $comments,
        'is_current_user_member' => $isCurrentUserMember,     // <-- NEW
        'current_user_id' => $currentUserId,                 // <-- NEW
        'current_user_first_name' => $currentUserFirstName,   // <-- NEW
        'current_user_last_name' => $currentUserLastName     // <-- NEW
    ]);

} catch (PDOException $e) {
    error_log("API Error (get_study_group_detail): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Failed to fetch study group details.']);
}
?>