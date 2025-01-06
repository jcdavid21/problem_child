<?php
    session_start();
    require_once("../../config/dbcon.php");

    if(isset($_POST["cart_id"])){
        $cart_id = $_POST["cart_id"];

        $query = "DELETE FROM cart WHERE cart_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cart_id);
        if($stmt->execute()){
            echo "success";
        }else{
            echo "error";
        }
    }
?>