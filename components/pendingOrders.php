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
    
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0 !important;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
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
    <link rel="stylesheet" href="../styles/navbar.css">
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
                                    <?php 
                                        if($status_id[0] == 3 || $status_id[0] == 4){
                                            echo "<th>J&T Tracking #</th>";
                                        }
                                    ?>
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
                                $total = 0;
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
                                        if($status_id[0] == 3 || $status_id[0] == 4){
                                            $queryGetTrackingNumber = "SELECT tt.tracking_number FROM tbl_tracking_number tt INNER JOIN tbl_orders o ON tt.order_id = o.order_id WHERE o.cart_id = ?";
                                            $stmtGetTrackingNumber = mysqli_prepare($conn, $queryGetTrackingNumber);
                                            mysqli_stmt_bind_param($stmtGetTrackingNumber, 'i', $data['cart_id']);
                                            mysqli_stmt_execute($stmtGetTrackingNumber);
                                            $resultGetTrackingNumber = mysqli_stmt_get_result($stmtGetTrackingNumber);
                                            $dataGetTrackingNumber = $resultGetTrackingNumber->fetch_assoc();
                                            
                                    ?>
                                    <td>
                                        <input type="text" style="width: 150px;" class="form-control tracking-number-js" value="<?php echo $dataGetTrackingNumber['tracking_number'] ?? ''; ?>" disabled>
                                    </td>
                                    <?php } ?>
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
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../jquery/submitReview.js"></script>
</body>
</html>