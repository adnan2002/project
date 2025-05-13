<?php
// api/v1/create_study_group_api.php

header('Content-Type: application/json');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../db/config.php';
date_default_timezone_set('Asia/Bahrain');

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(405, ['status' => 'error', 'error' => 'Method Not Allowed.']);
}

if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'error' => 'Unauthorized. You must be logged in to create a group.']);
}
$leaderId = (int)$_SESSION['user_id'];

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid JSON input.']);
}

// --- Validate Input Data ---
$courseCode = $input['course_code'] ?? '';
$title = trim($input['title'] ?? '');
$description = trim($input['description'] ?? '');
$maxMembersInput = trim($input['max_members'] ?? '');
$startTime = $input['start_time'] ?? ''; // Expects HH:MM
$endTime = $input['end_time'] ?? '';     // Expects HH:MM
$daySchedule = $input['day_schedule'] ?? '';
$location = trim($input['location'] ?? '');

// Basic required field check
if (empty($courseCode) || empty($title) || empty($description) || empty($startTime) || empty($endTime) || empty($daySchedule)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Missing required fields. Course, Title, Description, Start/End Times, and Day Schedule are mandatory.']);
}

// Title validation
if (!preg_match('/^.{5,255}$/', $title)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Title must be between 5 and 255 characters.']);
}

// Description already checked above
if (empty($description)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Description cannot be empty.']);
}

// Max members
$maxMembers = null;
if (!empty($maxMembersInput)) {
    if (!filter_var($maxMembersInput, FILTER_VALIDATE_INT) || (int)$maxMembersInput < 2) {
        sendJsonResponse(400, ['status' => 'error', 'error' => 'Max members must be an integer of at least 2, or leave blank for unlimited.']);
    }
    $maxMembers = (int)$maxMembersInput;
}

// Time validation
$timePattern = '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
if (!preg_match($timePattern, $startTime) || !preg_match($timePattern, $endTime)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid start or end time format. Use HH:MM.']);
}
if (strtotime($endTime) <= strtotime($startTime)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'End time must be after start time.']);
}

// Day schedule validation
$validDays = [
    'Every Sunday', 'Every Monday', 'Every Tuesday', 'Every Wednesday',
    'Every Thursday', 'Every Friday', 'Every Saturday',
    'Weekdays', 'Weekends'
];
if (!in_array($daySchedule, $validDays)) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Invalid day schedule selected.']);
}

// Location length check
if (!empty($location) && strlen($location) > 255) {
    sendJsonResponse(400, ['status' => 'error', 'error' => 'Location cannot exceed 255 characters.']);
}
$location = !empty($location) ? $location : null;

// --- DB Insert Logic ---
$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
    $pdo->beginTransaction();

    // Verify course code exists
    $stmtCheckCourse = $pdo->prepare("SELECT 1 FROM courses WHERE course_code = :course_code");
    $stmtCheckCourse->bindParam(':course_code', $courseCode, PDO::PARAM_STR);
    $stmtCheckCourse->execute();
    if ($stmtCheckCourse->fetchColumn() === false) {
        $pdo->rollBack();
        sendJsonResponse(404, ['status' => 'error', 'error' => 'Selected course code does not exist.']);
    }

    // Insert into study_groups
    $sqlInsertGroup = "INSERT INTO study_groups 
        (leader_id, course_code, title, description, max_members, start_time, end_time, day_schedule, location, created_at) 
        VALUES 
        (:leader_id, :course_code, :title, :description, :max_members, :start_time, :end_time, :day_schedule, :location, NOW())";
    
    $stmtInsertGroup = $pdo->prepare($sqlInsertGroup);
    $stmtInsertGroup->bindParam(':leader_id', $leaderId, PDO::PARAM_INT);
    $stmtInsertGroup->bindParam(':course_code', $courseCode, PDO::PARAM_STR);
    $stmtInsertGroup->bindParam(':title', $title, PDO::PARAM_STR);
    $stmtInsertGroup->bindParam(':description', $description, PDO::PARAM_STR);
    $stmtInsertGroup->bindParam(':max_members', $maxMembers, $maxMembers !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
    $stmtInsertGroup->bindParam(':start_time', $startTime, PDO::PARAM_STR);
    $stmtInsertGroup->bindParam(':end_time', $endTime, PDO::PARAM_STR);
    $stmtInsertGroup->bindParam(':day_schedule', $daySchedule, PDO::PARAM_STR);
    $stmtInsertGroup->bindParam(':location', $location, $location !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
    $stmtInsertGroup->execute();

    $newGroupId = $pdo->lastInsertId();

    // Add the leader as a member
    $sqlInsertLeaderAsMember = "INSERT INTO study_group_members (group_id, user_id, joined_at) VALUES (:group_id, :user_id, NOW())";
    $stmtInsertLeader = $pdo->prepare($sqlInsertLeaderAsMember);
    $stmtInsertLeader->bindParam(':group_id', $newGroupId, PDO::PARAM_INT);
    $stmtInsertLeader->bindParam(':user_id', $leaderId, PDO::PARAM_INT);
    $stmtInsertLeader->execute();

    $pdo->commit();

    sendJsonResponse(201, [
        'status' => 'success', 
        'message' => 'Study group created successfully!',
        'group_id' => $newGroupId
    ]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log("Create Study Group API Error: " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Could not create study group due to a server error.']);
}
?>
