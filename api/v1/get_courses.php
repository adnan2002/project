<?php
// api/v1/get_courses.php

header('Content-Type: application/json');


require_once __DIR__ . '/../../db/config.php'; 
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

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    $stmt = $pdo->query("SELECT course_code, course_title FROM courses ORDER BY course_code ASC");
    $courses = $stmt->fetchAll();

    if ($courses === false) { 
        sendJsonResponse(500, ['status' => 'error', 'error' => 'Failed to fetch courses.']);
    }

    sendJsonResponse(200, [
        'status' => 'success',
        'courses' => $courses
    ]);

} catch (PDOException $e) {
    error_log("API Error (get_courses): " . $e->getMessage());
    sendJsonResponse(500, ['status' => 'error', 'error' => 'Database error while fetching courses.']);
}
?>