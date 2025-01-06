<?php
session_start();
if(empty($_SESSION["cashier_id"])){
  header('Location:logout.php');
}
require_once("../backend/config/config.php");
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
    <script
      src="../scripts/font-awesome.js"
      crossorigin="anonymous"
    ></script>
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
                    <div class="card mb-5">
                      <div class="card-header bg-secondary pt-3">
                          <div class="text-center">
                              <p class="card-title text-light">Accepted Orders
                          </div>
                      </div>
                      <div class="card-body">
                        <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                          <thead>
                            <tr>
                                <th>Account ID</th>
                                <th>Customer Name</th>
                                <th>Customer Contact</th>
                                <th>Customer Address</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            // First query to get the account details
                            $query = "SELECT ta.account_id, 
                                              CONCAT(ta.first_name, ' ', ta.middle_name, ' ', ta.last_name) as full_name, 
                                              ta.address, 
                                              tr.status_name, 
                                              tr.status_id,
                                              ta.contact, tc.order_date
                                      FROM tbl_cart tc 
                                      INNER JOIN tbl_account_details ta ON tc.account_id = ta.account_id
                                      INNER JOIN tbl_status tr ON tc.status_id = tr.status_id
                                      WHERE tc.status_id = 2
                                      GROUP BY ta.account_id, tc.order_date";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($data = $result->fetch_assoc()) {
                              $account_id = $data["account_id"];
                              $full_name = $data["full_name"];
                              $address = $data["address"];
                              $status_name = $data["status_name"];
                              $contact = $data["contact"];
                              $status_id = $data["status_id"];
                              $order_date = $data["order_date"];
                              $formatted_date = date("F j, Y", strtotime($order_date));
                            ?>
                            <tr>
                              <td><?php echo $account_id;?></td>
                              <td><?php echo $full_name;?></td>
                              <td><?php echo $contact;?></td>
                              <td><?php echo $address; ?></td>
                              <td><?php echo $formatted_date; ?></td>
                              <td><?php echo $status_name;?></td>
                              <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                data-bs-target="#residenceAccountDetails<?php echo $account_id.$order_date; ?>" data-bs-whatever="@getbootstrap">
                                  <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                </button>
                              </td>
                            </tr>

                            <!-- Modal for displaying order details -->
                            <div class="modal fade" id="residenceAccountDetails<?php echo $account_id.$order_date; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Order Details for <?php echo $full_name; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body row">
                                    <form method="post">
                                      <?php
                                      // Fetch order details for the specific account
                                      $query_orders = "SELECT tc.item_id, 
                                            tc.prod_qnty, tc.status_id,
                                            pt.prod_type_name, 
                                            tf.fl_name, tf.fl_price, tf.fl_id,
                                            tp.*,
                                            CONCAT(td.first_name, ' ', td.middle_name, ' ', td.last_name) as full_name, td.address, td.contact, td.account_id,
                                            GROUP_CONCAT(ta.add_ons_name) AS add_ons_names,
                                            GROUP_CONCAT(ta.add_ons_price) AS add_ons_prices,
                                            ot.order_type_name, 
                                            ot.order_type_id,
                                            tr.status_name
                                      FROM tbl_cart tc
                                      INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id
                                      INNER JOIN tbl_product_type pt ON tp.prod_type = pt.prod_type_id
                                      LEFT JOIN tbl_adds_order ao ON tc.item_id = ao.item_id
                                      LEFT JOIN tbl_add_ons ta ON ao.add_ons_id = ta.add_ons_id
                                      LEFT JOIN tbl_order_type ot ON tc.order_type_id = ot.order_type_id  
                                      LEFT JOIN tbl_product_flavors tf ON tc.fl_id = tf.fl_id
                                      LEFT JOIN tbl_account_details td ON td.account_id = tc.account_id
                                      LEFT JOIN tbl_status tr ON tc.status_id = tr.status_id
                                      WHERE tc.status_id = 2 AND tc.account_id = ? AND tc.order_date = ?
                                      GROUP BY tc.item_id;";
                                      $stmt_orders = $conn->prepare($query_orders);
                                      $stmt_orders->bind_param("is", $account_id, $order_date);
                                      $stmt_orders->execute();
                                      $result_orders = $stmt_orders->get_result();

                                      // Loop through each order and display order details
                                      while ($order_data = $result_orders->fetch_assoc()) {
                                        $total = ($order_data["prod_qnty"] * $order_data["prod_price"]) + $order_data["fl_price"];
                                        $addOnsNames = explode(',', $order_data["add_ons_names"]);
                                        $addOnsPrices = explode(',', $order_data["add_ons_prices"]);
                                        $addOnsText = "None"; // Default value if no add-ons
                                        if (!empty($order_data["add_ons_names"])) {
                                            $addOnsText = "";
                                            foreach ($addOnsNames as $key => $addOn) {
                                                $addOnsText .= $addOn . " - ₱" . number_format($addOnsPrices[$key], 2) . ", ";
                                                $total += $addOnsPrices[$key]; 
                                            }
                                            // Remove the trailing comma and space
                                            $addOnsText = rtrim($addOnsText, ", ");
                                        }
                                      ?>
                                      <div class="mb-3 col-md-6">
                                        <label class="col-form-label text-danger">Order ID</label>
                                        <input type="text" class="form-control" value="<?php echo $order_data["item_id"]; ?>" disabled>
                                      </div>
                                      <div class="mb-3 col-md-6">
                                        <label class="col-form-label">Order Name</label>
                                        <input type="text" class="form-control" value="<?php echo $order_data["prod_name"]; ?>" disabled>
                                      </div>
                                      <div class="mb-3 col-md-6">
                                        <label class="col-form-label">Order Flavor</label>
                                        <input type="text" class="form-control" value="<?php echo $order_data["fl_name"]." ₱".$order_data["fl_price"]; ?>" disabled>
                                      </div>
                                      <div class="mb-3 col-md-6">
                                        <label class="col-form-label">Order Add-Ons</label>
                                        <textarea class="form-control" disabled><?php echo htmlspecialchars($addOnsText); ?></textarea>
                                      </div>
                                      <div class="mb-3 col-md-6">
                                        <label class="col-form-label">Order Price</label>
                                        <input type="text" class="form-control" value="₱<?php echo number_format($order_data["prod_price"], 2); ?>" disabled>
                                      </div>
                                      <div class="mb-3 col-md-6">
                                        <label class="col-form-label">Order Quantity</label>
                                        <input type="text" class="form-control" value="<?php echo $order_data["prod_qnty"]; ?>" disabled>
                                      </div>
                                      <div class="mb-3 pb-5">
                                        <label class="col-form-label">Total</label>
                                        <input type="text" class="form-control" value="₱<?php echo number_format($total, 2); ?>" disabled>
                                      </div>
                                      <?php } ?>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
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
    <script>
      $(document).ready(function() {
          $('#residenceAccounts').DataTable({
              responsive: true,
              order: [[0, 'desc']],
          });
      });
</script>

<script src="../jquery/cancelOrder.js"></script>

    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/template.js"></script>

<script>
      $(document).ready(function() {
          $('#toClaimOrders').DataTable({
              responsive: true,
              order: [[0, 'desc']],
          });
      });
</script>

  </body>
</html>
