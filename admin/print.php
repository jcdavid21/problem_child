<?php
session_start();
if(empty($_SESSION["isAdmin"])){
  header('Location:logout.php');
}
require_once("../config/dbcon.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style>
        table td:nth-child(5){
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        table td{
            font-size: 16px !important;
        }
    </style>
    <script src="../scripts/sweetalert2.js"></script>
    <!-- DataTables -->
      <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  </head>
  <body>
  <div class="container-scroller">

        <div class="container-fluid page-body-wrapper">

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h4 class="card-title text-center">
                                            Problem Child 
                                        </h4>
                                        <div class="img-logo">
                                            <img src="../images/logo.png" alt="logo" style="width: 150px; height: 150px;">
                                        </div>
                                    </div>

                                    <div class="table-responsive" id="printableCart">
                                        <table class="table table-striped" id="productTable">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Order Id</th>
                                                    <th>Product Name</th>
                                                    <th>Size</th>
                                                    <th>Product Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    // Get Ordrer ID
                                                    if(isset($_GET["order_id"])){
                                                        $order_id = $_GET["order_id"];
                                                    }
                                                    $total = 0;
                                                     $query_orders = "SELECT tc.cart_id, tc.quantity, tc.price, tc.status_id, tp.price as product_price, tp.product_name, tp.product_image, c.category_name, tv.size_id, tv.variation_id, ts.size_name, o.order_id FROM cart tc INNER JOIN product_size_variation tv ON tv.variation_id = tc.variation_id INNER JOIN product tp ON tp.product_id = tv.product_id INNER JOIN category c ON c.category_id = tp.category_id INNER JOIN sizes ts ON ts.size_id = tv.size_id 
                                                    INNER JOIN tbl_orders o ON o.cart_id = tc.cart_id
                                                     WHERE o.order_id = ? ;";
                                                    $stmt_orders = $conn->prepare($query_orders);
                                                    $stmt_orders->bind_param("i", $order_id);
                                                    $stmt_orders->execute();
                                                    $result_orders = $stmt_orders->get_result();

                                                    while ($data = $result_orders->fetch_assoc()) {
                                                        $total += $data['price'];
                                                ?>
                                                <tr class="product-row">
                                                    <td>
                                                        <img src="../admin_panel/<?php echo $data['product_image']; ?>" alt="product" style="width: 100px; height: 100px;">
                                                    </td>
                                                    <td><?php echo $data['cart_id']; ?></td>
                                                    <td><?php echo $data['product_name']; ?></td>
                                                    <td><?php echo $data['size_name']; ?></td>
                                                    <td>₱<?php echo number_format($data['product_price'], 2); ?></td>
                                                    <td><?php echo $data['quantity']; ?></td>
                                                    <td>₱<?php echo number_format($data['price'], 2); ?></td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <!-- Total -->
                                        <div class="text-start mt-3">
                                            <h4>Total: ₱<?php echo number_format($total, 2); ?></h4>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     <!-- Include DataTables JS -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Trigger print dialog when the page loads
            printCart();
        });

        function printCart() {
            const printableArea = document.getElementById('printableCart').innerHTML;
            const originalContents = document.body.innerHTML;

            // Replace body content with printable area
            document.body.innerHTML = `
                <html>
                    <head>
                        <title>Print Cart</title>
                        <style>
                            /* Print-specific styles */
                            body {
                                font-family: Arial, sans-serif;
                                margin: 20px;
                            }
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 20px;
                            }
                            th, td {
                                border: 1px solid #000;
                                padding: 10px;
                                text-align: center;
                                font-size: 14px;
                            }
                            th {
                                background-color: #f4f4f4;
                                font-weight: bold;
                            }
                            td img {
                                max-width: 80px;
                                max-height: 80px;
                            }
                            h4 {
                                margin-bottom: 10px;
                                text-align: center;
                            }
                            .logo-div {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                margin-bottom: 20px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='logo-div'>
                            <h4> Problem Child </h4>
                            <img src="../images/logo.png" alt="logo" style="width: 150px; height: 150px;">
                        </div>
                        <h4>Order Summary</h4>
                        ${printableArea}
                    </body>
                </html>
            `;

            // Trigger print dialog
            window.print();
        }
    </script>


 

</body>
</html>
