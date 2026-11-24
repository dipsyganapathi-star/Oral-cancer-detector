<?php

include "db.php";

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error in query!";
    exit;
}

if (mysqli_num_rows($result) > 0) {
    session_start();
$_SESSION['user'] = $email;
echo "Login Successful!";
} else {
    echo "Invalid Email or Password!";
}

?>