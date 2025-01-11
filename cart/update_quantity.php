<?php
session_start();
include("../config/dbcon.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = isset($_POST['cartId']) ? $_POST['cartId'] : null;
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;

    if ($cartId !== null && $quantity !== null) {
        $userId = $_SESSION['user_id'];

        // Fetch the product price from the product table
        $fetch_product_price_query = "SELECT c.cart_id, p.product_id, s.size_id, p.price
                                      FROM cart c
                                      JOIN product_size_variation v ON c.variation_id = v.variation_id 
                                      JOIN product p ON v.product_id = p.product_id
                                      JOIN sizes s ON v.size_id = s.size_id
                                      WHERE c.cart_id = ? AND c.user_id = ?";
        $stmt = mysqli_prepare($conn, $fetch_product_price_query);
        mysqli_stmt_bind_param($stmt, "ii", $cartId, $userId);
        $fetch_product_price_query_run = mysqli_stmt_execute($stmt);

        if ($fetch_product_price_query_run) {
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $productPrice = $row['price'];

            //check quantity in stock
            $checkQuantity = "SELECT quantity_in_stock FROM product_size_variation WHERE product_id = ? AND size_id = ?";
            $stmt = mysqli_prepare($conn, $checkQuantity);
            mysqli_stmt_bind_param($stmt, "ii", $row['product_id'], $row['size_id']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $quantity_in_stock = $row["quantity_in_stock"];

            if($quantity > $quantity_in_stock){
                echo json_encode(["status" => "error", "message" => "Quantity exceeds available stock (" . $quantity_in_stock . ")", "quantity_in_stock" => $quantity_in_stock]);
                exit;
            }


            // Update the cart quantity
            $update_query = "UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
            $stmt = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt, "iii", $quantity, $cartId, $userId);
            $update_query_run = mysqli_stmt_execute($stmt);

            if ($update_query_run) {
                // Calculate the updated price based on the new quantity and product price
                $updatedPrice = $quantity * $productPrice;

                // Update the price in the cart table
                $update_price_query = "UPDATE cart SET price = ? WHERE cart_id = ? AND user_id = ?";
                $stmt = mysqli_prepare($conn, $update_price_query);
                mysqli_stmt_bind_param($stmt, "dii", $updatedPrice, $cartId, $userId);
                $update_price_query_run = mysqli_stmt_execute($stmt);

                if ($update_price_query_run) {
                    // Return the updated quantity and price as JSON
                    $response = array(
                        'newQuantity' => $quantity,
                        'newPrice' => $updatedPrice
                    );

                    echo json_encode($response);
                } else {
                    // Return a 400 status if updating the price fails
                    http_response_code(400);
                }
            } else {
                // Return a 400 status if updating the quantity fails
                http_response_code(400);
            }
        } else {
            // Return a 400 status if fetching the product price fails
            http_response_code(400);
        }
    } else {
        // Return a 400 status for invalid data
        http_response_code(400);
    }
}
?>
