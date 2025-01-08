<?php 
    session_start();
    require_once("../reports/reports.php");

    if(isset($_POST["prod_id"])) {
        $user_id = $_SESSION["user_id"];
        $prod_id = $_POST["prod_id"];
        $query = "UPDATE product SET availability = 1 WHERE product_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $prod_id);
        if($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }

        // Log admin action
        $query2 = "SELECT CONCAT(first_name, ' ', last_name) as ac_username FROM users WHERE user_id=?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $user_id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $row = $result->fetch_assoc();
        $username = $row["ac_username"];
        
        $activity = "Activated product with ID: $prod_id";
        $type = "Admin";
        if(!report($conn, $user_id, $username, $activity, $type)) {
            throw new Exception("Failed to log admin action.");
        }

    }  
?>