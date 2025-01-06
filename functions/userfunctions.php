<?php
session_start();
include("../config/dbcon.php");

function getCartItems()
{
    global $conn;
    $userId = $_SESSION['user_id'];

    // Use prepared statement to prevent SQL injection
    $query = "SELECT c.cart_id, p.product_id, s.size_id, p.product_name, p.price, p.product_image, c.quantity, s.size_name, c.checkbox
              FROM cart c
              JOIN product_size_variation v ON c.variation_id = v.variation_id 
              JOIN product p ON v.product_id = p.product_id
              JOIN sizes s ON v.size_id = s.size_id
              WHERE c.user_id = ? AND c.status_id = 0
              ORDER BY c.cart_id DESC";

    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return $result;
}

function getAddress(){
    global $conn;

    $userId = $_SESSION['user_id'];

    $query = "SELECT a.address_id, a.full_name, a.phone_number, a.address_region, a.postal_code, a.street_name, a.address_default
              FROM addresses a
              WHERE a.user_id = ?";

    $stmt = mysqli_prepare($conn, $query);

    // Check for prepare error
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check for execute error
    if (mysqli_stmt_errno($stmt)) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
    }

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if (!$result) {
        die("Get result failed: " . mysqli_error($conn));
    }

    return $result;
}

function getCheckOut() {
    global $conn;

    $userId = $_SESSION['user_id'];

    $query = "SELECT c.cart_id, p.product_id, s.size_id, p.product_name, p.price, c.price, p.product_image, c.quantity, s.size_name, c.checkbox
                FROM cart c
                JOIN product_size_variation v ON c.variation_id = v.variation_id 
                JOIN product p ON v.product_id = p.product_id
                JOIN sizes s ON v.size_id = s.size_id
                WHERE c.user_id = ?";

    $stmt = mysqli_prepare($conn, $query);

    // Check for prepare error
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check for execute error
    if (mysqli_stmt_errno($stmt)) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
    }

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check if the query was successful
    if (!$result) {
        die("Get result failed: " . mysqli_error($conn));
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
}
?>