<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

/* Temporary Login */

if($username == "admin" && $password == "admin123")
{
    $_SESSION['admin'] = $username;

    header("Location: admin_dashboard.php");
    exit();
}
else
{
    echo "<script>
            alert('Invalid Admin Credentials');
            window.location='admin_login.php';
          </script>";
}
?>