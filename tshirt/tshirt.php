<!-- c:/xampp/htdocs/project_revise/indextest.html -->
<?php 
session_start();
include_once "../config/dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font-awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Problem Child</title>
    <style>

        
        /* CSS FOR BODY */
        .product_title{
          font-family: Horizon;
        }
        #slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }
        #prev{
          border-radius: 50%; 
          width: 50px; 
          height: 50px; 
          margin-left: 5px; 
          padding-left: 5px; 
          display: flex; 
          justify-content: center; 
          align-items: center;
        }
        #prev:hover{
          background-color: #bbbbbb;
        }
        #next{
          border-radius: 50%; 
          width: 50px; 
          height: 50px; 
          margin-right: 5px; 
          padding-right: 5px; 
          display: flex; 
          justify-content: center; 
          align-items: center;
        }
        #next:hover{
          background-color: #bbbbbb;
        }
        #slider {
            width: 100%;
            display: flex;
            transition: transform 0.5s;
        }

        .slide {
            min-width: 100%;
        }

        .slide img {
            width: 100%;
            height: auto;
        }

        #prev, #next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        #prev {
            left: 10px;
        }

        #next {
            right: 10px;
        }

        /* CSS FOR PRODUCT */
        h1{
            text-align: center;
            margin: 30px;

        }
        .d-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .align-center {
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .flex-centerY-centerX {
            justify-content: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-wrapper {
            height: 100%;
            display: table;
            }

        .page-wrapper .page-inner {
            display: table-cell;
            vertical-align: middle;
        }

        .el-wrapper {
            width: 360px;
            background-color: #fff;
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
            margin-top: 50px;
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
                display: block !important;
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

         /* MEDIA QUERIES FOR PRODUCT */
         @media (max-width: 991px) {
            .el-wrapper {
                width: 345px;
            }
        }
        @media(max-width: 1460px){
            .el-wrapper{
                width: 300px;
            }
        }

        .el-wrapper:hover .h-bg {
            left: 0px;
        }

        .el-wrapper:hover .price {
            left: 20px;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            color: #818181;
        }

        .el-wrapper:hover .add-to-cart {
            left: 50%;
        }

        .el-wrapper:hover .img1 {
            -webkit-filter: blur(7px);
            -o-filter: blur(7px);
            -ms-filter: blur(7px);
            filter: blur(7px);
            filter: progid:DXImageTransform.Microsoft.Blur(pixelradius='7', shadowopacity='0.0');
            opacity: 0.4;
        }

        .el-wrapper:hover .info-inner {
            bottom: 155px;
        }

        .el-wrapper:hover .a-size {
            -webkit-transition-delay: 300ms;
            -o-transition-delay: 300ms;
            transition-delay: 300ms;
            bottom: 50px;
            opacity: 1;
        }

        .el-wrapper .box-down {
            width: 100%;
            height: 60px;
            position: relative;
            overflow: hidden;
        }

        .el-wrapper .box-up {
            width: 100%;
            height: 300px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .el-wrapper .img1 {
            padding: 20px 0;
            -webkit-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            -moz-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            -o-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
        }

        .h-bg {
            -webkit-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            -moz-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            -o-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            width: 720px;
            height: 100%;
            background-color: #FAE9D7;
            position: absolute;
            left: -720px;
        }

        .h-bg .h-bg-inner {
            width: 50%;
            height: 100%;
            background-color: #464646;
        }

        .info-inner {
            -webkit-transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
            -moz-transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
            -o-transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
            transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            position: absolute;
            width: 100%;
            bottom: 25px;
        }

        .info-inner .p-name,
        .info-inner .p-company {
            display: block;
        }

        .info-inner .p-name {
            font-family: 'PT Sans', sans-serif;
            font-size: 18px;
            color: #252525;
        }

        .info-inner .p-company {
            font-family: 'Lato', sans-serif;
            font-size: 12px;
            text-transform: uppercase;
            color: #8c8c8c;
        }

        .a-size {
            -webkit-transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
            -moz-transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
            -o-transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
            transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            position: absolute;
            width: 100%;
            bottom: -20px;
            font-family: 'PT Sans', sans-serif;
            color: #828282;
            opacity: 0;
        }

        .a-size .size {
            color: #252525;
        }

        .cart {
            display: block;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            font-family: 'Lato', sans-serif;
            font-weight: 700;
        }

        .cart .price {
            -webkit-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            -moz-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            -o-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-delay: 100ms;
            -o-transition-delay: 100ms;
            transition-delay: 100ms;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            font-size: 16px;
            color: #252525;
        }

        .cart .add-to-cart {
            -webkit-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            -moz-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            -o-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
            /* ease-out */
            -webkit-transition-delay: 100ms;
            -o-transition-delay: 100ms;
            transition-delay: 100ms;
            display: block;
            position: absolute;
            top: 50%;
            left: 110%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

            .cart .add-to-cart .txt {
            font-size: 12px;
            color: #fff;
            letter-spacing: 0.045em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .container .row {
            flex-basis: 100%;
            display: flex;
            justify-content: center;
        }
        /* Media queries for smaller screens */
        @media only screen and (max-width: 600px) {
            .container .row {
                flex-basis: 100%;
            }
        }


        /* Float four columns side by side */
        .column {
            float: left;
            width: 25%;
            padding: 0 10px;
            margin-bottom: 20px;
        }

        /* Remove extra left and right margins, due to padding */
        .row1 {margin: 0 -5px;}

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive columns */
        @media(max-width: 1525px) {
            .column{
                width: 50%;
                display: block;
                margin-bottom: 20px;
            }
        }

        @media screen and (max-width: 765px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            background-color: #f1f1f1;
            height: 390px;
        }
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../styles/navbar.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include '../components/nav.php'; ?>


    <!-- ALL PRODUCTS -->
    <h1 class="product_title">T-SHIRTS</h1>

    <?php

    $category_id = 1;

    $query = "SELECT product_id, product_name, product_image, price FROM product WHERE category_id = ? AND availability = 1";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $category_id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                ?>
                <div class="row1">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $productName = $row['product_name'];
                        $productImage = $row['product_image'];
                        $price = $row['price'];
                        $product_id = $row['product_id'];

                        // Replace the initial part of the image path
                        $productImage = str_replace('./uploads/', 'uploads/', $productImage);
                        ?>
                        <div class="column">
                            <div class="card">
                                <div class="container page-wrapper">
                                    <div class="page-inner">
                                        <div class="row">
                                            <div class="el-wrapper">
                                                <div class="box-up">
                                                    <img class="img1" style="width: 164px; height: 234px" src="../admin_panel/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
                                                    <div class="img-info">
                                                        <div class="info-inner">
                                                            <span class="p-name"><?php echo $productName; ?></span>
                                                            <span class="p-company">Problem Child</span>
                                                        </div>
                                                        <div class="a-size">Available sizes: <span class="size">S, M, L, XL</span></div>
                                                    </div>
                                                </div>

                                                <div class="box-down">
                                                    <div class="h-bg">
                                                        <div class="h-bg-inner"></div>
                                                    </div>

                                                    <a class="cart" href="../productpage/product.php?product_id=<?php echo $product_id; ?>">
                                                        <span class="price">₱<?php echo $price; ?>.00</span>
                                                        <span class="add-to-cart">
                                                            <span class="txt">Add in cart</span>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                mysqli_free_result($result);
            } else {
                echo "Error fetching products: " . mysqli_error($conn);
            }
        } else {
            echo "Error executing statement: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
    ?>

    <!-- FOOTER -->
    <?php include '../components/footer.php'; ?>
    
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
</body>
</html>