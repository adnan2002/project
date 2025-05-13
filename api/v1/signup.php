<?php
require_once __DIR__ . '/../../db/config.php';

// --- Start Session ---
// This MUST be called before any output.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// --- Database Configuration ---
$db_host = 'localhost';
$db_port = '3306';
$db_name = 'project';
$db_user = 'root';
$db_pass = '';

// --- Helper Function to Send JSON Responses ---
function sendJsonResponse($statusCode, $data) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}


// --- API Logic ---

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(405, ['error' => 'Method Not Allowed. Only POST requests are accepted.']);
}

$inputData = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE || empty($inputData)) {
    $inputData = $_POST;
}

// Validate Input Data & assign safely
$firstName = trim($inputData['first_name'] ?? '');
$lastName = trim($inputData['last_name'] ?? '');
$email = trim($inputData['email'] ?? '');
$password = $inputData['password'] ?? '';

$requiredFieldsData = [
    'first_name' => $firstName,
    'last_name' => $lastName,
    'email' => $email,
    'password' => $password
];

foreach ($requiredFieldsData as $fieldName => $value) {
    if (empty($value)) {
        sendJsonResponse(400, ['error' => ucfirst(str_replace('_', ' ', $fieldName)) . ' is required.']);
    }
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    sendJsonResponse(400, ['error' => 'Invalid email format.']);
}

if (strlen($password) < 8) {
    sendJsonResponse(400, ['error' => 'Password must be at least 8 characters long.']);
}

$universityId = isset($inputData['university_id']) ? trim($inputData['university_id']) : null;
if ($universityId === '') $universityId = null;

$major = isset($inputData['major']) ? trim($inputData['major']) : null;
if ($major === '') $major = null;

$academicLevel = isset($inputData['academic_level']) ? trim($inputData['academic_level']) : null;
if ($academicLevel === '') $academicLevel = null;

$dateOfBirthInput = isset($inputData['date_of_birth']) ? trim($inputData['date_of_birth']) : null;
if ($dateOfBirthInput === '') $dateOfBirthInput = null;
$dateOfBirthDB = null;

if ($dateOfBirthInput) {
    $dateObj = DateTime::createFromFormat('d/m/Y', $dateOfBirthInput);
    if ($dateObj && $dateObj->format('d/m/Y') === $dateOfBirthInput) {
        $dateOfBirthDB = $dateObj->format('Y-m-d');
    } else {
        sendJsonResponse(400, ['error' => 'Invalid date of birth format. Please use dd/mm/yyyy.']);
    }
}

$validAcademicLevels = ['Freshman', 'Sophomore', 'Junior', 'Senior', 'Graduate', 'Alumni', 'Faculty', 'Other'];
if ($academicLevel !== null && !in_array($academicLevel, $validAcademicLevels)) {
    sendJsonResponse(400, ['error' => 'Invalid academic level provided. Valid levels are: ' . implode(', ', $validAcademicLevels)]);
}

// Database Connection
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
    sendJsonResponse(500, ['error' => 'Database connection failed.']);
}

// Check for Existing Email or University ID
try {
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->fetch()) {
        sendJsonResponse(409, ['error' => 'This email address is already registered.']);
    }

    if ($universityId !== null) {
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE university_id = :university_id");
        $stmt->bindParam(':university_id', $universityId);
        $stmt->execute();
        if ($stmt->fetch()) {
            sendJsonResponse(409, ['error' => 'This university ID is already registered.']);
        }
    }
} catch (PDOException $e) {
    error_log("Error checking existing user: " . $e->getMessage());
    sendJsonResponse(500, ['error' => 'An error occurred while verifying user data.']);
}

// Hash Password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);
if ($passwordHash === false) {
    error_log("Password hashing failed.");
    sendJsonResponse(500, ['error' => 'Could not process registration (hashing).']);
}

// Insert User
$sql = "INSERT INTO users (first_name, last_name, email, password_hash, university_id, major, academic_level, date_of_birth) 
        VALUES (:first_name, :last_name, :email, :password_hash, :university_id, :major, :academic_level, :date_of_birth)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password_hash', $passwordHash);
    $stmt->bindParam(':university_id', $universityId, $universityId === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(':major', $major, $major === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(':academic_level', $academicLevel, $academicLevel === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmt->bindParam(':date_of_birth', $dateOfBirthDB, $dateOfBirthDB === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

    $stmt->execute();
    $userId = $pdo->lastInsertId();

    // --- Session Creation on Successful Signup ---
    $_SESSION['user_id'] = $userId;
    $_SESSION['first_name'] = $firstName;
    $_SESSION['email'] = $email;
    $_SESSION['logged_in_at'] = time(); // Optional: for session timeout logic later

    sendJsonResponse(201, [
        'status' => 'success',
        'message' => 'User account created successfully. You are now logged in.',
        'user_id' => $userId
    ]);

} catch (PDOException $e) {
    error_log("Database Insert Error: " . $e->getMessage());
    if ($e->getCode() == 23000) { 
         sendJsonResponse(409, ['error' => 'An account with this email or university ID already exists.']);
    } else {
        sendJsonResponse(500, ['error' => 'Failed to create user account.']);
    }
}
?>
