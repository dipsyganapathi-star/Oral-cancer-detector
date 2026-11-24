<?php
require_once("db.php");

// GET DATA
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

// REGEX RULES
$nameRegex = "/^[A-Za-z\s]+$/";
$emailRegex = "/^[a-zA-Z0-9._%+-]+@gmail\.com$/";

// VALIDATION
if (!preg_match($nameRegex, $name)) {
    die("Invalid Name: Only letters allowed");
}

if (!preg_match($emailRegex, $email)) {
    die("Invalid Email: Only Gmail allowed (example@gmail.com)");
}

if (empty($password)) {
    die("Password cannot be empty");
}

// CHECK DUPLICATE EMAIL
$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (mysqli_num_rows($check) > 0) {
    die("Email already registered");
}

// INSERT (PLAIN PASSWORD - AS REQUESTED)
$sql = "INSERT INTO users (name, email, password)
        VALUES ('$name', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration Successful";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>