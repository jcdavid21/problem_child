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

    <script src="../scripts/sweetalert2.js"></script>
    <script
      src="../scripts/font-awesome.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
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
                    <div class="card-header bg-info pt-3">
                        <div class="text-center">
                            <p class="card-title text-light">Online Receipt Orders
                        </div>
                    </div>
                    <div class="card-body">
                      <table id="residenceAccounts" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Order Id</th>
                              <th>Customer Name</th>
                              <th>Reference No.</th>
                              <th>Uploaded Date</th>
                              <th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $query = "SELECT tr.*, CONCAT(td.first_name, ' ', td.middle_name, ' ', td.last_name) as full_name,
                            td.address, td.contact
                            FROM tbl_receipt tr
                            INNER JOIN tbl_account_details td ON td.account_id = tr.account_id";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                              while ($data = $result->fetch_assoc()) {
                                $dateObject = new DateTime($data["uploaded_date"]);
                                $formattedDate = $dateObject->format('M j, Y');
                          ?>
                          <tr>
                            <td><?php echo $data['receipt_id'];?></td>
                            <td><?php echo $data['full_name'];?></td>
                            <td><?php echo $data["receipt_number"]; ?></td>
                            <td><?php echo $formattedDate; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" id="<?php echo $data["receipt_id"] ?>"  data-bs-toggle="modal" 
                                data-bs-target="#receiptDetails<?php echo $data["receipt_id"] ?>" data-bs-whatever="@getbootstrap">
                                  <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                </button>
                            </td>
                          </tr>
                            <div class="modal fade" id="receiptDetails<?php echo $data["receipt_id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <form method="post">
                                    
                                      <label class="col-form-label">Image Receipt:</label>
                                      <div class="img-con" style="width: 350px;">
                                        <img src="../backend/receipts/<?php echo $data["receipt_img"]; ?>" alt=""
                                        style="width: 350px;">
                                      </div>
                                    </div>
                                      
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                  <!-- <button type="button" class="btn btn-primary btn-accept updateResBtn" value="<?php echo $data["receipt_id"] ?>" >
                                      Save
                                  </button> -->
                                    <button type="button" class="btn btn-secondary " value="<?php echo $data["receipt_id"]; ?>" data-bs-dismiss="modal">Close</button>
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
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/template.js"></script>
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

<script>
      $(document).ready(function() {
          $('#toClaimOrders').DataTable({
              responsive: true,
              order: [[0, 'desc']],
          });
      });
</script>

<script>
    const full_name = document.getElementById('full_name');
    const acc_data = JSON.parse(localStorage.getItem('cashierDetails'))
    full_name.innerText = 'Cashier, ' + acc_data.full_name;
  </script>  
  </body>
</html>
