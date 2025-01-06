<?php 
    session_start();
    require_once '../../config/dbcon.php';

    if($_POST["password"] && $_POST["email"]) {
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email = $_POST["email"];

        $sql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
        $result = $conn->prepare($sql);
        $result->execute();

        echo "success";

    }
?>