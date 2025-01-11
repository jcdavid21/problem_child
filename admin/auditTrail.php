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
    <!-- DataTables -->
    <link href="../plugins/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="../plugins/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link href="../styles/bootstrap5-min.css" rel="stylesheet" />
    <link href="../styles/card-general.css" rel="stylesheet" />
    <script src="../scripts/sweetalert2.js"></script>
    <script
      src="../scripts/font-awesome.js"
      crossorigin="anonymous"
    ></script>
     <!-- Include DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  </head>
  <body>
    <div class="container-scroller">
        <!-- Navbar -->
        <?php require_once("./navbar.php"); ?>
        <div class="container-fluid page-body-wrapper">
        <?php require_once("./sidebar.php"); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="container-fluid px-4">
                        <!-- Page indicator -->
                        
                            <ol class="breadcrumb mb-4 bg-white">
                            <li class="breadcrumb-item active fs-3 fw-bolder">Activity Logs</li>
                            </ol>

                            <div class="card mb-5">
                                <div class="card-body table-responsive">
                                <table id="productTable" class="table table-striped nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>User Activty</th>
                                        <th>User Type</th>
                                        <th>Log Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "SELECT * FROM tbl_audit_trail ORDER BY trail_date DESC";
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($data = $result->fetch_assoc()) {
                                            $dateObject = new DateTime($data["trail_date"]);
                                    ?>
                                    <tr>
                                        <td><?php echo $data['trail_user_id'];?></td>
                                        <td><?php echo $data['trail_username'];?></td>
                                        <td><?php echo $data['trail_activity'];?></td>
                                        <td><?php echo $data['trail_user_type'];?></td>
                                        <td><?php echo $dateObject->format('F j, Y g:i A'); ?></td>
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
        });
    </script>
  </body>
</html>
