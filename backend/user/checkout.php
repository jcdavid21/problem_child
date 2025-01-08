<?php 

session_start();
require_once '../../config/dbcon.php';

if(isset($_POST["refNumber"]) && isset($_POST["depositAmount"]) && isset($_POST["shippingFee"]) && isset($_POST["address_id"]))
{
    $refNumber = $_POST["refNumber"];
    $depositAmount = $_POST["depositAmount"];
    $address_id = $_POST["address_id"];
    $shippingFee = $_POST["shippingFee"];
    $date = date("Y-m-d");
    $user_id = $_SESSION['user_id'];

    if(isset($_FILES["receiptFile"]) && $_FILES['receiptFile']['error'] === UPLOAD_ERR_OK)
    {
        $uploadDir = "../receipts/";
        $originalFileName = basename($_FILES["receiptFile"]["name"]);
        $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        $uniqueFileName = uniqid() . "." . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFileName;

        if(move_uploaded_file($_FILES["receiptFile"]["tmp_name"], $uploadFile))
        {
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

            $getCartId = "SELECT cart_id, variation_id, quantity FROM cart WHERE user_id = ? AND checkbox = 1 AND status_id = 0";
            $stmt = $conn->prepare($getCartId);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

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
                $stmt->close();
            }
            
            $insertOrder = "INSERT INTO tbl_order_details (order_id, address_id, shipping_fee) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertOrder);
            $stmt->bind_param("iii", $lastId, $address_id, $shippingFee);
            $stmt->execute();
            $stmt->close();

            $insertPayment = "INSERT INTO tbl_receipt (user_id, order_id, receipt_img, receipt_number, deposit_amount, uploaded_date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertPayment);
            $stmt->bind_param("iissis", $user_id, $lastId, $uniqueFileName, $refNumber, $depositAmount, $date);
            $stmt->execute();
            
            $updateCart = "UPDATE cart SET status_id = 1 WHERE user_id = ? AND checkbox = 1 AND status_id = 0";
            $stmt = $conn->prepare($updateCart);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->close();

            echo "success";
        }
        else
        {
            echo "failed";
        }
    }
}

?>