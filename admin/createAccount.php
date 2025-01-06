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
  </head>
  <body >
    <div class="container-scroller">
        <!-- Navbar -->
        <?php require_once("./navbar.php"); ?>
        <div class="container-fluid page-body-wrapper">
        <?php require_once("./sidebar.php"); ?>
            <div class="main-panel">
                <div>
                    <div class="row">
                    <div class="container-fluid px-4">
                            <div class="card mb-5 shadow">
                            <div class="card-header bg-secondary text-white text-center">
                                <h5>Create Employee Account</h5>
                            </div>
                            <div class="card-body">
                                <form class="row g-4" method="post" id="createEmpAcc">
                                <!-- Email and Username -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                                </div>
                                <div class="col-md-6">
                                    <label for="uname" class="form-label fw-semibold">Username</label>
                                    <input type="text" class="form-control" id="uname" placeholder="Enter username">
                                </div>

                                <!-- Password and Role -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                                </div>
                                <div class="col-md-6">
                                    <label for="selectRole" class="form-label fw-semibold">Role</label>
                                    <select id="selectRole" class="form-select">
                                    <option value="" disabled selected>Choose role</option>
                                    <option value="3">Cashier</option>
                                    </select>
                                </div>

                                <!-- Personal Details -->
                                <div class="col-md-4">
                                    <label for="fname" class="form-label fw-semibold">First Name</label>
                                    <input type="text" class="form-control" id="fname" placeholder="First name">
                                </div>
                                <div class="col-md-4">
                                    <label for="lname" class="form-label fw-semibold">Last Name</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last name">
                                </div>
                                <div class="col-md-4">
                                    <label for="mname" class="form-label fw-semibold">Middle Name</label>
                                    <input type="text" class="form-control" id="mname" placeholder="Middle name">
                                </div>

                                <!-- Gender and Contact -->
                                <div class="col-md-6">
                                    <label for="gender" class="form-label fw-semibold">Gender</label>
                                    <select name="gender" class="form-select" id="gender">
                                    <option value="" disabled selected>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact" class="form-label fw-semibold">Contact Number</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="contact"
                                    placeholder="e.g., 09123456789"
                                    oninput="validateInput(this)"
                                    pattern="\d*"
                                    maxlength="11"
                                    >
                                </div>

                                <!-- Address -->
                                <div class="col-md-12">
                                    <label for="address" class="form-label fw-semibold">Address</label>
                                    <textarea id="address" class="form-control" rows="3" placeholder="Enter complete address"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" id="submit" class="btn btn-primary btn-lg px-4">
                                    Sign Up
                                    </button>
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
    <script src="../jquery/createAccount.js"></script>
    <script src="../jquery/sideBarProd.js"></script> 
    <script>
    const unameInput = document.getElementById('uname');

        unameInput.addEventListener('input', function(event) {
            // Replace anything that's not a letter or number
            unameInput.value = unameInput.value.replace(/[^a-zA-Z0-9]/g, '');
        });
    </script>

  </body>
</html>
