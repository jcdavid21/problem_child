<?php 
    session_start();
    require_once("../reports/trans.php");

    if(isset($_POST["status_id"]) && isset($_POST["current_status"]) && isset($_POST["user_id"])){
        $cashier_id =  $_SESSION["user_id"];
        $status_id = $_POST["status_id"];
        $current_status = $_POST["current_status"];
        $order_date = date('Y-m-d');
        $prod_name = '';
        $user_id = $_POST["user_id"];
        $order_id = $_POST["order_id"];

        $selectOrders = "SELECT * FROM tbl_orders WHERE order_id = ?";
        $stmt = $conn->prepare($selectOrders);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($data = $result->fetch_assoc()){
                $query = "UPDATE cart SET status_id = ? WHERE cart_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $status_id, $data["cart_id"]);
                $stmt->execute();
            }
        }

        if($status_id == 3){
            $track_num = $_POST["tracking_number"];
            $queryInsertTrackNum = "INSERT INTO tbl_tracking_number (tracking_number, order_id) VALUES (?, ?)";
            $stmt = $conn->prepare($queryInsertTrackNum);
            $stmt->bind_param("si", $track_num, $order_id);
            $stmt->execute();
            
        }
        

        $query2 = "SELECT CONCAT(first_name, ' ', last_name) as ac_username, isAdmin FROM users WHERE user_id=?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $cashier_id);
        $stmt2->execute();
        $result = $stmt2->get_result();

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $user_name = $data["ac_username"];
            $role_id = $data["isAdmin"];
            $current_date = date('Y-m-d');
            $activity = '';
            if($status_id == 2){
                $activity = "Claimed items";
                transaction($conn, $cashier_id, $user_name, $role_id, $current_date, $activity, $order_id);
            }
           
        }
        echo "success";
    }

?>