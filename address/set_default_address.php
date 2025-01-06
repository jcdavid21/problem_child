<?php 
session_start();
include('../config/dbcon.php');

// Check if the address ID is set and not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["address_id"])) {
    $address_id = mysqli_real_escape_string($conn, $_POST["address_id"]);

    // Set 'address_default' to 1 for the selected address and 0 for others
    $updateQuery = "UPDATE addresses SET address_default = (CASE WHEN address_id = ? THEN 1 ELSE 0 END) WHERE user_id = ?";
    $stmt_update = mysqli_prepare($conn, $updateQuery);

    if ($stmt_update) {
        mysqli_stmt_bind_param($stmt_update, "ii", $address_id, $_SESSION['user_id']);

        if (mysqli_stmt_execute($stmt_update)) {
            // Address updated successfully
            echo "Address set as default successfully";
        } else {
            echo "Error updating address: " . mysqli_stmt_error($stmt_update);
        }

        mysqli_stmt_close($stmt_update);
    } else {
        echo "Error preparing update statement: " . mysqli_error($conn);
    }
}
?>