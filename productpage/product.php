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
    <!-- font-awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- swiperjs Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <title>Problem Child</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap');
        @import url('http://fonts.googleapis.com/css2?family=Poppins&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        @font-face {
            font-family: 'glacial_indifferenceregular';
            src: url('glacialindifference-regular-webfont.woff2') format('woff2'),
                url('glacialindifference-regular-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        @font-face{
            font-family: Horizon;
            src:url(../font/horizon.otf);
        }
        *{
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0;
            font-family: Horizon;
            overflow-x: hidden;
        }
        html{
            height: 100%;
        }
        /* CSS FOR NAVIGATION BAR */
        nav{
            background-color: #FAE9D7;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
        }
        nav ul{
            width: 100%;
            list-style: none;
            display: flex;
            align-items: center;
        }
        nav li{
            height: 80px;
        }
        nav .logo{
            width: 10%;
            margin-right: 5%;
        }
        nav .name{
            height: 100%;
            padding: 0 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            color: black;
            text-decoration: none;
            font-family: 'Archivo Black', sans-serif;
            font-weight: bold;
            font-size: 35px;
        }

        nav .active{
            height: 100%;
            padding: 0 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            color: black;
            text-decoration: none;
            font-family: 'glacial_indifferenceregular';
            font-weight: 300;
            font-size: 20px;
        }

        nav .active:hover{
            background-color: #FAE9D7;
            height: 80%;
        }
        nav li:first-child{
            margin-right: auto;
        }

        .sidebar{
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 250px;
            z-index: 999;
            background-color: #fae9d749;
            backdrop-filter: blur(10px);
            box-shadow: -10px 0 10px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }
        .sidebar li{
            width: 100%;
        }
        .sidebar a{
            width: 100%;
        }


        nav .box{
            margin-top: 20px;
            margin-right: 15px;
            height: 40px;
            display: flex;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 30px;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }
        nav .box:hover input{
            width: 180px;
        }
        nav .box input{
            width: 0;
            outline: none;
            border: none;
            font-weight: 500;
            transition: 0.8s;
            background: transparent;
        }

        nav .box a .fa{
            color: #FAE9D7;
            font-size: 18px;
        }
        nav svg{
            margin-top: 25px;
        }

        nav .cart1 a i{
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 32px;
            width: 35px;
        }
        nav .cart1 a{
            text-decoration: none;
        }
        nav .user a i {
          color: black;
          display: flex;
          justify-content: center;
          align-items: center;
          margin-top: 32px;
          width: 35px;
        }
        nav .user a{
            text-decoration: none;
        }
        nav .login a button{
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin-right: 5px;
            margin-left: 5px;
        }
        nav .login a{
            text-decoration: none;
        }
        .button-74 {
          background-color: #fbeee0;
          border: 2px solid #422800;
          border-radius: 30px;
          box-shadow: #422800 4px 4px 0 0;
          color: #422800;
          cursor: pointer;
          display: inline-block;
          font-weight: 600;
          font-size: 18px;
          padding: 0 18px;
          line-height: 35px;
          text-align: center;
          text-decoration: none;
          user-select: none;
          -webkit-user-select: none;
          touch-action: manipulation;
        }

        .button-74:hover {
          background-color: #fff;
        }

        .button-74:active {
          box-shadow: #422800 2px 2px 0 0;
          transform: translate(2px, 2px);
        }


        .menu-button{
            display: none;
        }
        /* Add this style to hide the menu by default */
        .user-menu {
          display: none;
          position: absolute;
          top: 59px;
          right: 95px;
          width: 150px;
          background-color: #fff;
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
          border-radius: 5px;
          z-index: 1;
        }

        .user-menu::before {
          content: '';
          position: absolute;
          top: -10px;
          right: 7px;
          border-style: solid;
          border-width: 0 15px 15px 15px;
          border-color: transparent transparent #fff transparent;
        }

        .user-menu a {
          display: block;
          padding: 10px;
          text-decoration: none;
          color: #333;
          font-size: 13px;
        }

        .user-menu a:hover {
          background-color: #FFF7EE;
        }

        .user:hover .user-menu {
          display: block;
        }

        .user:hover .user-menu:hover {
          display: block;
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
                height: 600px;
                width: 100%;
            }
            .image_box img{
                width: auto;
                height: auto;
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
        }

    
    
         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="../styles/reviews.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include_once "../components/nav.php"; ?>


    <!-- BODY -->
    <div class="main_container">
        <form id="addToCartForm" action="process_cart.php" method="post">
            <input type="hidden" name="selectedSize" id="selectedSize" value="">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" hidden>
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
                            echo '<div class="size_box" onclick="toggleSize(this)" data-size="' . $size . '">' . $size . '</div>';
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
                        <button type="submit" class="btn_add" name="add_to_cart">Add to Cart</button>
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

        document.querySelector(".btn_add").addEventListener("click", function (event) {
            // Ensure that a size has been selected before submitting the form
            if (document.getElementById("selectedSize").value === "") {
                event.preventDefault();
                alert("Please select a size before adding to cart.");
            }
        });
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
</body>
</html>