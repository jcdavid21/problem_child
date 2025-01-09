<?php 

session_start();
require_once("../reports/reports.php");

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION['user_id'];
    $ref_number = mt_rand(1000000000000, 9999999999999);
    $depositAmount = $_POST["total"];
    $shippingFee = 0;
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d");
    $date_transaction = date("Y-m-d H:i:s");

    $queryAddress = "SELECT * FROM addresses WHERE user_id = ? AND address_default = 1";
    $stmtAddress = $conn->prepare($queryAddress);
    $stmtAddress->bind_param("i", $user_id);
    $stmtAddress->execute();
    $resultAddress = $stmtAddress->get_result();
    $rowAddress = $resultAddress->fetch_assoc();

    $address_id = $rowAddress["address_id"];

    $selectOrderId = "SELECT MAX(order_id) as lastId FROM tbl_orders";
    $result = $conn->query($selectOrderId);
    $row = $result->fetch_assoc();
    $lastId = $row['lastId'];

    if($lastId == null)
    {
        $lastId = 1;
    }
    else
    {
        $lastId++;
    }

    $getCartId = "SELECT cart_id, variation_id, quantity FROM cart WHERE user_id = ? AND checkbox = 1 AND status_id = 6";
    $stmt = $conn->prepare($getCartId);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc())
    {
        $insertOrder = "INSERT INTO tbl_orders (order_id, cart_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insertOrder);
        $stmt->bind_param("ii", $lastId, $row['cart_id']);
        $stmt->execute();
        $stmt->close();

        $updateStocks = "UPDATE product_size_variation SET quantity_in_stock = quantity_in_stock - ? WHERE variation_id = ?";
        $stmt = $conn->prepare($updateStocks);
        $stmt->bind_param("ii", $row['quantity'], $row['variation_id']);
        $stmt->execute();
    }

    $insertOrder = "INSERT INTO tbl_order_details (order_id, address_id, shipping_fee) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertOrder);
    $stmt->bind_param("iii", $lastId, $address_id, $shippingFee);
    $stmt->execute();

    $insertPayment = "INSERT INTO tbl_receipt (user_id, order_id, receipt_number, deposit_amount, uploaded_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertPayment);
    $stmt->bind_param("iisss", $user_id, $lastId, $ref_number, $depositAmount, $date);
    $stmt->execute();

    $updateCart = "UPDATE cart SET status_id = 4 WHERE user_id = ? AND checkbox = 1 AND status_id = 6";
    $stmt = $conn->prepare($updateCart);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Log user action
    $query2 = "SELECT CONCAT(first_name, ' ', last_name) as ac_username FROM users WHERE user_id=?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();
    $username = $row["ac_username"];

    $activity = "Checked out items";
    $type = "Admin";
    if(!report($conn, $user_id, $username, $activity, $type)) {
        echo "error_reporting";
        exit();
    }

    $user_id_type = 1;
    $queryTrans = "INSERT INTO tbl_transactions (user_id, user_name, user_type, user_activity, activity_date, item_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtTrans = $conn->prepare($queryTrans);
    $stmtTrans->bind_param("issssi", $user_id, $username, $user_id_type, $activity, $date_transaction, $lastId);
    $stmtTrans->execute();


    echo json_encode(['status' => 'success', 'order_id' => $lastId]);
}

?>