<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

require_once("../backend/db.php");

$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Users</title>

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
    border-collapse:collapse;
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

.back-btn{
    display:inline-block;
    margin-bottom:15px;
    padding:10px 15px;
    background:#28a745;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

</style>
</head>

<body>

<div class="container">

<a href="admin_dashboard.php" class="back-btn">
Back to Dashboard
</a>

<h2>Registered Users</h2>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>