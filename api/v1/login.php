<?php

header('Content-Type: application/json');

// This MUST be called before any output.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



require_once __DIR__ . '/../../db/config.php';


// --- Helper Function to Send JSON Responses ---
function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

// --- Set Error Reporting for Development (Comment out/adjust for production) ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- API Logic ---

// 1. Check if Request Method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(405, ['error' => 'Method Not Allowed. Only POST requests are accepted.']);
}

// 2. Get Input Data
$inputData = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE || empty($inputData)) {
    $inputData = $_POST; // Fallback for form-data
}

// 3. Validate Input Data
$email = trim($inputData['email'] ?? '');
$password = $inputData['password'] ?? ''; // Don't trim password

if (empty($email)) {
    sendJsonResponse(400, ['error' => 'Email is required.']);
}
if (empty($password)) {
    sendJsonResponse(400, ['error' => 'Password is required.']);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendJsonResponse(400, ['error' => 'Invalid email format.']);
}

// 4. Database Connection with PDO
$dsn = "mysql:host={$db_host};port={$db_port};dbname={$db_name};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'Database connection failed. Please try again later.']);
}

// 5. Fetch User by Email and Verify Password
try {
    $stmt = $pdo->prepare("SELECT user_id, first_name, last_name, email, password_hash FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if (!$user) {
        // Email does not exist
        sendJsonResponse(404, ['error' => 'Email address not found.']);
    }

    // Verify password
    if (password_verify($password, $user['password_hash'])) {
        // Password is correct, create session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name']; // Make sure this is in your users table
        $_SESSION['email'] = $user['email'];
        $_SESSION['logged_in_at'] = time();

        sendJsonResponse(200, [
            'status' => 'success',
            'message' => 'Login successful.',
            'user_id' => $user['user_id'],
            'first_name' => $user['first_name']
        ]);
    } else {
        // Incorrect password
        sendJsonResponse(401, ['error' => 'Incorrect password.']);
    }

} catch (PDOException $e) {
    error_log("Login Error: " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'An error occurred during login. Please try again.']);
}
?>
