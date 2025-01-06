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
        

        $query = "UPDATE cart SET status_id = ? WHERE status_id = ? AND user_id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $status_id, $current_status, $user_id);
        $stmt->execute();


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