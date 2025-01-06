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
                                        <?php
                                            if (isset($_GET['type'])) {
                                                $prodId = intval($_GET["type"]);
                                                $query = "SELECT * FROM category WHERE category_id = ?";
                                                $stmt = $conn->prepare($query);
                                                $stmt->bind_param("i", $prodId);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $data = $result->fetch_assoc();
                                                echo $data["category_name"];
                                            } else {
                                                echo "Products";
                                            }
                                        ?>
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
                                                if (isset($_GET['type'])) {
                                                    $prodId = intval($_GET["type"]);
                                                    $query = "SELECT * FROM product WHERE category_id = ? AND availability = 1";
                                                    $stmt = $conn->prepare($query);
                                                    $stmt->bind_param("i", $prodId);
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
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#residenceAccountDetails<?php echo $data["product_id"]; ?>">
                                                            <i class="fa-solid fa-pen-to-square" style="color: #fcfcfc;"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger deleteResBtn" value="<?php echo $data["product_id"]; ?>">
                                                            <i class="fa-solid fa-circle-xmark" style="color: #fcfcfc;"></i>
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
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Product Name</label>
                                                                        <input type="text" class="form-control updatedName" value="<?php echo $data["product_name"]; ?>" >
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Product Description</label>
                                                                        <input type="text" class="form-control updatedDesc" value="<?php echo $data["product_desc"]; ?>" > 
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Product Price</label>
                                                                        <input type="number" class="form-control updatedPrice" value="<?php echo $data["price"]; ?>" >
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Small Stocks</label>
                                                                        <?php 
                                                                            $smallStocks = "SELECT size_id, quantity_in_stock, variation_id FROM product_size_variation WHERE product_id = ? AND size_id = 1";
                                                                            $stocksStmt = $conn->prepare($smallStocks);
                                                                            $stocksStmt->bind_param("i", $data["product_id"]);
                                                                            $stocksStmt->execute();
                                                                            $stocksResult = $stocksStmt->get_result();
                                                                            $stocksData = $stocksResult->fetch_assoc();
                                                                        ?>
                                                                        <input type="hidden" name="variation" class="variationSmall" value="<?php echo $stocksData["variation_id"]; ?>">
                                                                        <input type="number" class="form-control updatedSmallStock" value="<?php echo $stocksData["quantity_in_stock"]; ?>" >
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Medium Stocks</label>
                                                                        <?php 
                                                                            $mediumStocks = "SELECT size_id, quantity_in_stock, variation_id FROM product_size_variation WHERE product_id = ? AND size_id = 2";
                                                                            $stocksStmt = $conn->prepare($mediumStocks);
                                                                            $stocksStmt->bind_param("i", $data["product_id"]);
                                                                            $stocksStmt->execute();
                                                                            $stocksResult = $stocksStmt->get_result();
                                                                            $stocksData = $stocksResult->fetch_assoc();
                                                                        ?>
                                                                        <input type="hidden" name="variation" class="variationMedium" value="<?php echo $stocksData["variation_id"]; ?>">
                                                                        <input type="number" class="form-control updatedMediumStock" value="<?php echo $stocksData["quantity_in_stock"]; ?>" >
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Large Stocks</label>
                                                                        <?php 
                                                                            $largeStocks = "SELECT size_id, quantity_in_stock, variation_id FROM product_size_variation WHERE product_id = ? AND size_id = 3";
                                                                            $stocksStmt = $conn->prepare($largeStocks);
                                                                            $stocksStmt->bind_param("i", $data["product_id"]);
                                                                            $stocksStmt->execute();
                                                                            $stocksResult = $stocksStmt->get_result();
                                                                            $stocksData = $stocksResult->fetch_assoc();
                                                                        ?>
                                                                        <input type="hidden" name="variation" class="variationLarge" value="<?php echo $stocksData["variation_id"]; ?>">
                                                                        <input type="number" class="form-control updatedLargeStock" value="<?php echo $stocksData["quantity_in_stock"]; ?>" >
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="col-form-label">Extra Large Stocks</label>
                                                                        <?php 
                                                                            $extraLargeStocks = "SELECT size_id, quantity_in_stock, variation_id FROM product_size_variation WHERE product_id = ? AND size_id = 4";
                                                                            $stocksStmt = $conn->prepare($extraLargeStocks);
                                                                            $stocksStmt->bind_param("i", $data["product_id"]);
                                                                            $stocksStmt->execute();
                                                                            $stocksResult = $stocksStmt->get_result();
                                                                            $stocksData = $stocksResult->fetch_assoc();
                                                                        ?>
                                                                        <input type="hidden" name="variation" class="variationExtraLarge" value="<?php echo $stocksData["variation_id"]; ?>">
                                                                        <input type="number" class="form-control updatedExtraLargeStock" value="<?php echo $stocksData["quantity_in_stock"]; ?>" >
                                                                    </div>
                                                                    
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary btn-accept updateResBtn" value="<?php echo $data["product_id"]; ?>">Save</button>
                                                                <button type="button" class="btn btn-secondary " value="<?php echo $data["product_id"]; ?>" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
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
    <script src="../jquery/modifyProd.js"></script>
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
