<?php 
    session_start();
    require_once("../../config/dbcon.php");

    if(isset($_POST["prod_id"])) {
        $prod_id = $_POST["prod_id"];
        $query = "UPDATE product SET availability = 1 WHERE product_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $prod_id);
        if($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
    }  
?>