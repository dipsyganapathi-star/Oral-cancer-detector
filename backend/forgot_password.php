<?php

include "db.php";

if(isset($_POST['email'])){

    $email = $_POST['email'];

    // Check email exists
    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        // Redirect to reset page
        header("Location: ../frontend/reset_password.php?email=$email");
    } else {

        echo "
        <script>
        alert('Email not found!');
        window.location.href='../frontend/forgot_password.html';
        </script>
        ";

    }

}

?>