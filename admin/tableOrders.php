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
    <title>Cashier Panel</title>
    <!-- DataTables -->
    <link href="../plugins/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../plugins/responsive.bootstrap5.min.css" rel="stylesheet" />
    <script src="../scripts/sweetalert2.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script
      src="../scripts/font-awesome.js"
      crossorigin="anonymous"
    ></script>
     <!-- Include DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <style>
        td, td span{
            font-size: 15px !important;
        }
    </style>
  </head>
  <body >
  <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php require_once("./navbar.php"); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require_once("./sidebar.php"); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
            <div class="container-fluid px-4">
            <!-- Page indicator -->
                  <div class="card mb-5">
                    <div class="card-header bg-secondary pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">Pending Orders
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                      <table id="productTable" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Account ID</th>
                              <th>Customer Name</th>
                              <th>Customer Contact</th>
                              <th>Customer Address</th>
                              <th>Shipping Fee</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // First query to get the account details
                          $query = "SELECT 
                                    ta.user_id, 
                                    tr.status_name, 
                                    tr.status_id, 
                                    od.address_id, od.shipping_fee, od.order_id,
                                    td.user_id, td.full_name, td.phone_number, td.address_region, td.postal_code, td.street_name, td.address_default
                                FROM users ta
                                INNER JOIN cart tc ON tc.user_id = ta.user_id
                                INNER JOIN tbl_orders o ON o.cart_id = tc.cart_id
                                INNER JOIN tbl_order_details od ON o.order_id = od.order_id
                                INNER JOIN addresses td ON td.address_id = od.address_id
                                INNER JOIN tbl_order_status tr ON tc.status_id = tr.status_id
                                WHERE tc.status_id = 1 AND td.address_default = 1
                                GROUP BY od.order_id";
                          $stmt = $conn->prepare($query);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          while ($data = $result->fetch_assoc()) {
                            $account_id = $data["user_id"];
                            $order_id = $data["order_id"];
                            $full_name = $data["full_name"];
                            $status_name = $data["status_name"];
                            $contact = $data["phone_number"];
                            $status_id = $data["status_id"];
                            $shipping_fee = $data["shipping_fee"];
                            $address = $data["street_name"].", ".$data["address_region"];
                          ?>
                          <tr>
                            <td><?php echo $account_id;?></td>
                            <td><?php echo $full_name;?></td>
                            <td><?php echo $contact;?></td>
                            <td><?php echo $address; ?></td>
                            <td>₱<?php echo $shipping_fee; ?></td>
                            <td>
                                <?php 
                                    if($status_id == 1){
                                        echo "<span class='badge text-warning fw-bold'>$status_name</span>";
                                    }
                                ?>
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                              data-bs-target="#residenceAccountDetails<?php echo $order_id; ?>" data-bs-whatever="@getbootstrap">
                                <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                              </button>
                            </td>
                          </tr>

                          <!-- Modal for displaying order details -->
                          <div class="modal fade" id="residenceAccountDetails<?php echo $order_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Order Details for <?php echo $data["full_name"]; ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                  <form method="post">
                                    <?php
                                    // Fetch order details for the specific account
                                    $query_orders = "SELECT tc.cart_id, tc.quantity, tc.price, tv.size_id, tp.product_id, tp.product_name, tp.product_image, tp.price as prod_price, ca.category_name, o.order_id, ts.size_name FROM cart tc
                                    INNER JOIN tbl_orders o ON o.cart_id = tc.cart_id
                                    INNER JOIN product_size_variation tv ON tv.variation_id = tc.variation_id
                                    INNER JOIN sizes ts ON ts.size_id = tv.size_id
                                    INNER JOIN product tp ON tp.product_id = tv.product_id
                                    INNER JOIN category ca ON ca.category_id = tp.category_id
                                    WHERE tc.user_id = ? AND tc.status_id = 1 AND o.order_id = ?";
                                    $stmt_orders = $conn->prepare($query_orders);
                                    $stmt_orders->bind_param("ii", $account_id, $order_id);
                                    $stmt_orders->execute();
                                    $result_orders = $stmt_orders->get_result();
 
                                    // Loop through each order and display order details
                                    while ($order_data = $result_orders->fetch_assoc()) {
                                      $total = $order_data["quantity"] * $order_data["prod_price"];
                                      
                                    ?>
                                    <div class="mb-3 col-md-12">
                                      <label class="col-form-label text-danger">Order ID</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["cart_id"]; ?>" disabled>
                                    </div>

                                    <!-- product image -->
                                    <div class="mb-3 col-md-12">
                                      <label class="col-form-label">Product Image</label>
                                      <div class="img-con" style="display: flex; justify-content: center;">
                                        <img src="../admin_panel/<?php echo $order_data["product_image"]; ?>" alt="product" style="width: 100px; height: 100px; object-fit: contain;">
                                      </div>
                                    </div>
                                    
                                    <!-- category type -->
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Category</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["category_name"]; ?>" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Product Name</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["product_name"]; ?>" disabled>
                                    </div>

                                    <!-- product size -->
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Product Size</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["size_name"]; ?>" disabled>
                                    </div>

                                    
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Product Price</label>
                                      <input type="text" class="form-control" value="₱<?php echo number_format($order_data["prod_price"], 2); ?>" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Order Quantity</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["quantity"]; ?>" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Total</label>
                                      <input type="text" class="form-control" value="₱<?php echo number_format($total, 2); ?>" disabled>
                                    </div>

                                    <div class="mb-3 row border-bottom border-danger  justify-content-end pb-3 col-md-12">
                                      <button type="button" class="btn btn-danger delete-js col-md-4" id="<?php echo $order_data["cart_id"] ?>" >
                                        Cancel Order
                                      </button>
                                    </div>
                                    <?php } ?>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success updateBtn" data-user-id="<?php echo $account_id; ?>" data-status-id="<?php echo $status_id; ?>" data-order-id="<?php echo $order_id; ?>" >
                                      Process Now
                                    </button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <?php } ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                <!---------------------------- End of Page indicator------------------ -->
                <div class="card mb-5">
                    <div class="card-header bg-warning pt-3">
                        <div class="text-center">
                            <p class="card-title text-white">Processing Orders
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                      <table id="productTable2" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Account ID</th>
                              <th>Customer Name</th>
                              <th>Customer Contact</th>
                              <th>Customer Address</th>
                              <th>Shipping Fee</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // First query to get the account details
                          $query = "SELECT 
                                    ta.user_id, 
                                    tr.status_name, 
                                    tr.status_id, 
                                    od.address_id, od.shipping_fee, od.order_id,
                                    td.user_id, td.full_name, td.phone_number, td.address_region, td.postal_code, td.street_name, td.address_default
                                FROM users ta
                                INNER JOIN cart tc ON tc.user_id = ta.user_id
                                INNER JOIN tbl_orders o ON o.cart_id = tc.cart_id
                                INNER JOIN tbl_order_details od ON o.order_id = od.order_id
                                INNER JOIN addresses td ON td.address_id = od.address_id
                                INNER JOIN tbl_order_status tr ON tc.status_id = tr.status_id
                                WHERE tc.status_id = 2 AND td.address_default = 1
                                GROUP BY od.order_id";
                          $stmt = $conn->prepare($query);
                          $stmt->execute();
                          $result = $stmt->get_result();
                          while ($data = $result->fetch_assoc()) {
                            $account_id = $data["user_id"];
                            $order_id = $data["order_id"];
                            $full_name = $data["full_name"];
                            $status_name = $data["status_name"];
                            $contact = $data["phone_number"];
                            $status_id = $data["status_id"];
                            $shipping_fee = $data["shipping_fee"];
                            $address = $data["street_name"].", ".$data["address_region"];
                          ?>
                          <tr>
                            <td><?php echo $account_id;?></td>
                            <td><?php echo $full_name;?></td>
                            <td><?php echo $contact;?></td>
                            <td><?php echo $address; ?></td>
                            <td>₱<?php echo $shipping_fee; ?></td>
                            <td>
                                <?php 
                                    if($status_id == 2){
                                        echo "<span class='badge text-primary fw-bold'>$status_name</span>";
                                    }
                                ?>
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                              data-bs-target="#residenceAccountDetails<?php echo $order_id; ?>" data-bs-whatever="@getbootstrap">
                                <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                              </button>
                            </td>
                          </tr>

                          <!-- Modal for displaying order details -->
                          <div class="modal fade" id="residenceAccountDetails<?php echo $order_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Order Details for <?php echo $data["full_name"]; ?></h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                  <form method="post">
                                    <div class="mb-3 col-md-12">
                                      <label for="tracking_number">J&T Tracking Number</label>
                                      <input type="text" class="form-control" id="tracking_number" class="tracking_number"  name="tracking_number"
                                      placeholder="Input J&T Tracking number" required>
                                    </div>
                                    <?php
                                    // Fetch order details for the specific account
                                    $query_orders = "SELECT tc.cart_id, tc.quantity, tc.price, tv.size_id, tp.product_id, tp.product_name, tp.product_image, tp.price as prod_price, ca.category_name, o.order_id, ts.size_name FROM cart tc
                                    INNER JOIN tbl_orders o ON o.cart_id = tc.cart_id
                                    INNER JOIN product_size_variation tv ON tv.variation_id = tc.variation_id
                                    INNER JOIN sizes ts ON ts.size_id = tv.size_id
                                    INNER JOIN product tp ON tp.product_id = tv.product_id
                                    INNER JOIN category ca ON ca.category_id = tp.category_id
                                    WHERE tc.user_id = ? AND tc.status_id = 2 AND o.order_id = ?";
                                    $stmt_orders = $conn->prepare($query_orders);
                                    $stmt_orders->bind_param("ii", $account_id, $order_id);
                                    $stmt_orders->execute();
                                    $result_orders = $stmt_orders->get_result();
 
                                    // Loop through each order and display order details
                                    while ($order_data = $result_orders->fetch_assoc()) {
                                      $total = $order_data["quantity"] * $order_data["prod_price"];
                                      
                                    ?>
                                    <div class="mb-3 col-md-12">
                                      <label class="col-form-label text-danger">Order ID</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["cart_id"]; ?>" disabled>
                                    </div>

                                    <!-- product image -->
                                    <div class="mb-3 col-md-12">
                                      <label class="col-form-label">Product Image</label>
                                      <div class="img-con" style="display: flex; justify-content: center;">
                                        <img src="../admin_panel/<?php echo $order_data["product_image"]; ?>" alt="product" style="width: 100px; height: 100px; object-fit: contain;">
                                      </div>
                                    </div>
                                    
                                    <!-- category type -->
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Category</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["category_name"]; ?>" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Product Name</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["product_name"]; ?>" disabled>
                                    </div>

                                    <!-- product size -->
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Product Size</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["size_name"]; ?>" disabled>
                                    </div>

                                    
                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Product Price</label>
                                      <input type="text" class="form-control" value="₱<?php echo number_format($order_data["prod_price"], 2); ?>" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Order Quantity</label>
                                      <input type="text" class="form-control" value="<?php echo $order_data["quantity"]; ?>" disabled>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="col-form-label">Total</label>
                                      <input type="text" class="form-control" value="₱<?php echo number_format($total, 2); ?>" disabled>
                                    </div>

                                    <!-- <div class="mb-3 row border-bottom border-danger  justify-content-end pb-3 col-md-12">
                                      <button type="button" class="btn btn-danger delete-js col-md-4" id="<?php echo $order_data["cart_id"] ?>" >
                                        Cancel Order
                                      </button>
                                    </div> -->
                                    <?php } ?>
                                  </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary updateBtn" data-user-id="<?php echo $account_id; ?>" data-status-id="<?php echo $status_id; ?>" data-order-id="<?php echo $order_id; ?>" >
                                      Ship Now
                                    </button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <?php } ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
            </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-center">
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
  <script
      src="../scripts/bootstrap.bundle.min.js"
    ></script>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/toggle.js"></script>
    <script src="../jquery/updatePending.js"></script>
    <!-- DataTables Scripts -->
    <script src="../plugins/js/jquery.dataTables.min.js"></script>
    <script src="../plugins/js/dataTables.bootstrap5.min.js"></script>
    <script src="../plugins/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/js/responsive.bootstrap5.min.js"></script>

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="../styles/dataTables.min.css">

    <!-- DataTables Buttons JavaScript -->
    <script src="../scripts/dataTables.js"></script>
    <script src="../scripts/ajax.make.min.js"></script>
    <script src="../scripts/ajax.fonts.js"></script>
    <script src="../scripts/dtBtn.html5.js"></script>
    <script>
        function convertToLowercase(input) {
            input.value = input.value.toLowerCase();
        }
    </script>

<script src="../jquery/cancelOrder.js"></script>
<script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/template.js"></script>
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

            $('#productTable2').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "search": "Filter records:",
                }
            });
        });
    </script>

  </body>
</html>
