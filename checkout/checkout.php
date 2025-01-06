<?php
include("../config/dbcon.php");
include("../functions/userfunctions.php");

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first.');</script>";
    echo "<script>window.location.href='../login/login.php';</script>";
    exit;
}
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
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap');
        @import url('http://fonts.googleapis.com/css2?family=Poppins&display=swap');
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
            font-family: Arial, sans-serif;
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
            font-family: Horizon;
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
        .checkout-container{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            align-self: center;
            justify-content: center;
            margin: 50px;
        }
        .checkout-container1{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .checkout-container h4{
            font-family: Horizon;
            font-size: 35px;
        }
        .check-box{
            width: 70%;
            height: auto;
            display: flex;
            flex-direction: column;
            border: 2px solid black;
        }
        .details-1{
            display: flex;
            flex-direction: row;
            width: 80%;
        }
        .box1{
            display: flex;
            flex-direction: column;
            width: 40%;
        }
        .addresss{
            margin-top: 5px;
        }
        .name1{
            margin-top: 5px;
            margin-left: 15px;
        }
        .phone{
            margin-left: 15px;
        }
        .table-container{
            width: 100%;
            height: auto;
            margin-top: 50px;
            display: flex;
            justify-content: center;
        }
        .table-box{
            width: 70%;
            height: auto;
            border-bottom: 2px solid #CBC4C4;
            padding-bottom: 20px;
            margin-bottom: 10px;
        }
        .product-title{
                font-size: 25px;
                font-weight: 600;
        }
        .details{
            text-align: center;
        }
        .product-body{
            text-align: center;
            margin-bottom: 20px;
        }
        .payment-method{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .boxex{
            width: 70%;
            height: auto;
            display: flex;
            flex-direction: row;
            gap: 40px;
        }
        .boxex p{
            font-weight: 500;
        }
        .options{
            display: flex;
            flex-direction: column;
        }
        .cod{
            background-color: white;
            color: black;
            height: 25px;
            width: 120px;
            margin-bottom: 10px;
        }
        .cod:hover{
            opacity: 0.8;
            cursor: pointer;
        }
        .paypal{
            background-color: black;
            color: white;
            height: 25px;
            width: 120px;
        }
        .paypal:hover{
            opacity: 0.8;
            cursor: pointer;
        }
        .option{
            background-color: white;
            color: black;
            height: 25px;
            width: 120px;
        }
        .option:hover{
            opacity: 0.8;
            cursor: pointer;
        }
        .actives {
            background-color: black;
            color: white;
        }
        .boxex1{
            width: 70%;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: end;
        }
        .place-order{
            color: white;
            background-color: black;
            border: none;
            height: 45px;
            width: 185px;
            cursor: pointer;
            margin-top: 20px;
            margin-bottom: 50px;
            margin-left: 20px;
        }
        .place-order a{
            color: #f5f5f5;
        }
        .place-order:hover{
            opacity: 0.8;
        }
        .continue{
            border: 1px solid #333;
            height: 45px;
            width: 185px;
            margin: 20px;
        }
        .continue a{
            color: #000;
        }
        .continue:hover{
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
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

         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
    <!-- NAVIGATION BAR -->
    <nav>
        <ul class="sidebar">
            
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li>
            <div class="box">
            <input type="text" placeholder="Search...">
            <a href="#"></a>
            <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            </li>
            <li><a href="../index.php" class="active">Home</a></li>
            <li><a href="../shop/shop.php" class="active" >Shop</a></li>
            <li><a href="../sizechart/sizechart.php" class="active">Size</a></li>
            <li><a href="../contact/contact.php" class="active">Contact</a></li>
            <li><a href="cart.php" class="active">Cart</a></li>
            <li><a href="../profile/profile.php" class="active">Profile</a></li>
            <li><a href="../logout/logout.php" class="active">Logout</a></li>
        </ul>
        <ul>
            
            <li><a href="../index.php" class="name"><img class="logo" src="../images/logoR1.png">PROBLEM CHILD</a></li>
            <li class="hideOnMobile"><a href="../index.php" class="active">Home</a></li>
            <li class="hideOnMobile"><a href="../shop/shop.php" class="active" >Shop</a></li>
            <li class="hideOnMobile"><a href="../sizechart/sizechart.php" class="active">Size</a></li>
            <li class="hideOnMobile"><a href="../contact/contact.php" class="active">Contact</a></li>
            <li class="hideOnMobile">
            <div class="box">
            <input type="text" placeholder="Search...">
            <a href="#"></a>        
            <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            </li>
            <li class="hideOnMobile">
            <div class="cart1">
                <a href="../cart/cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            </li>
            </li>
            <li class="hideOnMobile">
            <div class="user">
                <a href="../profile/profile.php"><i class="fa-regular fa-user"></i></a>
                <!-- User menu -->
                <div class="user-menu" style="<?php echo isset($_SESSION['user_id']) ? 'right: -5px;' : ''; ?>">
                  <a href="../profile/profile.php">My Account</a>
                  <a href="#">My Purchases</a>
                  <a href="../logout/logout.php">Logout</a>
                </div>
            </div>
            </li>
            <li class="hideOnMobile">
                <div class="login">
                    <?php
                        // Check if the user is logged in
                        if(isset($_SESSION['user_id'])) {
                            
                        } else {
                            // User is not logged in, display the login button
                            echo '<a href="../login/login.php"><button class="button-74" role="button">Login</button></i></a>';
                        }
                    ?>
                </div>
            </li>
            <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>


    <!-- BODY -->
    <div class="checkout-container">
        <h4>Checkout</h4>
    </div>
    <?php 
    $address = getAddress();
    $address_default = 1;

    if ($address) {
        while ($add = mysqli_fetch_assoc($address)) {
            if ($add['address_default'] == $address_default) {
    ?>
                <div class="checkout-container1">
                    <div class="check-box">
                        <h3 class="delivery-title"><i class="fa-solid fa-location-dot"></i> Delivery Address</h3>
                        <div class="details-1">
                            <div class="box1">
                                <p class="name1"><?php echo $add['full_name']; ?></p>
                                <p class="phone"><?php echo $add['phone_number']; ?></p>
                            </div>
                            <p class="addresss"><?php echo $add['address_region']; ?>,<?php echo $add['postal_code']; ?>,<?php echo $add['street_name']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="table-container">
    <?php 
                        $items = getCartItems();
                        if ($items) {
                            while ($citem = mysqli_fetch_assoc($items)) {
                                if ($citem['checkbox'] == 1) {
    ?>
                    <table class="table-box">
                        <thead class="header">
                            <td class="product-title" data-field="image">Products</td>
                            <td class="details" data-field="name">Name</td>
                            <td class="details" data-field="size">Variation</td>
                            <td class="details" data-field="price">Unit Price</td>
                            <td class="details" data-field="quantity">Quantity</td>
                            <td class="details" data-field="subtotal">SubTotal</td>
                        </thead>
                        <tr class="product-body">
                            <td><img style="width: 100px; height: 100px" src="../admin_panel/<?php echo $citem['product_image']; ?>" alt=""></td>
                            <td><p class="product_name"><?php echo $citem['product_name']; ?></p></td>
                            <td><p class="product_size"><?php echo $citem['size_name']; ?></p></td>
                            <td><p class="product_price"><?php echo $citem['price']; ?></p></td>
                            <td><p class="product_quantity"><?php echo $citem['quantity']; ?></p></td>
                            <td><p class="product_subtotal"><?php echo $citem['price']; ?></p></td>
                        </tr>
                    </table>
    <?php
                                }
                            }
                        }
    ?>
                </div>

                <div class="payment-method">
    <?php 
                $checkout = getCheckOut();
                if ($checkout) {
                    while ($ch = mysqli_fetch_assoc($checkout)) {
                        $merchandiseSubtotal = $ch['price'];
                        $shippingTotal = 75;
                        $totalPayment = $merchandiseSubtotal + $shippingTotal;
    ?>
                        <div class="boxex">
                            <p>Payment Method </p>
                            <div class="options">
                                <button class="cod" onclick="toggleActive(this)">Cash On Delivery</button>
                            </div>
                            <p>Shipping Option</p>
                            <div class="options">
                                <button class="option" onclick="toggleActive(this)">Standard Local</button>
                            </div>
                        </div>
                        <div class="boxex1">
                            <p class="merch-total">Merchandise Subtotal: ₱<?php if ($ch['checkbox'] == 1) { echo $merchandiseSubtotal; } ?>.00</p>
                            <p class="shipping">Shipping Total: ₱<?php if ($ch['checkbox'] == 1) { echo $shippingTotal; } ?>.00</p>
                            <p class="payment-total"> Total Payment: ₱<?php if ($ch['checkbox'] == 1) { echo $totalPayment; } ?>.00</p>

                            <div class="checkout">
                                <a href="../shop/shop.php"><button class="continue">CONTINUE SHOPPING</button></a>
                                <button class="place-order" onclick="placeOrder(<?php echo json_encode($add); ?>)">PLACE ORDER</button>
                            </div>
                        </div>
    <?php
                    }
                }
    ?>
                </div>
    <?php
            }
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function toggleActive(button) { 
            // Remove 'actives' class from all buttons in the same container
            $(button).siblings().removeClass('actives');
            
            // Toggle 'actives' class on the clicked button
            $(button).toggleClass('actives');
        }

        <?php
        // Extract address information to a JavaScript object
        $addressInfo = array(
            'full_name' => $add['full_name'],
            'phone_number' => $add['phone_number'],
            'address_region' => $add['address_region'],
            'postal_code' => $add['postal_code'],
            'street_name' => $add['street_name']
        );
    ?>

    // Assign the PHP address information to a JavaScript variable
    var addressInfo = <?php echo json_encode($addressInfo); ?>;

    function placeOrder() {
        // Assuming you have included jQuery
        $.ajax({
            type: 'POST',
            url: '../update_orders.php'
            data: {
                delivered_to: addressInfo.full_name,
                phone_no: addressInfo.phone_number,
                delivered_address: `${addressInfo.address_region}, ${addressInfo.postal_code}, ${addressInfo.street_name}`
            },
            dataType: 'json',  // Expect JSON response
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Order placed successfully:', response.message);
                } else {
                    console.error('Error placing order:', response.message, response.error);
                }
            },
            error: function(error) {
                console.error('AJAX error:', error);
            }
        });
    }
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
        function showSidebar(){
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }
        function hideSidebar(){
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }
    </script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
</body>
</html>