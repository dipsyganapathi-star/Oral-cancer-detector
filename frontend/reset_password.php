<!DOCTYPE html>
<html>
<head>
<title>Reset Password</title>

<style>

body{
    font-family:Arial;
    background:linear-gradient(135deg,#141e30,#243b55);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
}

.container{
    background:rgba(255,255,255,0.1);
    padding:30px;
    border-radius:15px;
    width:350px;
    text-align:center;
    backdrop-filter:blur(10px);
}

input{
    width:100%;
    padding:10px;
    margin:15px 0;
    border:none;
    border-radius:8px;
}

button{
    width:100%;
    padding:10px;
    background:#00c6ff;
    border:none;
    border-radius:8px;
    color:white;
    cursor:pointer;
}

button:hover{
    background:#0072ff;
}

</style>

</head>

<body>

<div class="container">

<h2>Reset Password</h2>

<form action="../backend/reset_password.php" method="POST">

<input type="hidden" name="email"
value="<?php echo $_GET['email']; ?>">

<input type="password"
name="new_password"
placeholder="Enter New Password" required>

<button type="submit">
Update Password
</button>

</form>

</div>

</body>
</html>