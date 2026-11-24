<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');

require_once(__DIR__ . "/db.php");

// Function to return JSON response
function sendResponse($data) {
    echo json_encode($data);
    exit();
}

// Check database connection
if (!$conn) {
    sendResponse([
        "status" => "error",
        "message" => "Database connection failed"
    ]);
}

// Check image upload
if (!isset($_FILES['image'])) {
    sendResponse([
        "status" => "error",
        "message" => "No image selected"
    ]);
}

if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    sendResponse([
        "status" => "error",
        "message" => "Image upload error: " . $_FILES['image']['error']
    ]);
}

// Get uploaded image details
$filename = basename($_FILES['image']['name']);
$tempname = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];

// Validate image type
$allowedTypes = ['image/jpeg', 'image/png'];

$fileInfo = finfo_open(FILEINFO_MIME_TYPE);
$fileType = finfo_file($fileInfo, $tempname);
finfo_close($fileInfo);

if (!in_array($fileType, $allowedTypes)) {
    sendResponse([
        "status" => "error",
        "message" => "Only JPG and PNG images are allowed"
    ]);
}

// Validate image size (5 MB)
if ($fileSize > 5 * 1024 * 1024) {
    sendResponse([
        "status" => "error",
        "message" => "Image size must be below 5 MB"
    ]);
}

// Validate actual image
if (getimagesize($tempname) === false) {
    sendResponse([
        "status" => "error",
        "message" => "Invalid image file"
    ]);
}

// Generate unique filename
$newName = time() . "_" . preg_replace(
    "/[^a-zA-Z0-9._-]/",
    "_",
    $filename
);

// Upload directory
$uploadDir = __DIR__ . "/../uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$targetFile = $uploadDir . $newName;

// Move uploaded image
if (!move_uploaded_file($tempname, $targetFile)) {
    sendResponse([
        "status" => "error",
        "message" => "Failed to upload image"
    ]);
}

// Find Python prediction script
$script = realpath(__DIR__ . "/../ai_model/predict.py");

if (!$script) {
    sendResponse([
        "status" => "error",
        "message" => "Python prediction script not found"
    ]);
}

// Run Python prediction
$command = "python " . escapeshellarg($script) . " "
         . escapeshellarg($targetFile) . " 2>&1";

$output = shell_exec($command);

if ($output === null || trim($output) === "") {
    sendResponse([
        "status" => "error",
        "message" => "AI model execution failed"
    ]);
}

// Read prediction output
$lines = array_values(
    array_filter(
        array_map('trim', explode("\n", trim($output))),
        function($line) {
            return $line !== "";
        }
    )
);

$disease = $lines[0] ?? "UNKNOWN";
$confidence = $lines[1] ?? "0";

// Validate prediction
if (strtoupper($disease) === "NON_ORAL") {
    sendResponse([
        "status" => "error",
        "message" => "Non-oral image detected"
    ]);
}

if (strtoupper($disease) === "UNKNOWN") {
    sendResponse([
        "status" => "error",
        "message" => "Unknown prediction result"
    ]);
}

// Save prediction into database
$sql = "INSERT INTO predictions
        (image, result, percentage, created_at)
        VALUES (?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    sendResponse([
        "status" => "error",
        "message" => "SQL prepare failed: " . $conn->error
    ]);
}

// All three columns are strings
$stmt->bind_param(
    "sss",
    $newName,
    $disease,
    $confidence
);

// Execute database insertion
if (!$stmt->execute()) {
    sendResponse([
        "status" => "error",
        "message" => "Database insertion failed: " . $stmt->error
    ]);
}

// Close statement
$stmt->close();

// Success response
sendResponse([
    "status" => "success",
    "message" => "Prediction saved successfully",
    "disease" => $disease,
    "confidence" => $confidence,
    "image" => $newName
]);

?>