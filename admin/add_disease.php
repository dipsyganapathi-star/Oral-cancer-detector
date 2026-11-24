<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

require_once("../backend/db.php");

// ------------------------------
// INSERT NEW DISEASE
// ------------------------------
$message = "";

if (isset($_POST['add'])) {

    $disease = strtoupper(str_replace(" ", "_", $_POST['disease']));
    $advice = $_POST['advice'];

    // check duplicate
    $check = $conn->prepare("SELECT id FROM disease_advice WHERE disease=?");
    $check->bind_param("s", $disease);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "⚠ Disease already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO disease_advice (disease, advice) VALUES (?, ?)");
        $stmt->bind_param("ss", $disease, $advice);
        $stmt->execute();

        $message = "✅ Disease added successfully!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Add Disease</title>

<style>
body{
    font-family: Arial;
    background:#f4f4f4;
}

.container{
    width:60%;
    margin:50px auto;
    background:white;
    padding:30px;
    border-radius:10px;
}

input, textarea{
    width:100%;
    padding:10px;
    margin:10px 0;
}

button{
    padding:10px 15px;
    background:#007bff;
    color:white;
    border:none;
    cursor:pointer;
    border-radius:5px;
}

.msg{
    margin-top:10px;
    font-weight:bold;
    color:green;
}

.back-btn{
    display:inline-block;
    margin-bottom:15px;
    padding:10px 15px;
    background:#111827;
    color:white;
    text-decoration:none;
    border-radius:5px;
}
</style>

</head>

<body>

<div class="container">

<a href="admin_dashboard.php" class="back-btn">⬅ Back</a>

<h2>➕ Add New Disease</h2>

<form method="POST">

<label>Disease Name</label>
<input type="text" name="disease" required placeholder="e.g. Oral Cancer">

<label>Advice</label>
<textarea name="advice" required placeholder="Enter medical advice..."></textarea>

<button type="submit" name="add">Add Disease</button>

</form>

<div class="msg">
<?php echo $message; ?>
</div>

</div>

</body>
</html>