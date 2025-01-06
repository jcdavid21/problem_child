<?php

    session_start();
    require_once("../reports/reports.php");

    if(isset($_GET["account_id"])){
        $account_id = $_GET["account_id"];
        $admin_id = $_SESSION["user_id"];

        $query = "UPDATE users SET status_id = 0 WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $account_id);
        $stmt->execute();
        echo "success";

        $query2 = "SELECT CONCAT(first_name, ' ', last_name) as ac_username FROM users WHERE user_id=?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $admin_id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $row = $result->fetch_assoc();
        $username = $row["ac_username"];

        $activity = "Deactivated account with ID: $account_id";
        $type = "Admin";
        if(!report($conn, $admin_id, $username, $activity, $type)) {
            throw new Exception("Failed to log admin action.");
        }

    }

?>