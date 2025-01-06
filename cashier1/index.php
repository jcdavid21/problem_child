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
    <title>Admin Panel</title>
    
  </head>
  <body class="with-welcome-text">
 
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
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                      </li>
                    </ul>
                  </div>
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="statistics-details d-flex align-items-center justify-content-between">
                            <div>
                            <?php
                                $query5 = "SELECT SUM(tp.prod_price * tc.prod_qnty) AS total_sales FROM tbl_cart tc 
                                INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id
                                WHERE status_id = 2;";
                                $stmt5 = $conn->prepare($query5);
                                $stmt5->execute();
                                $result5 = $stmt5->get_result();
                                $data5 = $result5->fetch_assoc();
                            ?>
                              <p class="statistics-title">Total Sales</p>
                              <h3 class="rate-percentage">₱<?php echo $data5["total_sales"] != 0 ? number_format($data5["total_sales"], 2) : "0.00"; ?></h3>
                            </div>

                            <div>
                            <?php
                                $query7 = "SELECT COUNT(item_id) AS total_pending FROM tbl_cart WHERE status_id = 3";
                                $stmt7 = $conn->prepare($query7);
                                $stmt7->execute();
                                $result7 = $stmt7->get_result();
                                $data7 = $result7->fetch_assoc();
                            ?>
                              <p class="statistics-title">Pending Orders</p>
                              <h3 class="rate-percentage"><?php echo $data7["total_pending"] != 0 ? $data7["total_pending"] : "0"; ?></h3>
                            </div>

                            <div>
                            <?php
                                $query6 = "SELECT COUNT(item_id) AS total_claimed FROM tbl_cart WHERE status_id = 2";
                                $stmt6 = $conn->prepare($query6);
                                $stmt6->execute();
                                $result6 = $stmt6->get_result();
                                $data6 = $result6->fetch_assoc();
                            ?>
                              <p class="statistics-title">Success Orders</p>
                              <h3 class="rate-percentage"><?php echo $data6["total_claimed"] ?></h3>
                            </div>

                            <div class="d-none d-md-block">
                            <?php
                                $query8 = "SELECT COUNT(item_id) AS cancelled_orders FROM tbl_cart WHERE status_id = 5";
                                $stmt8 = $conn->prepare($query8);
                                $stmt8->execute();
                                $result8 = $stmt8->get_result();
                                $data8 = $result8->fetch_assoc();
                            ?>
                              <p class="statistics-title">Cancelled Orders</p>
                              <h3 class="rate-percentage">
                                <?php echo $data8["cancelled_orders"] != 0 ? $data8["cancelled_orders"] : "0"; ?>
                              </h3>
                            </div>
                            <div class="d-none d-md-block">
                            <?php
                                $query9 = "SELECT COUNT(item_id) AS reserved_orders FROM tbl_cart WHERE status_id = 6";
                                $stmt9 = $conn->prepare($query9);
                                $stmt9->execute();
                                $result9 = $stmt9->get_result();
                                $data9 = $result9->fetch_assoc();
                            ?>
                              <p class="statistics-title">Reserved Orders</p>
                              <h3 class="rate-percentage">
                                <?php echo $data9["reserved_orders"] != 0 ? $data9["reserved_orders"] : "0"; ?>
                              </h3>
                            </div>

                            <div class="d-none d-md-block">
                                <?php
                                    $query7 = "SELECT COUNT(account_id) total_users FROM tbl_account WHERE role_id = 1";
                                    $stmt7 = $conn->prepare($query7);
                                    $stmt7->execute();
                                    $result7 = $stmt7->get_result();
                                    $data7 = $result7->fetch_assoc();
                                ?>
                              <p class="statistics-title">Number of Users</p>
                              <h3 class="rate-percentage"><?php echo $data7["total_users"] ?></h3>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="">
                            <div class="card card-rounded">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title card-title-dash">Top 5 Products of the Month</h4>
                                    </div>
                                    <div class="list-wrapper">
                                    <ul class="todo-list todo-list-rounded">
                                    <?php 
                                            $query = "SELECT tp.prod_name, SUM(tc.prod_qnty) AS total_sales FROM tbl_cart tc 
                                            INNER JOIN tbl_products tp ON tc.prod_id = tp.prod_id 
                                            WHERE status_id = 2 
                                            GROUP BY tc.prod_id 
                                            ORDER BY total_sales DESC LIMIT 5";
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while($data = $result->fetch_assoc()){
                                                $prodName = $data["prod_name"];
                                                $totalSales = $data["total_sales"];
                                        ?>
                                        <li class="d-block">
                                        <div class="form-check w-100">
                                            <label class="form-check
                                            -label">
                                            <div>
                                                <h6 class="text-dark"><?php echo $prodName; ?></h6>
                                                <p class="text-muted
                                                text-small"><?php echo $totalSales; ?> items sold</p>
                                            </div>
                                            </label>
                                        </li>
                                        <?php } ?>
                                    </ul>
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


<!-- container-scroller -->
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
    <!-- <script src="../assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>
