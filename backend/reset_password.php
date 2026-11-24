<?php

include "db.php";

if(isset($_POST['email']) && isset($_POST['new_password'])){

    $email = $_POST['email'];

    $new_password = $_POST['new_password'];

    // Update password
    $sql = "UPDATE users
            SET password='$new_password'
            WHERE email='$email'";

    if(mysqli_query($conn, $sql)){

        echo "
        <script>
        alert('Password Updated Successfully!');
        window.location.href='../frontend/login.html';
        </script>
        ";

    } else {

        echo "Error updating password!";

    }

}

?>