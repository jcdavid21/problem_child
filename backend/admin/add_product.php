<?php
session_start();
require_once("../reports/reports.php");

if (isset($_POST["prod_name"]) && isset($_POST["prod_price"]) &&
    isset($_POST["prod_type"]) && isset($_FILES["prod_img"]) && isset($_POST["prod_small_stock"]) &&
    isset($_POST["prod_medium_stock"]) && isset($_POST["prod_large_stock"]) &&
    isset($_POST["prod_extra_large_stock"]) && isset($_POST["prod_desc"]) &&
    isset($_POST["small_size_id"]) && isset($_POST["medium_size_id"]) &&
    isset($_POST["large_size_id"]) && isset($_POST["extra_large_size_id"])) {

    $admin_id = $_SESSION["user_id"];
    $prod_name = $_POST['prod_name'];
    $prod_price = $_POST['prod_price'];
    $prod_type = $_POST['prod_type'];

    $prod_small_stock = $_POST["prod_small_stock"];
    $prod_medium_stock = $_POST["prod_medium_stock"];
    $prod_large_stock = $_POST["prod_large_stock"];
    $prod_extra_large_stock = $_POST["prod_extra_large_stock"];
    $prod_desc = $_POST["prod_desc"];
    $small_size_id = $_POST["small_size_id"];
    $medium_size_id = $_POST["medium_size_id"];
    $large_size_id = $_POST["large_size_id"];
    $extra_large_size_id = $_POST["extra_large_size_id"];

    $targetDir = "../../admin_panel/uploads/";
    $targetDirHover = "../../images/zoom/";
    $prod_img_name = null;


    // Upload Main Product Image
    if (isset($_FILES['prod_img'])) {
        $prod_img = $_FILES['prod_img'];
        $targetFile = $targetDir . basename($prod_img['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif", "webp"])) {
            echo "error_image_format";
            exit();
        }

        if (!move_uploaded_file($prod_img["tmp_name"], $targetFile)) {
            echo "error_uploading_image";
            exit();
        }
        $prod_img_name = "uploads/" . $prod_img['name'];
    }

    $current_date = date("Y-m-d");
    $prod_id = null;

    // Insert Product Details
    $query = "INSERT INTO product (product_name, product_desc, product_image, price, category_id, uploaded_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        // Debug if the `prepare` method fails
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>";
        exit();
    }

    // Bind parameters to the query
    $stmt->bind_param("sssdss", $prod_name, $prod_desc, $prod_img_name, $prod_price, $prod_type, $current_date);

    // Execute the query
    if ($stmt->execute()) {
        $prod_id = $conn->insert_id;
    } else {
        // Debug the execution failure
        echo "Error inserting data: (" . $stmt->errno . ") " . $stmt->error . "<br>";
        echo "Query: " . $query . "<br>";
        echo "Parameters: <br>";
        echo "Product Name: $prod_name<br>";
        echo "Description: $prod_desc<br>";
        echo "Image Name: $prod_img_name<br>";
        echo "Price: $prod_price<br>";
        echo "Category ID: $prod_type<br>";
        echo "Uploaded Date: $current_date<br>";
        exit();
    }


    // Insert Size Variations
    $query2 = "INSERT INTO product_size_variation (product_id, size_id, quantity_in_stock) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($query2);

    $stmt2->bind_param("iii", $prod_id, $small_size_id, $prod_small_stock);
    $stmt2->execute();

    $stmt2->bind_param("iii", $prod_id, $medium_size_id, $prod_medium_stock);
    $stmt2->execute();

    $stmt2->bind_param("iii", $prod_id, $large_size_id, $prod_large_stock);
    $stmt2->execute();

    $stmt2->bind_param("iii", $prod_id, $extra_large_size_id, $prod_extra_large_stock);
    $stmt2->execute();

    // Handle Hover Images
    $hover_images = ['first_hover_img', 'second_hover_img', 'third_hover_img'];
    $hover_image_names = ['first_img', 'second_img', 'third_img'];

    $hover_data = [];
    foreach ($hover_images as $key => $hover_img) {
        if (isset($_FILES[$hover_img])) {
            $img = $_FILES[$hover_img];
            $targetFileHover = $targetDirHover . basename($img['name']);
            $imageFileTypeHover = strtolower(pathinfo($targetFileHover, PATHINFO_EXTENSION));

            if (!in_array($imageFileTypeHover, ["jpg", "png", "jpeg", "gif", "webp"])) {
                echo "error_image_format";
                exit();
            }

            if (!move_uploaded_file($img["tmp_name"], $targetFileHover)) {
                echo "error_uploading_image";
                exit();
            }

            $hover_data[$hover_image_names[$key]] = $img['name'];
        }
    }

    // Insert or Update tbl_product_details
    $query3 = "INSERT INTO tbl_product_details (product_id, first_img, second_img, third_img) 
           VALUES (?, ?, ?, ?) 
           ON DUPLICATE KEY UPDATE first_img = VALUES(first_img), second_img = VALUES(second_img), third_img = VALUES(third_img)";
    $stmt3 = $conn->prepare($query3);

    // Ensure that null values are properly passed as strings
    $first_img = isset($hover_data['first_img']) ? $hover_data['first_img'] : null;
    $second_img = isset($hover_data['second_img']) ? $hover_data['second_img'] : null;
    $third_img = isset($hover_data['third_img']) ? $hover_data['third_img'] : null;

    $stmt3->bind_param("isss", $prod_id, $first_img, $second_img, $third_img);
    $stmt3->execute();


    // Log admin action
    $query2 = "SELECT CONCAT(first_name, ' ', last_name) as ac_username FROM users WHERE user_id=?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("i", $admin_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();
    $username = $row["ac_username"];

    $activity = "Added new product: $prod_name";
    $type = "Admin";
    if (!report($conn, $admin_id, $username, $activity, $type)) {
        echo "error_logging_action";
        exit();
    }

    echo "success";
} else {
    echo "error_invalid_request";
}
?>
