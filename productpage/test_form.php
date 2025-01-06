<?php
session_start();
include('../config/dbcon.php');

$product_id = 1;
$category_id = 1;

// Fetch product details
$query = "SELECT product_name, product_image, price FROM product WHERE product_id = $product_id AND category_id = $category_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching product: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$productName = $row['product_name'];
$productImage = $row['product_image'];
$price = $row['price'];

// Replace the initial part of the image path
$productImage = str_replace('./uploads/', 'uploads/', $productImage);

// Fetch available sizes for the product
$sizeQuery = "SELECT size_id, size_name FROM sizes";
$sizeResult = mysqli_query($conn, $sizeQuery);

$sizes = array();
if ($sizeResult) {
    while ($sizeRow = mysqli_fetch_assoc($sizeResult)) {
        $sizes[$sizeRow['size_id']] = $sizeRow['size_name'];
    }
} else {
    die("Error fetching sizes: " . mysqli_error($conn));
}

// If $selectedSize is not yet chosen, set it to the first size in the array
$selectedSize = isset($_POST['selectedSize']) ? $_POST['selectedSize'] : reset($sizes);

// Fetch variation_id based on the selected product and size
$variationQuery = "SELECT variation_id FROM product_size_variation WHERE product_id = $product_id AND size_id = (SELECT size_id FROM sizes WHERE size_name = '$selectedSize')";
$variationResult = mysqli_query($conn, $variationQuery);

if (!$variationResult) {
    die("Error fetching variation_id: " . mysqli_error($conn));
}

$variationRow = mysqli_fetch_assoc($variationResult);
$variation_id = $variationRow['variation_id'];

// Now $variation_id contains the variation_id for the selected product and size
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .size_box {
            cursor: pointer;
            margin: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            display: inline-block;
        }
        .size_box:hover{
            border: 1px solid #000;
        }
        .selected {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <form id="testForm" action="test_process.php" method="post">
        <input type="hidden" name="selectedSize" value="">
        <input type="hidden" name="variationId" value="<?php echo $variation_id; ?>">
        <input type="hidden" name="price" value="<?php echo $price; ?>">
        <input type="hidden" name="quantity" value="1">

        <button type="submit" name="add_to_cart">Test Form Submission</button>

        <p class="product_size">Size: </p>
        <div class="size_selection">
            <?php
            foreach ($sizes as $size) {
                echo '<div class="size_box" onclick="toggleSize(this)" data-size="' . $size . '">' . $size . '</div>';
            }
            ?>
        </div>

        <script>
            let selectedSizeElement = null;

            function toggleSize(element) {
                if (selectedSizeElement !== null) {
                    // If a size is already selected, remove the 'selected' class
                    selectedSizeElement.classList.remove('selected');
                }

                // Toggle 'selected' class on the clicked size box
                element.classList.toggle('selected');

                // Update the selectedSizeElement variable
                selectedSizeElement = element.classList.contains('selected') ? element : null;

                // Update the product_size element and the hidden input field value
                updateProductSize();
            }

            function updateProductSize() {
                const productSizeElement = document.querySelector('.product_size');
                const hiddenInput = document.querySelector('input[name="selectedSize"]');

                if (selectedSizeElement !== null) {
                    const selectedSize = selectedSizeElement.getAttribute('data-size');
                    productSizeElement.textContent = 'Size: ' + selectedSize;

                    // Set the value attribute of the hidden input field
                    hiddenInput.value = selectedSize;
                } else {
                    productSizeElement.textContent = 'Size: ';

                    // Reset the value attribute of the hidden input field
                    hiddenInput.value = '';
                }
            }
        </script>
    </form>
</body>
</html>