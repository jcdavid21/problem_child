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
    <script src="../scripts/sweetalert2.js"></script>
     <!-- Include DataTables CSS -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  </head>
  <body >
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
            <h4 class="card-title">Active Users</h4>
            
                <div class="table-responsive">
                <table id="productTable" class="table table-striped nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Account ID</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Address Region</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Date of Registered</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT tu.user_id, CONCAT(tu.first_name, ' ', tu.last_name) as full_name, tu.email, tu.gender, td.phone_number, tu.date_of_birth, tu.picture_path, tu.registered_at, tu.isAdmin, td.address_region FROM users tu
                                LEFT JOIN addresses td ON tu.user_id = td.user_id
                                 WHERE tu.status_id = 1 AND td.address_default = 1 ORDER BY tu.registered_at DESC";
                                $stmt = $conn->prepare($query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($data = $result->fetch_assoc()) {
                                    $formattedDate = date("F j, Y", strtotime($data["registered_at"]));
                            ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $data['picture_path'];?>" alt="image" class="img-sm rounded-circle" style="height: 60px; width: 60px; object-fit: contain;" />
                                </td>
                                <td><?php echo $data['user_id'];?></td>
                                <td><?php echo $data["isAdmin"] == 0 ? 'Customer' : 'Admin';?></td>
                                <td><?php echo $data['full_name'];?></td>
                                <td><?php echo $data['address_region'];?></td>
                                <td><?php echo $data['phone_number'] != null ? $data["phone_number"] : 'No contact # yet';?></td>
                                <td><?php echo $data['email'];?></td>
                                <td><?php echo $formattedDate;?></td>
                                <!-- <td>
                                    <button type="button" class="btn btn-danger deactivateResBtn" id="<?php echo $data["user_id"] ?>" >
                                    <i class="fa-solid fa-circle-xmark"  style="color: #fcfcfc;"></i>
                                    </button>
                                </td> -->
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
    <script src="../jquery/deactivate.js"></script>
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
