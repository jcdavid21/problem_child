<?php
include_once "config/dbcon.php";
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM product WHERE product_name LIKE ?";
$stmt = $conn->prepare($query);
$searchParam = "%$searchQuery%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productName = $row['product_name'];
        $productImage = str_replace('./uploads/', 'uploads/', $row['product_image']);
        $price = $row['price'];
        $prod_id = $row['product_id'];
        echo "
        <div class='column'>
            <div class='card'>
                <div class='container page-wrapper'>
                    <div class='page-inner'>
                        <div class='row'>
                            <div class='el-wrapper'>
                                <div class='box-up'>
                                    <img class='img1' style='width: 164px; height: 234px' src='admin_panel/$productImage' alt='$productName'>
                                    <div class='img-info'>
                                        <div class='info-inner'>
                                            <span class='p-name'>$productName</span>
                                            <span class='p-company'>Problem Child</span>
                                        </div>
                                        <div class='a-size'>Available sizes : <span class='size'>S , M , L , XL</span></div>
                                    </div>
                                </div>
                                <div class='box-down'>
                                    <div class='h-bg'>
                                        <div class='h-bg-inner'></div>
                                    </div>
                                    <a class='cart' href='./productpage/product.php?product_id=$prod_id'>
                                        <span class='price'>₱$price.00</span>
                                        <span class='add-to-cart'>
                                            <span class='txt'>Add in cart</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
    }
} else {
    echo "<p>No products found for your search.</p>";
}
?>
