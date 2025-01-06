<?php
session_start();
include('../config/dbcon.php');

// Check if the user is already logged in
if (empty($_SESSION["login"])) {
    echo "<script>alert('Please log in first.');</script>";
    echo "<script>window.location.href='../login/login.php';</script>";
    exit;
}

// Check if the user is not logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Validate and sanitize input
    $selectedSize = isset($_POST['selectedSize']) ? htmlspecialchars($_POST['selectedSize']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    // Validate that the required fields are not empty
    if (empty($selectedSize) || $quantity <= 0) {
        // Handle invalid input
        echo "Invalid input";
        exit();
    }

    // Assuming you have a valid $product_id and $user_id available
    $product_id = 7; // Replace with your actual product_id

    // Fetch variation_id based on the selected product and size
    $sizeQuery = "SELECT size_id FROM sizes WHERE size_name = ?";
    $sizeStmt = $conn->prepare($sizeQuery);

    if (!$sizeStmt) {
        die("Error preparing size statement: " . $conn->error);
    }

    $sizeStmt->bind_param("s", $selectedSize);
    $sizeStmt->execute();
    $sizeStmt->bind_result($size_id);
    $sizeStmt->fetch();
    $sizeStmt->close();

    if (!$size_id) {
        die("Error fetching size_id: " . $conn->error);
    }

    $variationQuery = "SELECT variation_id FROM product_size_variation WHERE product_id = ? AND size_id = ?";
    $variationStmt = $conn->prepare($variationQuery);

    if (!$variationStmt) {
        die("Error preparing variation statement: " . $conn->error);
    }

    $variationStmt->bind_param("ii", $product_id, $size_id);
    $variationStmt->execute();
    $variationStmt->bind_result($variation_id);
    $variationStmt->fetch();
    $variationStmt->close();

    if (!$variation_id) {
        die("Error fetching variation_id: " . $conn->error);
    }

    // Fetch the price from the database or set it based on your logic
    // For example, if the price is constant for a product, you can set it like this:
    $price = 350; // Replace with your actual price logic

    // Check if the entry already exists in the cart
    $checkQuery = "SELECT cart_id, quantity, price FROM cart WHERE user_id = ? AND variation_id = ?";
    $checkStmt = $conn->prepare($checkQuery);

    if (!$checkStmt) {
        die("Error preparing check statement: " . $conn->error);
    }

    $checkStmt->bind_param("ii", $user_id, $variation_id);
    $checkStmt->execute();
    $checkStmt->bind_result($cart_id, $existingQuantity, $existingPrice);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($existingQuantity > 0) {
        // Entry already exists, update quantity and price
        $newQuantity = $existingQuantity + $quantity;
        $newPrice = $existingPrice + ($price * $quantity);

        $updateQuery = "UPDATE cart SET quantity = ?, price = ? WHERE cart_id = ?";
        $updateStmt = $conn->prepare($updateQuery);

        if (!$updateStmt) {
            die("Error preparing update statement: " . $conn->error);
        }

        $updateStmt->bind_param("idi", $newQuantity, $newPrice, $cart_id);
        $updateStmt->execute();
        $updateStmt->close();

    } else {
        // Entry doesn't exist, insert a new row
        $insertQuery = "INSERT INTO cart (user_id, variation_id, quantity, price) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);

        if (!$insertStmt) {
            die("Error preparing insert statement: " . $conn->error);
        }

        $insertStmt->bind_param("iiid", $user_id, $variation_id, $quantity, $price);
        $insertStmt->execute();
        $insertStmt->close();
    }

    // Redirect the user or perform other actions as needed
    echo "<script> alert('Product added to cart successfully!'); </script>";
    echo "<script>window.location.href='product7.php';</script>";
    exit();
}
?>