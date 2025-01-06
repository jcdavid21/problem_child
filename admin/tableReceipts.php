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
    <title>Receipts</title>
    <!-- DataTables -->
    <link href="../plugins/dataTables.bootstrap5.min.css" rel="stylesheet" />

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
                      <table id="productTable" class="table table-striped nowrap" style="width:100%">
                        <thead>
                          <tr>
                              <th>Order Id</th>
                              <th>Customer Name</th>
                              <th>Reference No.</th>
                              <th>Deposited Amount</th>
                              <th>Uploaded Date</th>
                              <th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $query = "SELECT tr.*, CONCAT(td.first_name, ' ', td.last_name) as full_name, td.contact_no
                            FROM tbl_receipt tr
                            INNER JOIN users td ON td.user_id = tr.user_id";
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
                            <td>₱<?php echo number_format($data["deposit_amount"], 2); ?></td>
                            <td><?php echo $formattedDate; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary" id="<?php echo $data["receipt_id"] ?>"  data-bs-toggle="modal" 
                                data-bs-target="#receiptDetails<?php echo $data["receipt_id"] ?>" data-bs-whatever="@getbootstrap">
                                  <i class="fa-solid fa-eye" style="color: #fcfcfc;"></i>
                                </button>
                                <!-- PRINT BUTTON -->
                                <a href="./print.php?order_id=<?php echo $data["order_id"]; ?>" target="_blank">
                                  <button type="button" class="btn btn-success" id="<?php echo $data["receipt_id"] ?>" >
                                    <i class="fa-solid fa-print" style="color: #fcfcfc;"></i>
                                  </button>
                                </a>
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
                                    
                                      <label class="col-form-label fw-bolder">Image Receipt:</label>
                                      <div class="img-con" style="display: flex; justify-content: center;">
                                        <?php 
                                          if($data["receipt_img"] == null){
                                            echo "<h4 class='text-center'>No image uploaded</h4>";
                                          }else{
                                            echo "<img src='../images/receipts/".$data["receipt_img"]."' class='img-fluid' alt='Receipt Image' style='width: 200px; height: 200px;'>";
                                          }
                                        ?>
                                      </div>
                                    </div>
                                      
                                    </form>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " value="<?php echo $data["receipt_id"]; ?>" data-bs-dismiss="modal">Close</button>
                                  </div>
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
