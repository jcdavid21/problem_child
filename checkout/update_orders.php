<?php
session_start();
include("../config/dbcon.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delivered_to = $_POST['delivered_to'];
    $phone_no = $_POST['phone_no'];
    $delivered_address = $_POST['delivered_address'];

    // Perform database insertion using prepared statements to prevent SQL injection
    $stmt = $mysqli->prepare("INSERT INTO orders (delivered_to, phone_no, delivered_address) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $delivered_to, $phone_no, $delivered_address);
    
    if ($stmt->execute()) {
        $response = array('status' => 'success', 'message' => 'Order placed successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Error placing order', 'error' => $stmt->error);
    }

    $stmt->close();
    $mysqli->close();

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    echo json_encode($response);
}
?>