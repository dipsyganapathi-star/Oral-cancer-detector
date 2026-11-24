<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>

<style>

body {
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;   
    align-items: center;       
    font-family: Arial;
}

button{
    font-family: Arial, sans-serif;
    font-weight: 900;
    color: #000000;
    letter-spacing: 1px;
    text-transform: uppercase;
}

#bg-video {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%;
    min-height: 100%;
    object-fit: cover;
    z-index: -1;
}

.container {
    position: relative;
    z-index: 1;
    text-align: center;
    background: rgba(0, 0, 0, 0.6);
    padding: 30px;
    border-radius: 12px;
    color: white;
}

a {
    display: block;
    margin: 10px;
    padding: 10px;
    background: white;
    color: black;
    text-decoration: none;
    border-radius: 8px;
}

a:hover {
    background: #ddd;
}

/* Upload button */
.upload-btn {
    color: #111111;
    font-weight: 900;
    font-family: 'Segoe UI', sans-serif;
    text-decoration: none;
    letter-spacing: 1px;
    display: inline-block;
    margin: 10px;
    padding: 12px;
    background: #00c6ff;
    color: white;
    text-decoration: none;
    border-radius: 8px;
}

.upload-btn:hover {
    background: #0099cc;
}

/* HOME BUTTON (SMALL + GREEN) */
.home-btn {
    margin-top: 10px;
    padding: 8px 14px;
    font-size: 14px;
    border-radius: 8px;
    background: #00c853;
    color: white;
    border: none;
    cursor: pointer;
    width: 120px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    transition: 0.3s;
}

.home-btn:hover {
    background: #009624;
}

.logout-btn {
    padding: 20px !important;
    font-size: 20px !important;
    border-radius: 12px;
    width: 200px;
    background: red;
    color: white;
    border: none;
    cursor: pointer;
}

.logout-btn:hover {
    background: darkred;
}

.upload-btn{
    color: black;  /* change this to any color */
    text-decoration: none;
}

h1{
    color: yellow;
}
</style>

</head>

<body>

<video autoplay muted loop id="bg-video">
    <source src="bg.mp4" type="video/mp4">
</video>

<div class="container">

<h1>Welcome to Oral Cancer Detection System</h1>

<!-- Upload Button -->
<a class="upload-btn" href="symptom_prediction.php">
    Symptom Based Prediction
</a>

<a class="upload-btn" href="upload.html">
    Image Based Prediction
</a>

<!-- Home Button (NOW UNDER UPLOAD) -->
<button class="home-btn" onclick="window.location.href='index.php'">
    Home
</button>

</div>

</body>
</html>