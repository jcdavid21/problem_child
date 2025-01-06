<?php

session_start();
require_once("../../config/dbcon.php");

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];

    $query = "DELETE FROM cart WHERE user_id = ? AND status_id = 6";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    if($stmt->execute()){
        echo "success";
    }else{
        echo "error";
    }
}
?>