<?php 
    session_start();
    include("../../config/dbcon.php");

    if(empty($_SESSION["user_id"])){
        echo json_encode(["status" => "error", "message" => "Please log in first."]);
        exit;
    }

    if(empty($_POST["size_id"])){
        echo json_encode(["status" => "error", "message" => "Please select a size"]);
        exit;
    }

    if(isset($_POST["product_id"]) && isset($_POST["size_id"]) && isset($_POST["price"]) && isset($_POST["quantity"])){
        $product_id = $_POST["product_id"];
        $size_id = $_POST["size_id"];
        $quantity = $_POST["quantity"];
        $price = $_POST["price"];
        $total_price = $price * $quantity;
        $user_id = $_SESSION["user_id"];

        if($quantity <= 0){
            echo json_encode(["status" => "error", "message" => "Quantity must be greater than 0"]);
            exit;
        }

        $getVariationId = "SELECT variation_id FROM product_size_variation WHERE product_id = ? AND size_id = ?";
        $stmt = mysqli_prepare($conn, $getVariationId);
        mysqli_stmt_bind_param($stmt, "ii", $product_id, $size_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $variation_id = $row["variation_id"];

        $checkQuantity = "SELECT quantity_in_stock FROM product_size_variation WHERE variation_id = ?";
        $stmt = mysqli_prepare($conn, $checkQuantity);
        mysqli_stmt_bind_param($stmt, "i", $variation_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $quantity_in_stock = $row["quantity_in_stock"];

        if($quantity > $quantity_in_stock){
            echo json_encode(["status" => "error", "message" => "Quantity exceeds available stock (" . $quantity_in_stock . ")"]);
            exit;
        }

        $query = "INSERT INTO cart (user_id, variation_id, quantity, price, status_id) VALUES (?, ?, ?, ?, 0)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "iiid", $user_id, $variation_id, $quantity, $total_price);
        mysqli_stmt_execute($stmt);

        echo json_encode(["status" => "success", "message" => "Item added to cart"]);
        exit;
    }

?>