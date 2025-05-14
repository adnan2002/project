<?php // api/v1/get_study_group_for_edit.php
header('Content-Type: application/json');

// Corrected path to your database configuration file
// This should match the path used in your working get_courses.php API
require_once __DIR__ . '/../../db/config.php'; 

date_default_timezone_set('Asia/Bahrain');

// Ensure session is started for API endpoints that rely on session data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJsonResponse(405, ['status' => 'error', 'message' => 'Invalid request method. Only GET requests are accepted.']);
}

// Check if user is logged in AFTER attempting to start session
if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(401, ['status' => 'error', 'message' => 'Authentication required. Please log in.']);
}

$group_id_to_fetch = filter_input(INPUT_GET, 'group_id', FILTER_VALIDATE_INT);

if (!$group_id_to_fetch) {
    sendJsonResponse(400, ['status' => 'error', 'message' => 'Group ID is required or invalid.']);
}

$current_user_id = (int)$_SESSION['user_id'];
$study_group_data = null;
// $error_detail = null; // Not used in this version

try {
    // Establish PDO connection 
    // Ensure $db_host, $db_name, $db_user, $db_pass (and optionally $db_port) 
    // are defined in your project/db/config.php file
    $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
    if (isset($db_port) && !empty($db_port)) { // Check if $db_port is defined and not empty
         $dsn .= ";port={$db_port}";
    }
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    $stmt = $pdo->prepare("SELECT group_id, leader_id, course_code, title, description, max_members, start_time, end_time, day_schedule, location FROM study_groups WHERE group_id = :group_id");
    $stmt->bindParam(':group_id', $group_id_to_fetch, PDO::PARAM_INT);
    $stmt->execute();
    $study_group_data = $stmt->fetch();

    if ($study_group_data) {
        if ((int)$study_group_data['leader_id'] !== $current_user_id) {
            sendJsonResponse(403, ['status' => 'error', 'message' => 'You are not authorized to edit this study group.']);
        }
        // If authorized, send the data
        sendJsonResponse(200, ['status' => 'success', 'study_group' => $study_group_data]);
    } else {
        sendJsonResponse(404, ['status' => 'error', 'message' => 'Study group not found.']);
    }

} catch (PDOException $e) {
    error_log("API Error (get_study_group_for_edit): " . $e->getMessage());
    // For security, don't echo detailed DB errors to the client in production
    sendJsonResponse(500, ['status' => 'error', 'message' => 'Database error while fetching group details for editing.']);
}
?>
