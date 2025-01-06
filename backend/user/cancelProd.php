<?php
    session_start();
    require_once("../../config/dbcon.php");

    if(isset($_GET["prodId"])){
        $status_id = 5;
        $item_id = $_GET["prodId"];

        $query = "UPDATE cart SET status_id = ? WHERE cart_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $status_id, $item_id);
        $stmt->execute();
        echo "deleted";
    }
?>