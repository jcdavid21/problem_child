<?php
session_start();
include("../config/dbcon.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = isset($_POST['cartId']) ? $_POST['cartId'] : null;

    if ($cartId !== null) {
        $userId = $_SESSION['user_id'];

        // Delete the item from the cart
        $delete_query = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
        $stmt = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($stmt, "ii", $cartId, $userId);
        $delete_query_run = mysqli_stmt_execute($stmt);

        if ($delete_query_run) {
            // Return success as JSON
            $response = array(
                'status' => 'success',
                'message' => 'Item removed from the cart.'
            );

            echo json_encode($response);
        } else {
            // Return a 400 status if deletion fails
            http_response_code(400);
        }
    } else {
        // Return a 400 status for invalid data
        http_response_code(400);
    }
}
?>
