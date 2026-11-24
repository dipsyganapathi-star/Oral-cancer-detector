<?php

$conn = new mysqli("localhost", "root", "", "oral_cancer_db");

if ($conn->connect_error) {
    die("DB ERROR");
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['feedback'];

$sql = "INSERT INTO feedback (name, email, message)
        VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "error";
}

$conn->close();
?>