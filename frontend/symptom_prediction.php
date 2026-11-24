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
    <title>Symptom Prediction</title>

<style>

body{
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color:white;
}

.container{
    width:750px;
    margin:40px auto;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    padding:30px;
    border-radius:18px;
    box-shadow:0px 0px 30px rgba(0,0,0,0.5);
}

h2{
    text-align:center;
    color:#00e6e6;
}

p{
    text-align:center;
    color:#cbd5e1;
}

.back-btn{
    display:inline-block;
    margin-bottom:15px;
    padding:10px 18px;
    background:#111827;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

label{
    display:block;
    margin:10px 0;
    padding:8px;
    background: rgba(255,255,255,0.05);
    border-radius:8px;
    cursor:pointer;
}

button{
    width:100%;
    padding:14px;
    margin-top:20px;
    background: linear-gradient(45deg, #00c6ff, #0072ff);
    color:white;
    border:none;
    border-radius:30px;
    font-size:18px;
    font-weight:bold;
}

.section-title{
    margin-top:20px;
    color:#22d3ee;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>🧠 Symptom-Based Disease Prediction</h2>
<p>Select symptoms carefully for accurate prediction</p>

<form action="symptom_result.php" method="POST">

<div class="section-title">Core Oral Cancer Symptoms</div>

<label><input type="checkbox" name="symptoms[]" value="mouth_ulcer"> Mouth Ulcer</label>
<label><input type="checkbox" name="symptoms[]" value="white_patch"> White Patch</label>
<label><input type="checkbox" name="symptoms[]" value="red_patch"> Red Patch</label>
<label><input type="checkbox" name="symptoms[]" value="bleeding_gums"> Bleeding Gums</label>

<div class="section-title">Gum Disease Symptoms</div>

<label><input type="checkbox" name="symptoms[]" value="swollen_gums"> Swollen Gums</label>
<label><input type="checkbox" name="symptoms[]" value="bad_breath"> Bad Breath</label>
<label><input type="checkbox" name="symptoms[]" value="tooth_pain"> Tooth Pain</label>
<label><input type="checkbox" name="symptoms[]" value="loose_teeth"> Loose Teeth</label>

<div class="section-title">Severe Symptoms</div>

<label><input type="checkbox" name="symptoms[]" value="difficulty_swallowing"> Difficulty Swallowing</label>
<label><input type="checkbox" name="symptoms[]" value="jaw_pain"> Jaw Pain</label>
<label><input type="checkbox" name="symptoms[]" value="burning_sensation"> Burning Sensation</label>
<label><input type="checkbox" name="symptoms[]" value="mouth_lump"> Mouth Lump</label>

<button type="submit">🔍 Predict Disease</button>

<a href="welcome.php" class="back-btn">⬅ Back</a>

</form>

</div>

</body>
</html>