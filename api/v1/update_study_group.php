<?php // api/v1/update_study_group.php
header('Content-Type: application/json');
// Ensure this path is correct for your db config (e.g., ../../db/config.php or ../../config/db.php)
require_once __DIR__ . '/../../db/config.php'; 
date_default_timezone_set('Asia/Bahrain');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    sendJsonResponse(405, ['status' => 'error', 'message' => 'Invalid request method. Only PUT requests are accepted.']);
}

if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'message' => 'You must be logged in to update a study group.']);
}

$input_data = json_decode(file_get_contents('php://input'), true);

if (empty($input_data)) {
    sendJsonResponse(400, ['status' => 'error', 'message' => 'No data provided or invalid JSON.']);
}

// --- Validation ---
$group_id = filter_var($input_data['group_id'] ?? null, FILTER_VALIDATE_INT);
$course_code = trim($input_data['course_code'] ?? '');
$title = trim($input_data['title'] ?? '');
$description = trim($input_data['description'] ?? '');
$max_members_str = trim($input_data['max_members'] ?? '');
$max_members = ($max_members_str === '' || $max_members_str === null) ? null : filter_var($max_members_str, FILTER_VALIDATE_INT, ["options" => ["min_range" => 2]]);

$start_time = trim($input_data['start_time'] ?? '');
$end_time = trim($input_data['end_time'] ?? '');
$day_schedule = trim($input_data['day_schedule'] ?? '');
$location_str = trim($input_data['location'] ?? '');
$location = ($location_str === '' || $location_str === null) ? null : $location_str;


$errors = [];
if (!$group_id) { $errors[] = "Group ID is missing or invalid."; }
if (empty($course_code)) { $errors[] = "Course code is required."; }
if (empty($title) || strlen($title) < 5 || strlen($title) > 255) { $errors[] = "Title must be between 5 and 255 characters.";}
if (empty($description)) { $errors[] = "Description is required."; }

if ($max_members_str !== '' && $max_members_str !== null && $max_members === false) { 
    $errors[] = "Max members must be a number greater than or equal to 2, or blank."; 
}

// Corrected Regex for HH:MM or HH:MM:SS
$time_regex = '/^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/';

if (empty($start_time) || !preg_match($time_regex, $start_time)) { 
    $errors[] = "Start time is required and must be a valid time (HH:MM or HH:MM:SS)."; 
}
if (empty($end_time) || !preg_match($time_regex, $end_time)) { 
    $errors[] = "End time is required and must be a valid time (HH:MM or HH:MM:SS)."; 
}

// Ensure strtotime can parse the time before comparison
if (!empty($start_time) && preg_match($time_regex, $start_time) && 
    !empty($end_time) && preg_match($time_regex, $end_time) && 
    strtotime($start_time) >= strtotime($end_time)) { 
    $errors[] = "End time must be after start time."; 
}

if (empty($day_schedule)) { $errors[] = "Meeting day(s) schedule is required."; }

if ($location_str !== '' && $location_str !== null && strlen($location_str) > 255) { $errors[] = "Location cannot exceed 255 characters."; }


if (!empty($errors)) {
    sendJsonResponse(400, ['status' => 'error', 'message' => implode(' ', $errors), 'errors' => $errors]);
}

$current_user_id = (int)$_SESSION['user_id'];
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

    // Check if current user is the leader
    $stmt_check = $pdo->prepare("SELECT leader_id FROM study_groups WHERE group_id = :group_id");
    $stmt_check->bindParam(':group_id', $group_id, PDO::PARAM_INT);
    $stmt_check->execute();
    $group_db_data = $stmt_check->fetch();

    if (!$group_db_data) {
        sendJsonResponse(404, ['status' => 'error', 'message' => 'Study group not found.']);
    }
    if ((int)$group_db_data['leader_id'] !== $current_user_id) {
        sendJsonResponse(403, ['status' => 'error', 'message' => 'You are not authorized to update this study group.']);
    }

    // Check if course_code exists
    $stmt_course = $pdo->prepare("SELECT course_code FROM courses WHERE course_code = :course_code");
    $stmt_course->bindParam(':course_code', $course_code, PDO::PARAM_STR);
    $stmt_course->execute();
    if ($stmt_course->fetchColumn() === false) {
        sendJsonResponse(400, ['status' => 'error', 'message' => 'Invalid course code selected.']);
    }

    // Prepare update statement
    $sql = "UPDATE study_groups SET 
                course_code = :course_code, 
                title = :title, 
                description = :description, 
                max_members = :max_members, 
                start_time = :start_time, 
                end_time = :end_time, 
                day_schedule = :day_schedule, 
                location = :location
            WHERE group_id = :group_id AND leader_id = :leader_id";

    $stmt_update = $pdo->prepare($sql);
    
    $stmt_update->bindParam(':course_code', $course_code, PDO::PARAM_STR);
    $stmt_update->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt_update->bindParam(':description', $description, PDO::PARAM_STR);
    
    if ($max_members === null) {
        $stmt_update->bindParam(':max_members', $max_members, PDO::PARAM_NULL);
    } else {
        $stmt_update->bindParam(':max_members', $max_members, PDO::PARAM_INT);
    }
    $stmt_update->bindParam(':start_time', $start_time, PDO::PARAM_STR);
    $stmt_update->bindParam(':end_time', $end_time, PDO::PARAM_STR);
    $stmt_update->bindParam(':day_schedule', $day_schedule, PDO::PARAM_STR);
    
    if ($location === null) {
        $stmt_update->bindParam(':location', $location, PDO::PARAM_NULL);
    } else {
        $stmt_update->bindParam(':location', $location, PDO::PARAM_STR);
    }
    $stmt_update->bindParam(':group_id', $group_id, PDO::PARAM_INT);
    $stmt_update->bindParam(':leader_id', $current_user_id, PDO::PARAM_INT);


    if ($stmt_update->execute()) {
        if ($stmt_update->rowCount() > 0) {
            sendJsonResponse(200, ['status' => 'success', 'message' => 'Study group updated successfully.']);
        } else {
            sendJsonResponse(200, ['status' => 'success', 'message' => 'No changes were made to the study group.']);
        }
    } else {
        sendJsonResponse(500, ['status' => 'error', 'message' => 'Failed to update study group.']);
    }

} catch (PDOException $e) {
    error_log("API Error (update_study_group): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'message' => 'Database error while updating study group.']);
}
?>
