<?php
session_start();

require_once("../backend/db.php");

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

$user_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$prediction_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM predictions"));
$feedback_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM feedback"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Control Panel</title>

<style>

body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background:#0b0f19;
    color:#e5e7eb;
}

.topbar{
    background:#111827;
    padding:18px 25px;
    font-size:20px;
    font-weight:bold;
    letter-spacing:1px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #1f2937;
}

.topbar span{
    color:#9ca3af;
    font-size:13px;
}

.wrapper{
    display:flex;
}

.sidebar{
    width:220px;
    background:#111827;
    min-height:100vh;
    padding-top:20px;
    border-right:1px solid #1f2937;
}

.sidebar h3{
    text-align:center;
    color:#60a5fa;
    margin-bottom:20px;
}

.side-link{
    display:block;
    padding:12px 18px;
    color:#cbd5e1;
    text-decoration:none;
    transition:0.2s;
}

.side-link:hover{
    background:#1f2937;
    color:white;
    padding-left:22px;
}

.main{
    flex:1;
    padding:30px;
}

.cards{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
}

.card{
    flex:1;
    min-width:220px;
    background:#111827;
    padding:25px;
    border-radius:12px;
    border:1px solid #1f2937;
}

.card h2{
    margin:0;
    font-size:32px;
    color:#22c55e;
}

.card p{
    color:#9ca3af;
}

.action-card{
    background:#111827;
    padding:20px;
    border-radius:12px;
    margin-top:20px;
    border:1px solid #1f2937;
}

.btn{
    display:inline-block;
    margin-top:10px;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    background:#2563eb;
    transition:0.3s;
    margin-right:10px;
}

.btn:hover{
    background:#1d4ed8;
}

.logout{
    background:#dc2626;
}

.logout:hover{
    background:#b91c1c;
}

.section-title{
    margin-top:0;
    color:#e5e7eb;
}

</style>

</head>

<body>

<div class="topbar">
    <div>🧠 ADMIN CONTROL PANEL</div>
    <span>Oral Disease AI System</span>
</div>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h3>MENU</h3>

        <a class="side-link" href="admin_dashboard.php">Dashboard</a>
        <a class="side-link" href="view_users.php">Users</a>
        <a class="side-link" href="view_predictions.php">Predictions</a>
        <a class="side-link" href="view_feedback.php">Feedback</a>

        <!-- NEW ADDED LINKS -->
        <a class="side-link" href="add_disease.php">➕ Add Disease</a>
        <a class="side-link" href="edit_disease.php">✏ Edit Disease</a>

        <a class="side-link logout" href="admin_logout.php">Logout</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <h2 class="section-title">System Overview</h2>

        <div class="cards">

            <div class="card">
                <h2><?php echo $user_count; ?></h2>
                <p>Total Users</p>
            </div>

            <div class="card">
                <h2><?php echo $prediction_count; ?></h2>
                <p>Predictions Logged</p>
            </div>

            <div class="card">
                <h2><?php echo $feedback_count; ?></h2>
                <p>User Feedback</p>
            </div>

        </div>

        <div class="action-card">
            <h3>Quick Actions</h3>

            <a class="btn" href="view_users.php">Manage Users</a>
            <a class="btn" href="view_predictions.php">View Predictions</a>
            <a class="btn" href="view_feedback.php">Check Feedback</a>

            <!-- NEW ACTIONS -->
            <a class="btn" href="add_disease.php">➕ Add Disease</a>
            <a class="btn" href="edit_disease.php">✏ Edit Disease</a>

        </div>

    </div>

</div>

</body>
</html>