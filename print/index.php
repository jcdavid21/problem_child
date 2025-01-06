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
    <title>Admin Panel</title>
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
        <!-- Navbar --> 
        <?php require_once("./navbar.php"); ?>
        <!-- Sidebar -->
        <div class="container-fluid page-body-wrapper">
            <?php require_once("./sidebar.php"); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        Cart Items
                                    </h4>

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
                                                    $total = 0;
                                                     $query_orders = "SELECT tc.cart_id, tc.quantity, tc.price, tc.status_id, tp.price as product_price, tp.product_name, tp.product_image, c.category_name, tv.size_id, tv.variation_id, ts.size_name FROM cart tc INNER JOIN product_size_variation tv ON tv.variation_id = tc.variation_id INNER JOIN product tp ON tp.product_id = tv.product_id INNER JOIN category c ON c.category_id = tp.category_id INNER JOIN sizes ts ON ts.size_id = tv.size_id WHERE tc.user_id = ? AND tc.status_id = 6;";

                                                        $stmt_orders = $conn->prepare($query_orders);
                                                        $stmt_orders->bind_param("i", $_SESSION["user_id"]);
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
                                                    <td>
                                                        <button type="button" class="btn btn-danger removeItem"
                                                        data-cart-id="<?php echo $data['cart_id']; ?>">
                                                            <i class="fa-solid fa-circle-xmark" style="color: #fcfcfc;"></i>
                                                        </button>
                                                    </td>
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
                                        <!-- CHECK OUT ALL ITEMS -->
                                        <?php 
                                            if($total > 0){
                                        ?>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary" id="checkoutAll" 
                                            data-total="<?php echo $total; ?>"
                                            >CHECKOUT ALL ITEMS</button>

                                            <button type="button" class="btn btn-danger" id="clearCart">CLEAR CART</button>
                                            
                                        </div>
                                        <?php } ?>
                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-secondary" onclick="printCart()">Print Cart</button>
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
  <!-- plugins:js -->
  <script src="../scripts/ajax.make.min.js"></script>
    <script src="../scripts/ajax.fonts.js"></script>
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script src="../jquery/addCartPos.js"></script>
    <script src="../jquery/checkOutPos.js"></script>
    <script src="../jquery/sideBarProd.js"></script>

     <!-- Include DataTables JS -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function () {
            $('#productTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "search": "Filter records:",
                }
            });


            const quantityInputs = document.querySelectorAll('.updatedQuantity');

            quantityInputs.forEach((qtyInput) => {
                qtyInput.addEventListener('input', (e) => {
                    qtyInput.value = qtyInput.value.replace(/[^0-9]/g, '');

                    const modalBody = e.target.closest('.modal-body');
                    const updatedPrice = parseFloat(modalBody.querySelector('.updatedPrice').value.replace('₱', '') || 0);
                    const updatedQuantity = parseInt(e.target.value || 0, 10);
                    const totalDisplay = modalBody.querySelector('.updatedTotal');

                    // Calculate the total price
                    const total = updatedPrice * updatedQuantity;

                    // Update the total price field
                    totalDisplay.value = "₱" + total.toFixed(2);
                        
                });
            });
        });
    </script>

<script>
    function printCart() {
        const printableArea = document.getElementById('printableCart').innerHTML;
        const originalContents = document.body.innerHTML;

        // Replace body content with printable area
        document.body.innerHTML = `
            <html>
                <head>
                    <title>Print Cart</title>
                    <style>
                        /* Add your print-specific styles here */
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            border: 1px solid #000;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                        img {
                            max-width: 100px;
                            max-height: 100px;
                        }
                    </style>
                </head>
                <body>
                    ${printableArea}
                </body>
            </html>
        `;

        // Trigger print dialog
        window.print();

        // Restore original content
        document.body.innerHTML = originalContents;
        window.location.reload(); // Reload page to restore JavaScript functionality
    }
</script>

 

</body>
</html>
