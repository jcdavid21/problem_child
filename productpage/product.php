<!-- c:/xampp/htdocs/project_revise/indextest.html -->
<?php
session_start();
include('../config/dbcon.php');

$product_id = $_GET['product_id'];


// Fetch product details
$query = "SELECT product_id, product_name, product_image, price FROM product WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching product: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$productName = $row['product_name'];
$productImage = str_replace('./uploads/', 'uploads/', $row['product_image']);
$price = $row['price'];

// Fetch available sizes for the product
$sizeQuery = "SELECT size_id, size_name FROM sizes";
$sizeResult = mysqli_query($conn, $sizeQuery);

$sizes = array();
if ($sizeResult) {
    while ($sizeRow = mysqli_fetch_assoc($sizeResult)) {
        $sizes[] = $sizeRow;
    }
} else {
    die("Error fetching sizes: " . mysqli_error($conn));
}

$selectedSize = isset($_POST['selectedSize']) ? mysqli_real_escape_string($conn, $_POST['selectedSize']) : ($sizes[0]['size_name'] ?? null);

if (!$selectedSize) {
    die("No sizes available.");
}

// Fetch variation_id based on the selected product and size
$variationQuery = "
    SELECT variation_id 
    FROM product_size_variation 
    WHERE product_id = $product_id 
    AND size_id = (
        SELECT size_id 
        FROM sizes 
        WHERE size_name = '$selectedSize'
    )
";

$variationResult = mysqli_query($conn, $variationQuery);

if (!$variationResult) {
    die("Error fetching variation_id: " . mysqli_error($conn));
}

$variationRow = mysqli_fetch_assoc($variationResult);
$variation_id = $variationRow['variation_id'] ?? null;

if (!$variation_id) {
    echo "No variation available for the selected size.";
}

