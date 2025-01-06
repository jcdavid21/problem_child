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
                                $query5 = "SELECT 
                                    SUM(c.price) + SUM(DISTINCT td.shipping_fee) AS total_sales
                                FROM 
                                    cart c
                                INNER JOIN 
                                    tbl_orders o ON c.cart_id = o.cart_id
                                INNER JOIN 
                                    tbl_order_details td ON o.order_id = td.order_id
                                WHERE 
                                    c.status_id = 4;";
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
                                $query7 = "SELECT COUNT(cart_id) AS total_pending FROM cart WHERE status_id = 1";
                                $stmt7 = $conn->prepare($query7);
                                $stmt7->execute();
                                $result7 = $stmt7->get_result();
                                $data7 = $result7->fetch_assoc();
                            ?>
                              <p class="statistics-title">Pending Orders</p>
                              <h3 class="rate-percentage"><?php echo $data7["total_pending"] != 0 ? $data7["total_pending"] : "0"; ?></h3>
                            </div>
                            
                            <!-- Processing Orders -->
                            <div>
                              <?php 
                                  $query4 = "SELECT COUNT(cart_id) AS total_processing FROM cart WHERE status_id = 2";
                                  $stmt4 = $conn->prepare($query4);
                                  $stmt4->execute();
                                  $result4 = $stmt4->get_result();
                                  $data4 = $result4->fetch_assoc();
                              ?>
                              <p class="statistics-title">Processing Orders</p>
                              <h3 class="rate-percentage"><?php echo $data4["total_processing"] != 0 ? $data4["total_processing"] : "0"; ?></h3>
                            </div>

                            <!-- Shipped Orders -->
                            <div>
                              <?php 
                                  $query3 = "SELECT COUNT(cart_id) AS total_shipped FROM cart WHERE status_id = 3";
                                  $stmt3 = $conn->prepare($query3);
                                  $stmt3->execute();
                                  $result3 = $stmt3->get_result();
                                  $data3 = $result3->fetch_assoc();
                              ?>
                              <p class="statistics-title">Shipped Orders</p>
                              <h3 class="rate-percentage"><?php echo $data3["total_shipped"] != 0 ? $data3["total_shipped"] : "0"; ?></h3>
                            </div>

                            <div>
                            <?php
                                $query6 = "SELECT COUNT(cart_id) AS total_claimed FROM cart WHERE status_id = 4";
                                $stmt6 = $conn->prepare($query6);
                                $stmt6->execute();
                                $result6 = $stmt6->get_result();
                                $data6 = $result6->fetch_assoc();
                            ?>
                              <p class="statistics-title">Delivered Orders</p>
                              <h3 class="rate-percentage"><?php echo $data6["total_claimed"] ?></h3>
                            </div>

                            <div class="d-none d-md-block">
                            <?php
                                $query8 = "SELECT COUNT(cart_id) AS cancelled_orders FROM cart WHERE status_id = 5";
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
                                    $query7 = "SELECT COUNT(user_id) total_users FROM users WHERE isAdmin = 0";
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
                        <div class="col-lg-8 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                      <h4 class="card-title card-title-dash">Sales Line Chart</h4>
                                      <h5 class="card-subtitle card-subtitle-dash">Sales of each month</h5>
                                    </div>
                                    <div id="performanceLine-legend"></div>
                                  </div>
                                  <div class="chartjs-wrapper mt-5">
                                  <?php
                                      date_default_timezone_set('Asia/Manila');
                                      $monthlyBc = [];
                                      $serviceRequestBcCount = [];
                                      $allMonths = [
                                          'January', 'February', 'March', 'April', 'May', 'June',
                                          'July', 'August', 'September', 'October', 'November', 'December'
                                      ];

                                      // Build the query to include all months
                                      $year = date('Y'); // Current year or a specific year if required
                                      $monthlyBcRequest = mysqli_query($conn, 
                                      "SELECT 
                                          m.MonthName AS Month, 
                                          IFNULL(SUM(tc.price) + SUM(DISTINCT td.shipping_fee), 0) AS serviceRequestBcCount, 
                                          '$year' AS Year
                                      FROM 
                                          (SELECT 1 AS MonthNumber, 'January' AS MonthName UNION ALL
                                          SELECT 2, 'February' UNION ALL
                                          SELECT 3, 'March' UNION ALL
                                          SELECT 4, 'April' UNION ALL
                                          SELECT 5, 'May' UNION ALL
                                          SELECT 6, 'June' UNION ALL
                                          SELECT 7, 'July' UNION ALL
                                          SELECT 8, 'August' UNION ALL
                                          SELECT 9, 'September' UNION ALL
                                          SELECT 10, 'October' UNION ALL
                                          SELECT 11, 'November' UNION ALL
                                          SELECT 12, 'December') m
                                      LEFT JOIN 
                                          tbl_receipt tr ON MONTH(tr.uploaded_date) = m.MonthNumber AND YEAR(tr.uploaded_date) = '$year'
                                      LEFT JOIN 
                                          tbl_orders o ON tr.order_id = o.order_id
                                      LEFT JOIN 
                                          cart tc ON o.cart_id = tc.cart_id AND tc.status_id = 4
                                      LEFT JOIN 
                                          tbl_order_details td ON o.order_id = td.order_id
                                      GROUP BY 
                                          m.MonthNumber
                                      ORDER BY 
                                          m.MonthNumber;");

                                      $dataByYear = [];

                                      // Fetch data into the $dataByYear array
                                      foreach ($monthlyBcRequest as $data) {
                                          $month = $data['Month'];
                                          $year = $data['Year'];

                                          if (!isset($dataByYear[$year])) {
                                              $dataByYear[$year] = array_fill(0, 12, 0);
                                          }

                                          $monthIndex = array_search($month, $allMonths);
                                          $dataByYear[$year][$monthIndex] = $data['serviceRequestBcCount'];
                                      }

                                      // Prepare data for display
                                      foreach ($dataByYear as $year => $counts) {
                                          foreach ($allMonths as $index => $month) {
                                              $monthlyBc[] = $month; // Only store the month name
                                              $serviceRequestBcCount[] = $counts[$index];
                                          }
                                      }
                                  ?>


                                    <!-- Pass PHP data to JavaScript -->
                                    <script>
                                        const labels = <?php echo json_encode($monthlyBc); ?>;
                                        const salesData = <?php echo json_encode($serviceRequestBcCount); ?>;
                                    </script>

                                    <canvas id="performanceLine"></canvas>
                                </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 grid-margin stretch-card">
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
                                            $query = "SELECT p.product_name, ts.size_name, SUM(tc.quantity) AS total_sales FROM cart tc
                                            INNER JOIN product_size_variation tp ON tc.variation_id = tp.variation_id
                                            INNER JOIN product p ON tp.product_id = p.product_id
                                            INNER JOIN sizes ts ON tp.size_id = ts.size_id
                                            WHERE tc.status_id = 4
                                            GROUP BY tc.variation_id 
                                            ORDER BY total_sales DESC LIMIT 5";
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while($data = $result->fetch_assoc()){
                                                $prodName = $data["product_name"];
                                                $totalSales = $data["total_sales"];
                                                $sizeName = $data["size_name"];
                                        ?>
                                        <li class="d-block">
                                        <div class="form-check w-100">
                                            <label class="form-check
                                            -label">
                                            <div>
                                                <h6 class="text-dark"><?php echo $prodName.' ('.$sizeName.')'; ?></h6>
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


    <script>
      var monthlyBc = <?php echo json_encode($monthlyBc); ?>;
      var serviceRequestBcCount = <?php echo json_encode($serviceRequestBcCount); ?>;
    </script>

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
    <script src="../jquery/sideBarProd.js"></script>


  </body>
</html>
