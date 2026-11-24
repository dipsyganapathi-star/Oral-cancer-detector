<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

<style>

body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b, #0b0f19);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    color:white;
}

/* LOGIN BOX */
.container{
    width:380px;
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(15px);
    padding:35px;
    border-radius:16px;
    box-shadow:0px 0px 25px rgba(0,0,0,0.5);
    border:1px solid rgba(255,255,255,0.1);
    text-align:center;
}

/* TITLE */
h2{
    margin-bottom:20px;
    color:#38bdf8;
    letter-spacing:1px;
}

/* INPUT FIELDS */
input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:10px;
    outline:none;
    background: rgba(255,255,255,0.08);
    color:white;
    font-size:14px;
    transition:0.3s;
}

input:focus{
    background: rgba(255,255,255,0.15);
    box-shadow:0px 0px 10px rgba(56,189,248,0.4);
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    margin-top:15px;
    border:none;
    border-radius:10px;
    background: linear-gradient(45deg, #2563eb, #1d4ed8);
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    transform:scale(1.03);
    box-shadow:0px 0px 15px rgba(37,99,235,0.5);
}

/* FOOTER TEXT */
.note{
    margin-top:15px;
    font-size:12px;
    color:#94a3b8;
}

</style>

</head>

<body>

<div class="container">

    <h2>🛡️ Admin Access</h2>

    <form action="admin_check.php" method="POST">

        <input type="text" name="username" placeholder="Enter Username" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit">LOGIN</button>

    </form>

    <div class="note">
        Secure Admin Panel • AI System Access Only
    </div>

</div>

</body>
</html>