<?php 
    session_start();
    include('../../config/dbcon.php');

    if(isset($_POST["prod_id"]) && isset($_POST["variation_id"]) && isset($_POST["quantity"]) && isset($_POST["total"])){
        $prod_id = $_POST["prod_id"];
        $variation_id = $_POST["variation_id"];
        $quantity = $_POST["quantity"];
        $total = $_POST["total"];
        $user_id = $_SESSION['user_id'];
        $check_box = 1;
        $status_id = 6;
        

        $checkQuantity = "SELECT quantity_in_stock FROM product_size_variation WHERE variation_id = ?";
        $stmt = mysqli_prepare($conn, $checkQuantity);
        mysqli_stmt_bind_param($stmt, "i", $variation_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $quantity_in_stock = $row['quantity_in_stock'];

        if($quantity > $quantity_in_stock){
            echo json_encode(['status' => 'error', 'message' => 'Quantity exceeds available stock']);
            exit;
        }

        $query = "INSERT INTO cart (user_id, variation_id, quantity, price, checkbox, status_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiidii", $user_id, $variation_id, $quantity, $total, $check_box, $status_id);
        
        if(!$stmt->execute()){
            echo json_encode(['status' => 'error', 'message' => 'Failed to add item to cart']);

            exit;
        }

        echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
        exit;
    }
?> 