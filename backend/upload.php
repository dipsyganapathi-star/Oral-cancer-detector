<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

require_once("../backend/db.php");

// ✅ FORCE CHECK DB CONNECTION
if (!$conn) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed: " . mysqli_connect_error()
    ]));
}

if (isset($_FILES['image'])) {

    $filename = basename(strtolower($_FILES['image']['name']));
    $tempname = $_FILES['image']['tmp_name'];
    $fileType = $_FILES['image']['type'];
    $fileSize = $_FILES['image']['size'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    if (!in_array($fileType, $allowedTypes)) {
        echo json_encode(["status" => "error", "message" => "Only JPG/PNG allowed"]);
        exit();
    }

    if ($fileSize > 5 * 1024 * 1024) {
        echo json_encode(["status" => "error", "message" => "File too large"]);
        exit();
    }

    if (getimagesize($tempname) === false) {
        echo json_encode(["status" => "error", "message" => "Invalid image"]);
        exit();
    }

    $newName = time() . "_" . preg_replace("/[^a-zA-Z0-9._-]/", "_", $filename);
    $target_file = "../uploads/" . $newName;

    if (!move_uploaded_file($tempname, $target_file)) {
        echo json_encode(["status" => "error", "message" => "Upload failed"]);
        exit();
    }

    $script = realpath(__DIR__ . "/../ai_model/predict.py");

    if (!$script) {
        unlink($target_file);
        echo json_encode(["status" => "error", "message" => "Python script not found"]);
        exit();
    }

    $command = "python \"$script\" \"$target_file\" 2>&1";
    $output = shell_exec($command);

    if (!$output) {
        unlink($target_file);
        echo json_encode(["status" => "error", "message" => "AI model failed"]);
        exit();
    }

    $output = trim($output);
    $lines = array_values(array_filter(explode("\n", $output)));

    $disease = trim($lines[0] ?? "UNKNOWN");
    $confidence = trim($lines[1] ?? "0");

    // ❌ NON ORAL CHECK
    if (strtoupper($disease) == "NON_ORAL") {
        unlink($target_file);
        echo json_encode(["status" => "error", "message" => "Non-oral image detected"]);
        exit();
    }

    // ❌ UNKNOWN CHECK
    if (strtoupper($disease) == "UNKNOWN") {
        unlink($target_file);
        echo json_encode(["status" => "error", "message" => "Unknown result"]);
        exit();
    }

    // -------------------------------
    // 🔥 FINAL DATABASE INSERT (SAFE)
    // -------------------------------

    $sql = "INSERT INTO predictions (image, result, percentage, created_at)
            VALUES (?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode([
            "status" => "error",
            "message" => "Prepare failed: " . $conn->error
        ]);
        exit();
    }

    $stmt->bind_param("ssd", $newName, $disease, $confidence);

    if (!$stmt->execute()) {
        echo json_encode([
            "status" => "error",
            "message" => "Insert failed: " . $stmt->error
        ]);
        exit();
    }

    echo json_encode([
        "status" => "success",
        "disease" => $disease,
        "confidence" => $confidence,
        "image" => $newName
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "No image selected"
    ]);
}
?>