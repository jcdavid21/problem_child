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
                                    <h4 class="card-title">
                                        Products
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="productTable">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Product Id</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Product Desc</th>
                                                    <th>Uploaded Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $query = "SELECT * FROM product WHERE availability = 1";
                                                    $stmt = $conn->prepare($query);
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();

                                                    while ($data = $result->fetch_assoc()) {
                                                        $formatted_date = date("F j, Y", strtotime($data['uploaded_date']));
                                                ?>
                                                <tr class="product-row">
                                                    <td>
                                                        <img src="../admin_panel/<?php echo $data['product_image']; ?>" alt="product" style="width: 100px; height: 100px;">
                                                    </td>
                                                    <td><?php echo $data['product_id']; ?></td>
                                                    <td><?php echo $data['product_name']; ?></td>
                                                    <td>₱<?php echo number_format($data['price'], 2); ?></td>
                                                    <td><?php echo $data['product_desc']; ?></td>
                                                    <td><?php echo $formatted_date; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#residenceAccountDetails<?php echo $data["product_id"]; ?>">
                                                            <i class="fa-solid fa-cart-plus" style="color: #fcfcfc;"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="residenceAccountDetails<?php echo $data["product_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post">
                                                                    <!-- product price -->
                                                                    <div class="mb-3">
                                                                        <label for="price" class="col-form-label">Price</label>
                                                                        <input type="text" class="form-control updatedPrice" value="₱<?php echo number_format($data["price"], 2); ?>" disabled>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Product Name</label>
                                                                        <input type="text" class="form-control updatedName" value="<?php echo $data["product_name"]; ?>" disabled>
                                                                    </div>
                                                                    <!-- select size -->
                                                                     <?php 
                                                                        $querySizes = "SELECT ts.*, tv.variation_id, tv.quantity_in_stock FROM sizes ts
                                                                        JOIN product_size_variation tv ON ts.size_id = tv.size_id
                                                                        WHERE tv.product_id = ?";
                                                                        $stmtSizes = $conn->prepare($querySizes);
                                                                        $stmtSizes->bind_param("i", $data["product_id"]);
                                                                        $stmtSizes->execute();
                                                                        $resultSizes = $stmtSizes->get_result();
                                                                     ?>
                                                                    <div class="mb-3">
                                                                        <label for="sizes" class="col-form-label">Sizes</label>
                                                                        <select class="form-select updatedSize text-dark" aria-label="Default select example">
                                                                            <option selected disabled value="">Select Size</option>
                                                                            <?php
                                                                                while($dataSizes = $resultSizes->fetch_assoc()){
                                                                            ?>
                                                                            <option data-variation-id="<?php echo $dataSizes["variation_id"] ?>" value="<?php echo $dataSizes["size_id"]; ?>"><?php echo $dataSizes["size_name"].' ('.$dataSizes["quantity_in_stock"].' PCS available)'; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <!-- QUANTITY -->
                                                                    <div class="mb-3">
                                                                        <label for="quantity" class="col-form-label">Quantity</label>
                                                                        <input type="number" class="form-control updatedQuantity" value="1" min="1">
                                                                    </div>

                                                                    <!-- total price -->
                                                                    <div class="mb-3">
                                                                        <label for="total" class="col-form-label">Total Price</label>
                                                                        <input type="text" class="form-control updatedTotal" value="₱<?php echo $data["price"]; ?>" disabled>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary btn-accept addCart" value="<?php echo $data["product_id"]; ?>">ADD TO CART</button>
                                                                <button type="button" class="btn btn-secondary " value="<?php echo $data["product_id"]; ?>" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        Cart Items
                                    </h4>

                                    <div class="table-responsive">
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
                                                    <th>Action</th>
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
 

</body>
</html>
