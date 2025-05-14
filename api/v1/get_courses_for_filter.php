<?php
// api/v1/get_courses.php

header('Content-Type: application/json');
require_once __DIR__ . '/../../db/config.php'; // Adjust path if needed
date_default_timezone_set('Asia/Bahrain');

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

// --- API Logic ---
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    sendJsonResponse(405, ['status' => 'error', 'error' => 'Method Not Allowed. Only GET requests are accepted.']);
}

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Determine what to fetch based on query parameter
$fetch_type = isset($_GET['fetch_type']) ? $_GET['fetch_type'] : 'all_courses'; // Default to fetching all courses

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    if ($fetch_type === 'departments') {
        // Fetch unique, non-empty, non-null departments from the 'courses' table
        // **IMPORTANT**: Ensure your 'courses' table has a 'department' column.
        // If it's named differently (e.g., 'subject_area', 'faculty'), change the column name below.
        $stmt = $pdo->query("SELECT DISTINCT department 
                             FROM courses 
                             WHERE department IS NOT NULL AND department != '' 
                             ORDER BY department ASC");
        $departments = $stmt->fetchAll(PDO::FETCH_COLUMN); // Fetches a simple array of department names

        if ($departments === false) {
            sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to fetch departments.']);
        }

        sendJsonResponse(200, [
            'status' => 'success',
            'departments' => $departments
        ]);

    } else { // Default behavior: fetch all courses (or modify as per your original 'get_courses.php' needs)
        $stmt = $pdo->query("SELECT course_code, course_title, department FROM courses ORDER BY course_code ASC");
        $courses = $stmt->fetchAll();

        if ($courses === false) {
            sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to fetch courses.']);
        }

        sendJsonResponse(200, [
            'status' => 'success',
            'courses' => $courses // Or 'data' => $courses if your frontend expects that
        ]);
    }

} catch (PDOException $e) {
    error_log("API Error (get_courses - fetch_type: {$fetch_type}): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => "Database error while fetching data ({$fetch_type}). Please check server logs."]);
}
?>