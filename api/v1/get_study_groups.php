<?php
// api/v1/get_study_groups.php

header('Content-Type: application/json');


require_once __DIR__ . '/../../db/config.php';

function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}


$itemsPerPage = 6;
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
}
$offset = ($currentPage - 1) * $itemsPerPage;

$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    error_log("DB Connection Error (get_study_groups): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Database connection failed.']);
}

try {
    // --- Query to get total number of study groups for pagination ---
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM study_groups");
    $totalItems = (int)$totalStmt->fetchColumn();
    $totalPages = ceil($totalItems / $itemsPerPage);

    if ($currentPage > $totalPages && $totalItems > 0) {
        // If requested page is out of bounds, show the last page
        $currentPage = $totalPages;
        $offset = ($currentPage - 1) * $itemsPerPage;
    }


    // --- Main Query to fetch paginated study groups ---
    $sql = "SELECT 
                sg.group_id,
                sg.title,
                sg.description,
                sg.start_time,
                sg.end_time,
                sg.day_schedule,
                sg.location,
                sg.course_code,
                c.department AS subject, 
                (SELECT COUNT(*) FROM study_group_members sgm WHERE sgm.group_id = sg.group_id) AS members_count
            FROM 
                study_groups sg
            LEFT JOIN 
                courses c ON sg.course_code = c.course_code
            ORDER BY 
                sg.created_at DESC 
            LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $studyGroups = $stmt->fetchAll();

    // Format start_time and end_time for better display (optional)
    foreach ($studyGroups as &$group) { // Use reference to modify array directly
        if (isset($group['start_time'])) {
            $group['start_time_formatted'] = date("g:i A", strtotime($group['start_time']));
        }
        if (isset($group['end_time'])) {
            $group['end_time_formatted'] = date("g:i A", strtotime($group['end_time']));
        }
        // Construct next_meeting string (simplified example)
        $group['next_meeting'] = $group['day_schedule'] . ' • ' . ($group['start_time_formatted'] ?? '');
    }
    unset($group); // Unset reference

    sendJsonResponse(200, [
        'status' => 'success',
        'data' => $studyGroups,
        'pagination' => [
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'itemsPerPage' => $itemsPerPage,
            'totalItems' => $totalItems
        ]
    ]);

} catch (PDOException $e) {
    error_log("API Error (get_study_groups): " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Failed to fetch study groups.']);
}
?>
