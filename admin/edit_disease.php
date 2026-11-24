<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

require_once("../backend/db.php");

// ------------------------------
// UPDATE ONLY ADVICE (SAFE)
// ------------------------------
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $advice = $_POST['advice'];

    $stmt = $conn->prepare("UPDATE disease_advice SET advice=? WHERE id=?");
    $stmt->bind_param("si", $advice, $id);
    $stmt->execute();
}

// ------------------------------
// FETCH DATA
// ------------------------------
$result = mysqli_query($conn, "SELECT * FROM disease_advice ORDER BY id ASC");

?>

<!DOCTYPE html>
<html>
<head>
<title>Safe Admin Disease Editor</title>

<style>
body{
    font-family: Arial;
    background:#f4f4f4;
}

.container{
    width:90%;
    margin:30px auto;
}

table{
    width:100%;
    border-collapse: collapse;
    background:white;
}

th, td{
    border:1px solid #ddd;
    padding:12px;
    text-align:center;
}

th{
    background:#007bff;
    color:white;
}

textarea{
    width:100%;
    height:70px;
    padding:8px;
}

button{
    padding:8px 12px;
    background:#28a745;
    color:white;
    border:none;
    cursor:pointer;
    border-radius:5px;
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

<h2>🧠 Safe Disease Advice Editor</h2>

<table>

<tr>
<th>ID</th>
<th>Disease (Locked)</th>
<th>Advice</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<form method="POST">

<td>
<?php echo $row['id']; ?>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
</td>

<td>
<b><?php echo $row['disease']; ?></b>
<!-- LOCKED (not editable) -->
</td>

<td>
<textarea name="advice"><?php echo $row['advice']; ?></textarea>
</td>

<td>
<button type="submit" name="update">Update</button>
</td>

</form>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>