<?php
session_start();
include("../config/dbcon.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = isset($_POST['cartId']) ? $_POST['cartId'] : null;
    $isChecked = isset($_POST['isChecked']) ? $_POST['isChecked'] : null;

    if ($cartId !== null && $isChecked !== null) {
        $userId = $_SESSION['user_id'];

        // Update the checkbox status in the cart table
        $update_query = "UPDATE cart SET checkbox = ? WHERE cart_id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "iii", $isChecked, $cartId, $userId);
        $update_query_run = mysqli_stmt_execute($stmt);

        if ($update_query_run) {
            // Retrieve the updated checkbox status and total price
            $select_query = "SELECT checkbox, price FROM cart WHERE cart_id = ? AND user_id = ?";
            $stmt_select = mysqli_prepare($conn, $select_query);
            mysqli_stmt_bind_param($stmt_select, "ii", $cartId, $userId);
            mysqli_stmt_execute($stmt_select);
            mysqli_stmt_bind_result($stmt_select, $updatedCheckbox, $updatedPrice);
        
            if (mysqli_stmt_fetch($stmt_select)) {
                // Return success with updated checkbox status and total price
                $response = array(
                    'status' => 'success',
                    'message' => 'Checkbox status updated successfully.',
                    'updatedCheckbox' => $updatedCheckbox,
                    'updatedPrice' => $updatedPrice
                );
        
                echo json_encode($response);
            }
        
            mysqli_stmt_close($stmt_select);
        } else {
            // Return a 400 status if updating fails
            http_response_code(400);
        }
    }
}
?>