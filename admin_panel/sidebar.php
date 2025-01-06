<?php
    include_once "./config/dbconnect.php";

    // Assuming you have a users table with a column named 'picture_path'
    $userId = $_SESSION['user_id'];
    $query = "SELECT picture_path FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $picturePath);

        if (mysqli_stmt_fetch($stmt)) {
            // Use the fetched picture_path to display the user profile picture
            $userProfilePicture = $picturePath ? $picturePath : "./assets/images/logo.png";
        } else {
            // If fetching fails, use a default profile picture
            $userProfilePicture = "./assets/images/logo.png";
        }

        mysqli_stmt_close($stmt);
    } else {
        // If preparing the statement fails, use a default profile picture
        $userProfilePicture = "./assets/images/logo.png";
    }
?>
<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
    <div class="side-header">
        <img src="<?php echo $userProfilePicture; ?>" width="120" height="120" style="border-radius: 50%;" alt="Swiss Collection">
        <h5 style="margin-top:10px;">Hello, Admin</h5>
    </div>

    <hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="./POS.php" ><i class="fa fa-home"></i> POINT OF SALE</a>
    <a href="./index.php" ><i class="fa fa-home"></i> Dashboard</a>
    <a href="#customers"  onclick="showCustomers()" ><i class="fa fa-users"></i> Customers</a>
    <a href="#category"   onclick="showCategory()" ><i class="fa fa-th-large"></i> Category</a>
    <a href="#sizes"   onclick="showSizes()" ><i class="fa fa-th"></i> Sizes</a>
    <a href="#productsizes"   onclick="showProductSizes()" ><i class="fa fa-th-list"></i> Product Sizes</a>    
    <a href="#products"   onclick="showProductItems()" ><i class="fa fa-th"></i> Products</a>
    <a href="#orders" onclick="showOrders()"><i class="fa fa-list"></i> Orders</a>
</div>

<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>
