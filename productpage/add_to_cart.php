<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'], $_POST['size'], $_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];

        // Create an array representing the item
        $item = array(
            'product_id' => $product_id,
            'size' => $size,
            'quantity' => $quantity,
            'price' => $price, // Use the actual price variable
            'total' => $quantity * $price,
            // Add other details as needed
        );

        // Add the item to the cart session
        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'][] = $item;
        } else {
            $_SESSION['cart'] = array($item);
        }

        // Respond to the AJAX request (optional)
        echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
        exit;
    }
}

// Handle cases where the request is not a valid POST request
echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
exit;
?>