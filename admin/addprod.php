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
    <script
      src="../scripts/font-awesome.js"
      crossorigin="anonymous"
    ></script>
    <style>
      img {
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 5px;
      }
    </style>
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
              <li class="breadcrumb-item active fs-3 fw-bolder">Add Product</li>
            </ol>

                <div class="card mb-5">
                    <div class="card-body">
                    <form class="row g-3" method="post" id="addProd">
                        <h5 class="text-center">Product Details</h5>
                        <hr>
                            <div class="col-md-4">
                                <label for="prod_name" class="form-label">Product Name
                                  <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="prod_name"
                                oninput="validateTextNumberInput(this)">
                            </div>

                            <div class="col-md-4">
                                <label for="prod_price" class="form-label">Product Price
                                <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="prod_price" oninput="validateNumberInput(this)">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="prod_type" class="form-label">Product Type
                                <span class="text-danger">*</span>
                                </label>
                                <select id="prod_type" class="form-select text-dark">
                                    <option value="" disabled selected>Select Product</option>
                                    <?php
                                      $query = "SELECT * FROM category";
                                      $stmt = $conn->prepare($query);
                                      $stmt->execute();
                                      $result = $stmt->get_result();
                                      while($data = $result->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $data["category_id"]; ?>">
                                      <?php echo $data["category_name"];  ?>    
                                    </option>
                                    <?php } ?>
                                </select>      
                            </div>

                            <!-- Product Description -->
                            <div class="col-md-12">
                                <label for="productDesc" class="form-label">Product Description
                                <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="productDesc" style="height: 150px;" rows="5"
                                oninput="validateTextNumberInput(this)"></textarea>
                            </div>

                            <div class="col-md-3">
                                <label for="prod_small" class="form-label">Small Stock
                                <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="prod_small" data-size-id="1" oninput="validateNumberInput(this)">
                            </div>

                            <div class="col-md-3">
                                <label for="prod_medium" class="form-label">Medium Stock
                                <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="prod_medium" data-size-id="2" oninput="validateNumberInput(this)">
                            </div>

                            <div class="col-md-3">
                                <label for="prod_large" class="form-label">Large Stock
                                <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="prod_large" data-size-id="3" oninput="validateNumberInput(this)">
                            </div>

                            <div class="col-md-3">
                                <label for="prod_extra_large" class="form-label">Extra Large Stock
                                <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="prod_extra_large" data-size-id="4" oninput="validateNumberInput(this)">
                            </div>
                            
                            <div class="col-md-3">
                              <label for="prod_img" class="form-label">
                                Product Image <span class="text-danger">*</span>
                              </label>
                              <input type="file" class="form-control" id="prod_img" accept="image/*" onchange="previewImage(event, 'prod_img_preview')">
                              <img id="prod_img_preview" class="img-fluid mt-2" alt="Product Image Preview" style="display: none; max-height: 150px;">
                            </div>

                            <div class="col-md-3">
                              <label for="first_hover_img">First Hover Image</label>
                              <input type="file" class="form-control" id="first_hover_img" accept="image/*" onchange="previewImage(event, 'first_hover_img_preview')">
                              <img id="first_hover_img_preview" class="img-fluid mt-2" alt="First Hover Image Preview" style="display: none; max-height: 150px;">
                            </div>

                            <div class="col-md-3">
                              <label for="second_hover_img">Second Hover Image</label>
                              <input type="file" class="form-control" id="second_hover_img" accept="image/*" onchange="previewImage(event, 'second_hover_img_preview')">
                              <img id="second_hover_img_preview" class="img-fluid mt-2" alt="Second Hover Image Preview" style="display: none; max-height: 150px;">
                            </div>

                            <div class="col-md-3">
                              <label for="third_hover_img">Third Hover Image</label>
                              <input type="file" class="form-control" id="third_hover_img" accept="image/*" onchange="previewImage(event, 'third_hover_img_preview')">
                              <img id="third_hover_img_preview" class="img-fluid mt-2" alt="Third Hover Image Preview" style="display: none; max-height: 150px;">
                            </div>


                            <div class="col-12 text-center mb-4 mt-5">
                                <button type="submit" id="submit" class="btn btn-primary btn-lg">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function validateNumberInput(input) {
    input.value = input.value.replace(/[^0-9]/g, '');
}

function validateTextNumberInput(input) {
    input.value = input.value.replace(/[^a-zA-Z0-9 ]/g, '');
}

function previewImage(event, previewId) {
  const input = event.target;
  const preview = document.getElementById(previewId);

  if (input.files && input.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      preview.src = e.target.result;
      preview.style.display = 'block';
    };

    reader.readAsDataURL(input.files[0]);
  } else {
    preview.style.display = 'none';
  }
}

</script>

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
    <script src="../jquery/addprod.js"></script>
    <script src="../jquery/sideBarProd.js"></script> 
  </body>
</html>
