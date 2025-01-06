<?php
session_start();
include('../config/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_address"])) {
    // Validate form fields
    $requiredFields = ["full_name_edit", "phone_number_edit", "address_region_edit", "postal_code_edit", "street_name_edit"];
    $errors = [];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
        }
    }

    if (empty($errors)) {
        // Sanitize and retrieve user data from the form
        $full_name_edit = mysqli_real_escape_string($conn, $_POST["full_name_edit"]);
        $phone_number_edit = mysqli_real_escape_string($conn, $_POST["phone_number_edit"]);
        $address_region_edit = mysqli_real_escape_string($conn, $_POST["address_region_edit"]);
        $postal_code_edit = mysqli_real_escape_string($conn, $_POST["postal_code_edit"]);
        $street_name_edit = mysqli_real_escape_string($conn, $_POST["street_name_edit"]);

        // Update the address in the 'addresses' table using prepared statement
        $updateQuery = "UPDATE addresses SET full_name=?, phone_number=?, address_region=?, postal_code=?, street_name=? WHERE user_id=?";
        $stmt_update = mysqli_prepare($conn, $updateQuery);

        if ($stmt_update) {
            mysqli_stmt_bind_param($stmt_update, "sssssi", $full_name_edit, $phone_number_edit, $address_region_edit, $postal_code_edit, $street_name_edit, $_SESSION['user_id']);

            if (mysqli_stmt_execute($stmt_update)) {
                // Handle success if needed
                echo "<script>alert('Address updated successfully!');</script>";
                echo "<script>window.location.href = 'address.php';</script>";
                exit();
            } else {
                $errors[] = "Error updating address: " . mysqli_stmt_error($stmt_update);
            }

            mysqli_stmt_close($stmt_update);
        } else {
            $errors[] = "Error preparing statement: " . mysqli_error($conn);
        }
    }

    // Output errors as JSON (you may modify this part based on your needs)
    echo json_encode(["errors" => $errors]);
}
?>