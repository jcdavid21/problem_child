<!-- c:/xampp/htdocs/project_revise/indextest.html -->
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
            text-decoration: none !important;
            list-style: none;
            box-sizing: border-box;
        }
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0 !important;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        #searchFormDesktop button, #searchFormMobile button{
            background: transparent;
            border: none;
            cursor: pointer;
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
        .cart-container #cart-form{
            width: 100%;
            height: auto;
            margin-top: 50px;
            margin-bottom: 100px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .cart-box{
            width: 80%;
            padding: 20px;
        }
        .cart-box h2{
            color: #333;
            text-align: center;
        }
        .cart-box p{
            text-align: center;
            margin: 10px;
            color: #888;
        }

        .item-checkbox{
            width: 40px;
        }

        .checkbox input{
            width: 15px;
            height: 15px;
        }

        .checkbox input[type="checkbox"]{
            margin: 70px auto;
        }



        .cart-items {
            margin-top: 20px;
            border-bottom: 1px solid #eee;
        }

        .cart-item {
            display: flex;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            overflow: scroll;
        }

        .no-item{
            margin: 30px;
            font-size: 25px;
            text-align: center;
            color: #888;
        }

        .item-image {
            flex: 1;
            max-width: 150px;
        }

        .item-details {
            flex: 2;
            padding: 0 20px;
        }

        .item-name {
            font-weight: bold;
            color: #333;
        }

        .size{
            color: #333;
        }

        .item-price {
            color: #888;
        }

        .item-remove {
            flex: 1;
            text-align: right;
        }

        .remove-btn {
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            margin: 50px auto;
        }

        

        .container3 {
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container3 label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .container3 input {
            width: 70px;
            padding: 5px;
            text-align: center;
            margin: 10px auto;
        }


        .container5{
            display: flex;
            width: 100%;
        }
        .checkout{
            color: white;
            background-color: black;
            border: none;
            height: 45px;
            width: 185px;
            cursor: pointer;
            margin: 20px 20px 20px 0;
        }
        .checkout a{
            color: #f5f5f5;
        }
        .checkout:hover{
            opacity: 0.8;
        }
        .checkout:active{
            color: black;
            background-color: gray;
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
        .continue:active{
            color: white;
            background-color: black;
        }

        .action-btn .icon-cart{
            color: #333;
        }
        .total-price1{
            display: flex;
            flex-direction: column;
        }   
        .total-price1 .price2{
            margin-top: 25px;
            display: flex;
            flex-direction: row;
        }
        .total-price1 .price2 p{
            color: #000;
        }
        .total-price1 .price1{
            margin-top: 25px;
            display: flex;
            flex-direction: row;
        }
        .total-price1 .price1 p{
            color: #000;
        }
        .total-price{
            margin-top: 10px;
            display: flex;
            flex-direction: row;
            font-size: 20px;
            font-weight: bold;
        }
        .total-price #price{
            margin-left: 5px;
        }
        .buttonborder{
            border-style: solid;
            border-width: 1px;
            height: 50px;
            width: 150px;
            border-radius: 10px;
            text-align: center;
            margin: 20px;
        }
        .minus-btn {
            font-size: 20px;
            width: 30px;
            height: 30px;
            border: none;
            background-color: white;
        }
        .plus-btn {
            font-size: 20px;
            width: 30px;
            height: 30px;
            margin-top: 9px;
            border: none;
            background-color: white;
        }
        .number{
            width: 50px;
            height: 30px;
            border: none;
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

        @media (max-width: 700px) {
            .product_data{
                display: grid;
                grid-template-columns: 1fr 1fr;
                row-gap: 20px;
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }

            .total-price1{
                flex-direction: row;
                align-items: center;
                gap: 10px;
            }

            .total-price1 .price2, .total-price1 .price1{
                margin-top: 0;
            }

            .total-price1 p{
                margin: 0;
            }

            .item-remove{
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="../js/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
</head>
    <!-- NAVIGATION BAR -->
    <?php include_once "../components/nav.php"; ?>

    <!-- BODY -->
    <div class="cart-container">
    <div id="cart-form">
        <div class="cart-box">
            <h2>Your Shopping Cart</h2>
            <div class="cart-items" id="cart-items-container">
                <?php 
                    $items = getCartItems();
                    $subtotal = 0;
                    if ($items) {
                        while ($citem = mysqli_fetch_assoc($items)) {
                            if($citem['checkbox'] == 1){
                                $subtotal += $citem['price'] * $citem['quantity'];
                            }
                ?>
                <!-- Sample Cart Item -->
                <div class="cart-item product_data" data-id="<?php echo $citem['cart_id']; ?>">
                    <div class="item-checkbox">
                        <label class="checkbox">
                            <input type="checkbox" class="checkbox" data-id="<?php echo $citem['cart_id']; ?>" <?php echo isset($citem['checkbox']) && $citem['checkbox'] == 1 ? 'checked' : ''; ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="item-image">
                        <img src="../admin_panel/<?php echo $citem['product_image']; ?>" alt="Product Image" style="max-width: 100%;">
                    </div>
                    <div class="item-details">
                        <div class="item-name"><?php echo $citem['product_name']; ?></div>
                        <div class="size"><?php echo $citem['size_name']; ?></div>
                        <div class="item-price">&#8369;<?php echo $citem['price']; ?></div>
                    </div>
                    <div class="container3">
                        <div class="quantity">Quantity:</div>
                        <div class="buttonborder">
                            <button class="btn minus-btn updateQuantity" data-action="decrease">-</button>
                            <input class="number quantity" type="text" value="<?php echo $citem['quantity']; ?>" readonly>
                            <button class="btn plus-btn updateQuantity" data-action="increase">+</button>
                        </div>
                    </div>
                    <div class="total-price1">
                        <div class="total1" style="text-align: center;">Total:</div>
                        <div class="price2" id="price<?php echo $citem['cart_id']; ?>">
                            <p>&#8369;</p>
                            <p class="price"><?php echo $citem['price'] * $citem['quantity']; ?></p>
                        </div>
                    </div>
                    <div class="item-remove">
                        <button class="remove-btn"><box-icon name='x'></box-icon></button>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
                <div class="total-price">
                    <div class="total">Subtotal: &#8369;</div>
                    <div class="price1" id="price2" style="margin-left: 5px;">0.00</div>
                </div>

                <div class="container5">
                    <button class="checkout" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">CHECKOUT</button>
                    <button class="continue">
                        <a href="../shop/shop.php">CONTINUE SHOPPING</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Receipt Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="mb-3">
                    <label class="col-form-label">Total Amount:</label>
                    <input type="text" disabled id="overAllTotal" class="font-weight-bold" value="₱0.00">
                </div>

                    <?php 
                        $queryData = "SELECT * FROM addresses WHERE user_id = ? AND address_default = 1";
                        $stmtData = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmtData, $queryData)) {
                            echo "SQL Error";
                        } else {
                            mysqli_stmt_bind_param($stmtData, "i", $_SESSION['user_id']);
                            mysqli_stmt_execute($stmtData);
                            $resultData = mysqli_stmt_get_result($stmtData);
                            $row = mysqli_fetch_assoc($resultData);
                        }
                    ?>

                    <div class="mb-3">
                        
                        <div class="d-flex " style="gap: 12px;"> 
                            <div>
                                <label for="">Postal Code</label>
                                <input type="text" disabled id="postalCode" class="font-weight-bold form-control" value="<?php echo !empty($row['postal_code']) ? $row['postal_code'] : 'None'; ?>">
                            </div>
                            <div>
                                <label for="">Shipping Fee</label>
                                <input type="text" disabled id="shippingFee" class="font-weight-bold form-control " value="₱0.00">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Address:</label>
                        <input type="text" class="form-control" id="address" 
                        value="<?php echo (!empty($row['street_name']) || !empty($row['address_region'])) 
                            ? trim($row['street_name'] . ' ' . $row['address_region']) 
                            : 'None'; ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Contact Number:</label>
                        <input type="text" class="form-control" id="contactNumber" 
                        value="<?php echo !empty($row['phone_number']) ? $row['phone_number'] : 'None'; ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Your Receipt:</label>
                        <input type="file" class="form-control-file" id="receiptFile" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Reference Number</label>
                        <input type="text" class="form-control" id="refNumber" maxlength="13"
                        placeholder="xxxxxxxxxxxxx" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">Deposit Amount:</label>
                        <input type="text" class="form-control" id="depAmount" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        placeholder="Enter the amount you deposited">
                    </div>


                    <div class="img-con" style="height: 350px; padding-bottom: 20px;">
                        <label class="col-form-label">Send Your Payment Here:</label>
                        <img src="../images/qr/qr.jpeg" alt="" style="object-fit: contain; width: 100%; height: 100%;">
                    </div>

                    <input type="hidden" id="subtotal" value="<?php echo $subtotal; ?>">
                    <input type="hidden" id="address_id" value="<?php echo $row['address_id']; ?>">
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary proceed-btn">Proceed</button>
            </div>
        </div>
    </div>
</div>


<!-- Script For Cart -->

<script>
    $(document).ready(function () {
        
    });
</script>

    

    <!-- FOOTER -->
    <?php include_once "../components/footer.php"; ?>
    
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
    <script src="../js/cart.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>