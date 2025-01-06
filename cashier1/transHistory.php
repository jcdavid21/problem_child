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
                    <div class="card-header bg-success pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">Transactions</p>
                        </div>
                    </div>
                    <div class="card-body">
                      <table id="userAuditLogs" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>User Activty</th>
                            <th>User Type</th>
                            <th>Claimed Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $query = "SELECT ts.*, tr.role_name FROM tbl_transactions ts 
                            INNER JOIN tbl_role tr ON tr.role_id = ts.user_type";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                              while ($data = $result->fetch_assoc()) {
                                $dateObject = new DateTime($data["activity_date"]);
                          ?>
                          <tr>
                            <td><?php echo $data['user_id'];?></td>
                            <td><?php echo $data['user_name'];?></td>
                            <td><?php echo $data['user_activity'];?></td>
                            <td><?php echo $data['role_name'];?></td>
                            <td><?php echo $dateObject->format('F j, Y'); ?></td>
                          </tr>
                          <?php
                            }
                          ?>
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
          $('#userAuditLogs').DataTable({
              responsive: true,
              order: [[3, 'desc']],
              dom: 'Bfrtip',
              buttons: [
            {
                extend: 'csvHtml5',
                text: '<i class="fa-solid fa-file-csv fa-2xl" style="color: #1e7b64;"></i>',
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa-solid fa-file-pdf fa-2xl" style="color: #a01818;"></i> ',
            }
        ]
          });
      });
</script>

  </body>
</html>
