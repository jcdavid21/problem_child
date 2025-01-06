<?php
session_start();
include('../config/dbcon.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you sanitize the input data
    $paymentMethod = $_POST['method'];

    // Assuming you have a session or some way to identify the user
    $userId = $_SESSION['user_id'];

    // Update the user's payment method in the database
    $query = "UPDATE oders SET pay_method = '$paymentMethod' WHERE id = $userId";

    // Perform the query
    $result = mysqli_query($connection, $query);

    if ($result) {
        // If the query is successful, you can send a success response
        echo json_encode(['status' => 'success', 'message' => 'Payment method updated successfully']);
    } else {
        // If the query fails, you can send an error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to update payment method']);
    }
} else {
    // If it's not a POST request, you can send an error response
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>