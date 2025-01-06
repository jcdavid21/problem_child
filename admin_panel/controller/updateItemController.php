<?php
include_once "../config/dbconnect.php";

// Define the upload path
define('UPLOAD_PATH', './uploads/');

$product_id = $_POST['product_id'];
$p_name = $_POST['p_name'];
$p_desc = $_POST['p_desc'];
$p_price = $_POST['p_price'];
$category = $_POST['category'];

if (isset($_FILES['newImage'])) {
    $location = "./uploads/";
    $img = $_FILES['newImage']['name'];
    $tmp = $_FILES['newImage']['tmp_name'];
    $dir = '../uploads/';
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp');
    $image = rand(1000, 1000000) . "." . $ext;
    $final_image = $location . $image;

    if (in_array($ext, $valid_extensions)) {
        // Update the path to use the defined UPLOAD_PATH
        $path = UPLOAD_PATH . $image;
        move_uploaded_file($tmp, $dir . $image);
    }
} else {
    $final_image = $_POST['existingImage'];
}

// Prepared statement to prevent SQL injection
$stmt = $conn->prepare("UPDATE product SET 
        product_name=?, 
        product_desc=?, 
        price=?,
        category_id=?,
        product_image=? 
        WHERE product_id=?");

// Bind parameters
$stmt->bind_param("ssdiss", $p_name, $p_desc, $p_price, $category, $final_image, $product_id);

// Execute the statement
$updateItem = $stmt->execute();

if ($updateItem) {
    echo "true";
} else {
    // Provide a meaningful error message
    echo "Error updating product: " . $stmt->error;
}

// Close the statement
$stmt->close();
?>