// Now $variation_id contains the variation_id for the selected product and size
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font-awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- swiperjs Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Problem Child</title>
    <style>
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }


        
        /* CSS FOR BODY */
        .main_container form{
            display: flex;
        }

        .image_container {
            width: 40%;
            height: 700px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .image_box {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 600px;
            width: 100%;
        }
        .main_image {
            width: 500px; 
            height: 500px;
        }

        .product_container {
            width: 60%;
            padding: 40px 0 0 20px;
        }

        .product_box {
            display: flex;
            flex-direction: column;
            font-family: 'glacial_indifferenceregular';
        }

        .product_name {
            font-size: 39px;
            font-weight: bold;
        }

        .product_price {
            margin-top: 20px;
            display: flex;
            flex-direction: row;
            font-size: 30px;
            font-weight: bold;
        }

        .size_selection {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .size_box {
            width: 80px;
            height: 30px;
            border: 1px solid #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .size_box:hover {
            background: #000000;
            color: white;
        }
        .size_box.selected {
            background: #000000;
            color: white;
        }
        .product_size{
            margin: 15px 0 0 0;
        }
        .quantity_container {
            flex: 1;
            display: flex;
            flex-direction: row;
            gap: 50px;
        }

        .quantity_container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .quantity_container input {
            width: 70px;
            padding: 5px;
            text-align: center;
            margin: 10px auto;
        }
        .quantity{
            margin-top: 15px;
        }
        .buttonborder{
            border-style: solid;
            border-width: 1px;
            height: 50px;
            width: 150px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
        }
        .minus-btn {
            font-size: 20px;
            width: 30px;
            height: 30px;
            border: none;
            background-color: #F6F5F0;
        }
        .plus-btn {
            font-size: 20px;
            width: 30px;
            height: 30px;
            margin-top: 9px;
            border: none;
            background-color: #F6F5F0;
        }
        #searchFormDesktop button, #searchFormMobile button{
            background: transparent;
            border: none;
            cursor: pointer;
        }
        .number{
            width: 50px;
            height: 30px;
            border: none;
            background: #F6F5F0;
        }
        .btn_add{
            height: 50px;
            width: 150px;
            border-radius: 10px;
            background-color: #000000;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn_add:hover{
            background-color: #2E2E2E;
        }
        .details_container{
            display: flex;
            width: 100%;
            height: auto;
        }
        .details{
            width: 100%;
            height: auto;
        }
        .details_title{
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .image_container1{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            gap: 10px;
        }
        .image_container1 .image{
            width: 250px;
            height: 250px;
            cursor: pointer;
        }
        .image_container1 .image:hover{
            border: 1px solid #F6F5F0;
        }
        @media screen and (max-width: 1300px){
            .image_container{
                height: 650px;
            }
            .image_box img{
                width: 400px;
                height: auto;
            }
        }
        @media screen and (max-width: 1000px){
            .image_container{
                height: 600px;
            }
            .image_box img{
                width: 300px;
                height: auto;
            }
        }
        @media screen and (max-width: 800px){
            .image_container{
                height: 600px;
            }
            .image_box img{
                width: 250px;
                height: auto;
            }
        }
        @media screen and (max-width: 650px){
            .image_container{
                height: max-content;
                width: 100%;
            }
            .image_box img{
                height: 250px;
                width: 100%;
                object-fit: contain;
            }
        }



        /* CSS FOR FOOTER */
        .logo2{
            max-width: 291px;
        }
        .logo2 img{
            width: 60%;
            margin-left: 50px;
        }
        .container1{
            max-width: 1170px;
            margin: auto;
        }
        .row1{
            display: flex;
            flex-wrap: wrap;
        }
        footer{
            background-color: black;
            padding: 50px 0;
        }
        .footer-col{
            width: 25%;
            padding: 0 15px;
        }
        .footer-col h4{
            font-size: 18px;
            color: #ffffff;
            text-transform: capitalize;
            margin-bottom: 35px;
            font-weight: 500;
            position: relative;
        }
        .footer-col h4::before{
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            background-color: #fff;
            height: 2px;
            box-sizing: border-box;
            width: 50px;
        }
        .footer-col ul li:not(:last-child){
            margin-bottom: 10px;
        }
        .footer-col ul li a{
            font-size: 16px;
            text-transform: capitalize;
            color: #ffffff;
            font-weight: 300;
            color: #bbbbbb;
            display: block;
        }
        .footer-col ul li a:hover{
            color: #ffffff;
            padding-left: 8px;
        }
        .footer-col .social-links a{
            display: inline-block;
            height: 40px;
            width: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            margin: 0 10px 10px 0;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: #ffffff;
            transition: all 0.5s ease;
        }
        .footer-col .social-links a:hover{
            color: #24262b;
            background-color: #ffffff;
        }
        footer p{
            color: white;
            text-align: center;
            margin-top: 50px;
        }

        /* MEDIA QUERIES */
        @media(max-width: 1344){
          nav .box:hover input{
            width: 130px;
          }
        }
        @media(max-width: 1200px){
            nav .box input{
                width: 0px;
            }
            .hideOnMobile{
                display: none;
            }
            .menu-button{
                display: block;
            }
        }
        @media(max-width: 1170){
          .footer-col{
            width: 10px;
          }
        }
        @media(max-width: 768px){
            .footer-col{
                width: 50%;
                margin-bottom: 30px;
            }

            .flex-con .name h4{
                font-size: 16px;
            }

            .flex-con .comment{
                font-size: 14px;
                line-height: 20px;
            }
        }
        @media(max-width: 574px){
            .footer-col{
                width: 100%;
            }
            .logo2 img{
                margin-left: 80px;
            }
            
            .quantity_container{
                width: 220px;
                gap: 10px;
            }

            .quantity_container input{
                width: 15px;
            }

        }
        @media(max-width: 500px){
            .sidebar{
                width: 100%;
            }
            nav .name{
                font-size: 28.5px;
            }
            .logo2 img{
                margin-left: 80px;
            }

            .test-con .flex-con .left img{
                height: 20px;
                width: 20px;
            }
        }
        @media(max-width: 399px){
            nav .name{
                font-size: 25px;
            }
        }

        @media (max-width: 900px) {
            #addToCartForm {
                flex-direction: column;
            }

            .image_container .image_box{
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .image_container {
                width: 100%;
                height: max-content;
            }

            .image_container1{
                display: grid !important;
                grid-template-columns: repeat(3, 1fr);
                justify-content: space-between;
            }

            .image_container1 .image{
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .testimonials .test-con .title-con{
                font-size: 16px;
            }

            .testimonials .test-con .name{
                display: flex;
                flex-direction: column;
                align-items: start;
                justify-content: start;
            }

            .testimonials .test-con .name p, .testimonials .test-con .name h4{
                font-size: 14px;
                line-height: 16px;
            }

        }

    
    
         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="../styles/reviews.css">
    <link rel="stylesheet" href="../styles/navbar.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include_once "../components/nav.php"; ?>


    <!-- BODY -->
    <div class="main_container">
        <form id="addToCartForm">
            <input type="hidden" name="selectedSize" id="selectedSize" value="">
            <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id; ?>" hidden>
            <input type="hidden" name="variationId" id="variationId" value="<?php echo $variation_id; ?>">
            <input type="hidden" name="price" id="price" value="<?php echo $price; ?>">
            <input type="hidden" name="quantity" id="quantityInput" value="1">
            <div class="image_container">
                <div class="image_box">
                    <img class="main_image" src="../admin_panel/<?php echo $productImage; ?>" alt="Main Image">
                </div>
            </div>
            <div class="product_container">
                <div class="product_box">
                    <h1 class="product_name"><?php echo $productName; ?></h1>
                    <div class="product_price">
                        <div class="total" style="margin-right: 5px;">&#8369;</div>
                        <div id="displayPrice"><?php echo $price; ?></div>
                        <div class="secondary">.00</div>
                    </div>
                    <p class="product_size">Size: </p>
                    <div class="size_selection">
                        <?php
                        foreach ($sizes as $size) {
                            echo '<div class="size_box" onclick="toggleSize(this)" data-size="' . $size['size_name'] . '" data-size-id="' . $size['size_id'] . '">' . $size['size_name'] . '</div>';
                        }
                        ?>
                    </div>
                    <p class="quantity">Quantity:</p>
                    <div class="quantity_container">
                        <div class="buttonborder">
                            <button class="btn minus-btn disabled" type="button" disabled="disabled">-</button>
                            <input class="number" type="text" id="quantityInput1" value="1">
                            <button class="btn plus-btn" type="button">+</button>
                        </div>
                        <button type="submit" class="btn_add submit" name="add_to_cart">Add to Cart</button>
                    </div>
                    <div class="details_container">
                        <div class="details">
                            <p class="details_title">Details:</p>
                            <div class="image_container1">
                                <?php 
                                 $query_imgs = "SELECT * FROM tbl_product_details WHERE product_id = $product_id";
                                    $result_imgs = mysqli_query($conn, $query_imgs);

                                    if(mysqli_num_rows($result_imgs) > 0){
                                        $row_imgs = mysqli_fetch_assoc($result_imgs);

                                        if($row_imgs['first_img'] != "" || $row_imgs['first_img'] != null){
                                            echo '<img class="image" src="../images/zoom/' . $row_imgs['first_img'] . '" alt="">';
                                        }

                                        if($row_imgs['second_img'] != "" || $row_imgs['second_img'] != null){
                                            echo '<img class="image" src="../images/zoom/' . $row_imgs['second_img'] . '" alt="">';
                                        }

                                        if($row_imgs['third_img'] != "" || $row_imgs['third_img'] != null){
                                            echo '<img class="image" src="../images/zoom/' . $row_imgs['third_img'] . '" alt="">';
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                                    

        </form>
    </div>

    <!-- Reviews -->
    <div class="testimonials">
        <div class="test-con">
            <div class="title-con">Reviews</div>

            <?php 
                $queryReview = "SELECT tf.*, CONCAT(tu.first_name, ' ', tu.last_name) as full_name, tu.picture_path, tp.product_name, ts.size_name FROM tbl_feedback tf
                INNER JOIN users tu ON tu.user_id = tf.user_id
                INNER JOIN product tp ON tp.product_id = tf.product_id
                INNER JOIN product_size_variation tpsv ON tpsv.variation_id = tf.variation_id
                INNER JOIN sizes ts ON ts.size_id = tpsv.size_id
                WHERE tf.product_id = $product_id";
                $resultReview = mysqli_query($conn, $queryReview);

                if(mysqli_num_rows($resultReview) > 0){
                    while($rowReview = mysqli_fetch_assoc($resultReview)){
                        $formatted_date = date("F j, Y", strtotime($rowReview["fd_date"]));
            ?>

            <div class="flex-con">
                <div class="left">
                    <img src="<?php echo $rowReview["picture_path"] ?>" alt="">
                </div>
                <div class="right">
                    
                    <div class="name">
                        <h4>
                            <?php echo $rowReview["full_name"] ?>
                        </h4>
                        <p>
                            <?php echo $formatted_date ?>
                        </p>
                    </div>
                    <div class="item-name">
                        <p >Item: 
                            <?php echo $rowReview["product_name"] ?>
                        </p>
                        <p>Size: 
                            <?php echo $rowReview["size_name"] ?>
                        </p>
                    </div>
                    <div class="comment">
                        <p>
                            <?php echo $rowReview["fd_comment"] ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
                    }
                }else{
                    echo "<h4>No reviews yet</h4>";
                }
            ?>
            
        </div>
    </div>

    <script>
        document.querySelector(".minus-btn").setAttribute("disabled", "disabled");

        var valueCount;
        var price = parseFloat(document.getElementById("price").value); // Parse the price as a float

        function priceTotal() {
            var total = valueCount * price;
            document.getElementById("displayPrice").innerText = total.toFixed(0); // Format total to two decimal places
            updateQuantity(); // Call the function to update quantity
        }

        document.querySelector(".plus-btn").addEventListener("click", function () {
        valueCount = document.getElementById("quantityInput1").value; // Update to "quantityInput1"
        valueCount++;

        // Check if the valueCount exceeds 10
        if (valueCount > 10) {
            valueCount = 10;
        }

        document.getElementById("quantityInput1").value = valueCount; // Update to "quantityInput1"

        if (valueCount > 1) {
            document.querySelector(".minus-btn").removeAttribute("disabled");
            document.querySelector(".minus-btn").classList.remove("disabled");
        }
        priceTotal();
        });

        document.querySelector(".minus-btn").addEventListener("click", function () {
        valueCount = document.getElementById("quantityInput1").value; // Update to "quantityInput1"
        valueCount--;

        // Check if the valueCount is less than 1
        if (valueCount < 1) {
            valueCount = 1;
        }

        document.getElementById("quantityInput1").value = valueCount; // Update to "quantityInput1"

        if (valueCount == 1) {
            document.querySelector(".minus-btn").setAttribute("disabled", "disabled");
        }
        priceTotal();
        });

        // Function to update the quantity in the hidden input field
        function updateQuantity() {
            document.getElementById("quantityInput").value = valueCount;
        }

        function toggleSize(element) {
        var selectedSize = element.getAttribute("data-size");
        document.getElementById("selectedSize").value = selectedSize;

        // Remove any previous selection
        document.querySelectorAll('.size_box').forEach(function (sizeBox) {
            sizeBox.style.border = '1px solid #ccc';
        });

        // Highlight the selected size
        element.style.border = '2px solid #3498db';

        // Fetch the corresponding size_id based on the selected size
        var sizeId = <?php echo json_encode(array_flip($sizes)); ?>[selectedSize];
        var variationId = sizeId ? sizeId + 12 : null;
        document.getElementById("variationId").value = variationId;
        }

    </script>

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


    <script>
        // Get the main image element
        const mainImage = document.querySelector('.main_image');

        // Get all image elements in the image_container1
        const images = document.querySelectorAll('.image_container1 .image');

        // Add event listeners to each image
        images.forEach(image => {
        image.addEventListener('mouseover', () => {
            mainImage.src = image.src;
            mainImage.style.width = '500px';
            mainImage.style.height = '500px';
        });

        image.addEventListener('mouseout', () => {
            mainImage.src = "../admin_panel/<?php echo $productImage; ?>";
            mainImage.style.width = '500px';
            mainImage.style.height = '500px';
        });
        });
    </script>



    
    



    <!-- FOOTER -->
    <footer class="footer">
        <div class="container1">
            <div class="row1">
                <div class="logo2">
                    <a href="home.php"><img  src="../picture/icon/logo1.png" alt=""></a>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../shop/shop.php">Shop</a></li>
                        <li><a href="../sizechart/sizechart.php">Size Chart</a></li>
                        <li><a href="../contact/contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="../faq/faq.php">FAQ</a></li>
                        <li><a href="../about/about.php">About Us</a></li>
                        <li><a href="../privacypolicy/privacypolicy.php">Privacy Policy</a></li>
                        <li><a href="../terms/terms.php">Terms & Conditions</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/thePrblmChld"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/problemchildswc"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/problemchild.swc"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <p>&copy; Copyright © Problem Child. All rights reserved.</p>
        </div>
        
    </footer>
    
    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'flex';
        }

        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'none';
        }

        // Automatically close sidebar if width is 900px or more
        function handleResize() {
            const sidebar = document.querySelector('.sidebar');
            if (window.innerWidth >= 900) {
                sidebar.style.display = 'none';
            }
        }

        // Add event listener for resize
        window.addEventListener('resize', handleResize);
    </script>

    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>
    <script src="../jquery/addtocart.js"></script>
</body>
</html>