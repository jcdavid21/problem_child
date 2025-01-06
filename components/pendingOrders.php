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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="../js/jquery.js"></script>
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="../styles/cart.css">
</head>
    <!-- NAVIGATION BAR -->
    <?php include_once "../components/nav.php"; ?>

<div class="center">
    <div class="h1-div">
        <h1>
            <?php
            $default_status_ids = [1, 2]; // Default status IDs
            $status_id = isset($_GET['status_id']) ? [(int)$_GET['status_id']] : $default_status_ids;
        
            $statusName = [
                1 => "Pending Orders",
                2 => "Processing Orders",
                3 => "Shipped Orders",
                4 => "Delivered Orders",
                5 => "Cancelled Orders",
            ];
            echo $statusName[$status_id[0]];
            ?>
        </h1>
        <div class="count-con">
            <a href="./pendingOrders.php?status_id=3">Shipped Orders</a>
            <?php 
                $queryCount3 = "SELECT COUNT(*) as count FROM cart WHERE user_id = ? AND status_id = 3";
                $stmtCount3 = mysqli_prepare($conn, $queryCount3);
                mysqli_stmt_bind_param($stmtCount3, 'i', $_SESSION['user_id']);
                mysqli_stmt_execute($stmtCount3);
                $resultCount3 = mysqli_stmt_get_result($stmtCount3);
                $dataCount3 = $resultCount3->fetch_assoc();
            ?>
            <span class="count"><?php echo $dataCount3['count']; ?></span>
        </div>
        <div class="count-con">
            <a href="./pendingOrders.php?status_id=4">Delivered Orders</a>
            <?php 
                $queryCount4 = "SELECT COUNT(*) as count FROM cart WHERE user_id = ? AND status_id = 4";
                $stmtCount4 = mysqli_prepare($conn, $queryCount4);
                mysqli_stmt_bind_param($stmtCount4, 'i', $_SESSION['user_id']);
                mysqli_stmt_execute($stmtCount4);
                $resultCount4 = mysqli_stmt_get_result($stmtCount4);
                $dataCount4 = $resultCount4->fetch_assoc();
            ?>
            <span class="count"><?php echo $dataCount4['count']; ?></span>
        </div>
        <div class="count-con">
            <a href="./pendingOrders.php?status_id=5">Cancelled Orders</a>
            <?php 
                $queryCount5 = "SELECT COUNT(*) as count FROM cart WHERE user_id = ? AND status_id = 5";
                $stmtCount5 = mysqli_prepare($conn, $queryCount5);
                mysqli_stmt_bind_param($stmtCount5, 'i', $_SESSION['user_id']);
                mysqli_stmt_execute($stmtCount5);
                $resultCount5 = mysqli_stmt_get_result($stmtCount5);
                $dataCount5 = $resultCount5->fetch_assoc();
            ?>
            <span class="count"><?php echo $dataCount5['count']; ?></span>
        </div>
    </div>
</div>

<?php 

    // Dynamically generate placeholders for the IN clause
    $placeholders = implode(',', array_fill(0, count($status_id), '?'));

    $query = "SELECT c.cart_id, p.product_id, s.size_id, p.product_name, p.price, 
                     p.product_image, c.quantity, s.size_name, c.checkbox, ts.status_name, c.variation_id
              FROM cart c
              JOIN product_size_variation v ON c.variation_id = v.variation_id 
              JOIN product p ON v.product_id = p.product_id
              JOIN sizes s ON v.size_id = s.size_id
              JOIN tbl_order_status ts ON c.status_id = ts.status_id
              WHERE c.user_id = ? AND c.status_id IN ($placeholders)
              ORDER BY c.cart_id DESC";

            $stmt = mysqli_prepare($conn, $query);

            // Bind user_id and status_id dynamically
            $types = str_repeat('i', count($status_id) + 1); // One for user_id + status IDs
            $params = array_merge([$_SESSION['user_id']], $status_id);

            mysqli_stmt_bind_param($stmt, $types, ...$params);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result->num_rows > 0) {
        ?>

    <main>
        <div class="center">
            <div class="div">
                <div class="left-con">
                    <div class="cart-con">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                    <?php 
                                        if ($status_id[0] == 4) {
                                    ?>
                                    <th>Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($data = $result->fetch_assoc()) {
                                    $subtotal = round($data["quantity"] * $data["price"], 2);
                                    $total += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <div class="img-con">
                                        <img src="../admin_panel/<?php echo $data['product_image']; ?>" alt="">
                                        </div>
                                    </td>
                                    <td><?php echo $data["product_name"]; ?></td>
                                    <td>
                                        <?php 
                                            $sizeNames = [
                                                1 => "Small",
                                                2 => "Medium",
                                                3 => "Large",
                                                4 => "Extra Large",
                                            ];
                                            echo $sizeNames[$data["size_id"]];
                                        ?>
                                     </td>
                                    <td>₱<?php echo number_format($data["price"], 2); ?></td>
                                    <td>
                                        <div class="qnty-td">
                                          
                                            <div class="qnty-js"><?php echo $data["quantity"]; ?></div>
    
                                        </div>
                                    </td>
                                    <td class="total-price-js">₱<span class="subtotal-js"><?php echo number_format($subtotal, 2); ?></span></td>
                                    <?php
                                        $statusColor = [
                                            "Pending" => "orange",
                                            "Processing" => "blue",
                                            "Shipped" => "purple",
                                            "Delivered" => "green",
                                            "Cancelled" => "red",
                                        ];

                                        $statusName = $data["status_name"];
                                        $color = $statusColor[$statusName] ?? "black"; // Default color if status not found
                                    ?>
                                    <td style="color: <?php echo $color; ?>">
                                        <?php echo $statusName; ?>
                                    </td>
                                    <!-- review button -->
                                    <?php 
                                        if ($status_id[0] == 4) {
                                    ?>
                                    <td>
                                        <button class="btn btn-primary"
                                        data-toggle="modal" data-target="#exampleModal<?php echo $data["cart_id"] ?>" data-whatever="@mdo">
                                            Review
                                        </button>
                                     </td>
                                    <?php } ?>
                                </tr>
                                <!-- Modal -->
                                 <?php 
                                    if ($status_id[0] == 4) {
                                ?>
                                <div class="modal fade" id="exampleModal<?php echo $data["cart_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Submit Review</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Product Name:</label>
                                                    <input type="text" class="form-control" id="recipient-name"
                                                    value="<?php echo $data["product_name"]; ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                    <textarea class="form-control comment" id="message-text"></textarea>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary submitReview"
                                                data-cart-id="<?php echo $data["product_id"] ?>"
                                               data-variation-id="<?php echo $data["variation_id"] ?>">Submit review</button>
                                            </div>
                                            </div>
                                        </div>
                                </div>
                                <?php } ?>
                                
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="right-con">
                    <div class="total-con">
                        <h1>Cart total</h1>
                        <div class="price-div">
                            <div class="text">
                                <div>Total:</div>
                                <div class="text-total">₱<?php echo number_format($total, 2); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    } else {
    ?>
        <div class="no-products-message">
            <p>No products available at the moment.</p>
        </div>
    <?php } ?>

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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../jquery/submitReview.js"></script>
</body>
</html>