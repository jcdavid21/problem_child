<?php
session_start();
include('../config/dbcon.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Validate form fields
    $requiredFields = ["full_name", "phone_number", "address_region", "postal_code", "street_name"];
    $errors = [];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
        }
    }

    if (empty($errors)) {
        // Sanitize and retrieve user data from the form
        $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
        $phone_number = mysqli_real_escape_string($conn, $_POST["phone_number"]);
        $address_region = mysqli_real_escape_string($conn, $_POST["address_region"]);
        $postal_code = mysqli_real_escape_string($conn, $_POST["postal_code"]);
        $street_name = mysqli_real_escape_string($conn, $_POST["street_name"]);

        // Insert new address into the 'addresses' table using prepared statement
        $insertQuery = "INSERT INTO addresses (user_id, full_name, phone_number, address_region, postal_code, street_name) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insertQuery);

        if ($stmt_insert) {
            mysqli_stmt_bind_param($stmt_insert, "isssss", $_SESSION['user_id'], $full_name, $phone_number, $address_region, $postal_code, $street_name);

            if (mysqli_stmt_execute($stmt_insert)) {
                header("Location: address.php");
                exit();
            } else {
                $errors[] = "Error adding new address: " . mysqli_stmt_error($stmt_insert);
            }

            mysqli_stmt_close($stmt_insert);
        } else {
            $errors[] = "Error preparing statement: " . mysqli_error($conn);
        }
    }
}

// Handle address deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_address_submit"])) {
    // Check if the address ID is set and not empty
    if (!empty($_POST["address_id"])) {
        $address_id = mysqli_real_escape_string($conn, $_POST["address_id"]);

        // Delete the address from the 'addresses' table
        $deleteQuery = "DELETE FROM addresses WHERE address_id = ?";
        $stmt_delete = mysqli_prepare($conn, $deleteQuery);

        if ($stmt_delete) {
            mysqli_stmt_bind_param($stmt_delete, "i", $address_id);

            if (mysqli_stmt_execute($stmt_delete)) {
                // Address deleted successfully
                header("Location: address.php");
                exit();
            } else {
                $errors[] = "Error deleting address: " . mysqli_stmt_error($stmt_delete);
            }

            mysqli_stmt_close($stmt_delete);
        } else {
            $errors[] = "Error preparing delete statement: " . mysqli_error($conn);
        }
    } else {
        $errors[] = "Address ID is missing.";
    }
}

// Your existing code for fetching and displaying addresses
$selectQuery = "SELECT address_id, full_name, phone_number, address_region, postal_code, street_name FROM addresses WHERE user_id = ?";
$stmt_select = mysqli_prepare($conn, $selectQuery);

if ($stmt_select) {
    mysqli_stmt_bind_param($stmt_select, "i", $_SESSION['user_id']);

    if (mysqli_stmt_execute($stmt_select)) {
        mysqli_stmt_bind_result($stmt_select, $db_address_id, $db_full_name, $db_phone_number, $db_address_region, $db_postal_code, $db_street_name);
    } else {
        $errors[] = "Error retrieving addresses: " . mysqli_stmt_error($stmt_select);
    }
} else {
    $errors[] = "Error preparing statement: " . mysqli_error($conn);
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font-awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Problem Child</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap');
        @import url('http://fonts.googleapis.com/css2?family=Poppins&display=swap');
        @font-face {
            font-family: 'glacial_indifferenceregular';
            src: url('glacialindifference-regular-webfont.woff2') format('woff2'),
                url('glacialindifference-regular-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
        @font-face{
            font-family: Horizon;
            src:url(../font/horizon.otf);
        }
        *{
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        html{
            height: 100%;
        }
        /* CSS FOR NAVIGATION BAR */
        nav{
            background-color: #FAE9D7;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
        }
        nav ul{
            width: 100%;
            list-style: none;
            display: flex;
            align-items: center;
        }
        nav li{
            height: 80px;
        }
        nav .logo{
            width: 10%;
            margin-right: 5%;
        }
        nav .name{
            height: 100%;
            padding: 0 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            color: black;
            text-decoration: none;
            font-family: Horizon;
            font-weight: bold;
            font-size: 35px;
        }

        nav .active{
            height: 100%;
            padding: 0 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            color: black;
            text-decoration: none;
            font-family: 'glacial_indifferenceregular';
            font-weight: 300;
            font-size: 20px;
        }

        nav .active:hover{
            background-color: #FAE9D7;
            height: 80%;
        }
        nav li:first-child{
            margin-right: auto;
        }

        .sidebar{
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 250px;
            z-index: 999;
            background-color: #fae9d749;
            backdrop-filter: blur(10px);
            box-shadow: -10px 0 10px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }
        .sidebar li{
            width: 100%;
        }
        .sidebar a{
            width: 100%;
        }


        nav .box{
            margin-top: 20px;
            margin-right: 15px;
            height: 40px;
            display: flex;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 30px;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
        }
        nav .box:hover input{
            width: 180px;
        }
        nav .box input{
            width: 0;
            outline: none;
            border: none;
            font-weight: 500;
            transition: 0.8s;
            background: transparent;
        }

        nav .box a .fa{
            color: #FAE9D7;
            font-size: 18px;
        }
        nav svg{
            margin-top: 25px;
        }

        nav .cart1 a i{
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 32px;
            width: 35px;
        }
        nav .cart1 a{
            text-decoration: none;
        }
        nav .user a i {
          color: black;
          display: flex;
          justify-content: center;
          align-items: center;
          margin-top: 32px;
          width: 35px;
        }
        nav .user a{
            text-decoration: none;
        }
        nav .login a button{
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin-right: 5px;
            margin-left: 5px;
        }
        nav .login a{
            text-decoration: none;
        }
        .button-74 {
          background-color: #fbeee0;
          border: 2px solid #422800;
          border-radius: 30px;
          box-shadow: #422800 4px 4px 0 0;
          color: #422800;
          cursor: pointer;
          display: inline-block;
          font-weight: 600;
          font-size: 18px;
          padding: 0 18px;
          line-height: 35px;
          text-align: center;
          text-decoration: none;
          user-select: none;
          -webkit-user-select: none;
          touch-action: manipulation;
        }

        .button-74:hover {
          background-color: #fff;
        }

        .button-74:active {
          box-shadow: #422800 2px 2px 0 0;
          transform: translate(2px, 2px);
        }


        .menu-button{
            display: none;
        }
        /* Add this style to hide the menu by default */
        .user-menu {
          display: none;
          position: absolute;
          top: 59px;
          right: 95px;
          width: 150px;
          background-color: #fff;
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
          border-radius: 5px;
          z-index: 1;
        }

        .user-menu::before {
          content: '';
          position: absolute;
          top: -10px;
          right: 7px;
          border-style: solid;
          border-width: 0 15px 15px 15px;
          border-color: transparent transparent #fff transparent;
        }

        .user-menu a {
          display: block;
          padding: 10px;
          text-decoration: none;
          color: #333;
          font-size: 13px;
        }

        .user-menu a:hover {
          background-color: #FFF7EE;
        }

        .user:hover .user-menu {
          display: block;
        }

        .user:hover .user-menu:hover {
          display: block;
        }



        
        /* CSS FOR BODY */
        .profile-container{
            margin-top: 50px;
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .profile-box{
            display: inline-block;
            width: 20%;
            height: auto;
        }
        .profile-box1{
            width: 75%;
            height: auto;
        }
        .profile-pic-container {
            display: flex;
            flex-direction: row;
        }

        .profile-pic-container #profile-pic {
            width: 100px;
            height: 100px;  
            border-radius: 50%; 
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 25px;
        }
        .profile-pic-container p{
            font-size: 17px;
            font-weight: 500;
            color: #ccc;
        }
        #profile-pic-input{
            margin-top: 10px;
            margin-bottom: 20px;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-left: 150px;
        }
        .edit-container {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
            margin-left: 10px;
        }
        #profile-pic-input-label{
            margin-top: 5px;
        }
        #profile-pic-input-label:hover{
            color: #bbbbbb;
        }
        .myaccount {
            width: 300px;
            height: 200px;
            padding: 20px;
            border-radius: 10px;
            margin-left: 25px;
        }

        .change-password a p, .addresses a p, .profile a p{
            font-size: 15px;
            margin-left: 50px;
            margin-top: 5px;
            color: #000000;
            cursor: pointer;
        }
        .change-password a p:hover{
            color: #EBC8A4;
        }
        .addresses a p:hover{
            color: #EBC8A4;
        }
        .profile a p:hover{
            color: #EBC8A4;
        }
        

        .flex-box1{
            border-style: solid;
            border-width: thin;
            border-color: gray;
            width: 100%;
            height: 700px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 3%;
            padding-bottom: 100px;
            overflow: auto;
        }
        .info-container{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .second-block-line{
            border: solid;
            border-top: none;
            border-left: none;
            border-right: none;
            width: 100%;
            border-color: gray;
            margin-top: 5px;
        }
        
        .address-container{
            width: 80%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .address-container1{
            width: 80%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .address-container-2{
            width: 80%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .address-container2{
            width: 80%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        .address-container3{
            width: 80%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .title-address{
            font-weight: bold;
            font-size: 20px;
        }
        .add-new-address{
            height: 45px;
            width: 150px;
            background-color: black;
            color: white;
        }
        .add-new-address:hover{
            opacity: 0.8;
            cursor: pointer;
        }
        

        .popup .overlay{
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
            display: none;
        }

        .popup .content{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #fff;
            width: 450px;
            height: 520px;
            z-index: 2;
            padding: 20px;
            box-sizing: border-box;
        }

        .close-btn{
            height: 50px;
            width: 120px;
            background-color: white;
        }

        .close-btn:hover{
            background-color: rgb(180, 178, 178);
            cursor: pointer;
        }

        .submit-btn{
            height: 50px;
            width: 120px;
            background-color: black;
            color: white;
        }

        .submit-btn:hover{
            opacity: 0.8;
            cursor: pointer;
        }

        .popup.active .overlay{
            display: block;
        }
        
   
        .popup.active .content{
            transition: all 300ms ease-in-out;
            transform: translate(-50%,-50%) scale(1);
        }
        .input-box{
            height: 30px;
            width: 400px;
            margin-top: 30px;
        }
        .first-box{
            width: 190px;
            height: 30px;
            margin-right: 10px;
        }
        .second-box{
            width: 190px;
            height: 30px;
        }
        .buttons{
            margin-top: 140px;
            margin-left: 155px;
        }
        .new-address{
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .second-block{
            width: 30%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .second-block1{
            width: 30%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .second-block2{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: right;
        }
        .edit-btn{
            color: blue;
        }
        .edit-btn-2{
            color: blue;
        }
        .edit-btn:hover{
            cursor: pointer;
        }
        .edit-btn-2:hover{
            cursor: pointer;
        }
        .delete-btn{
            margin-left: 10px;
            color: blue;
        }
        .delete-btn:hover{
            cursor: pointer;
        }
        .second-block-secondline{
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .default-btn{
            background-color: black;
            color: white;
            height: 25px;
            width: 120px;
        }
        .default-btn:hover{
            opacity: 0.8;
            cursor: pointer;
        }
        



        /* CSS FOR FOOTER */
        .logo2{
            max-width: 291px;
        }
        .logo2 img{
            width: 60%;
            margin-left: 50px;
        }
        .container1{
            max-width: 1170px;
            margin: auto;
        }
        .row1{
            display: flex;
            flex-wrap: wrap;
        }
        footer{
            background-color: black;
            padding: 50px 0;
            margin-top: 50px;
        }
        .footer-col{
            width: 25%;
            padding: 0 15px;
        }
        .footer-col h4{
            font-size: 18px;
            color: #ffffff;
            text-transform: capitalize;
            margin-bottom: 35px;
            font-weight: 500;
            position: relative;
        }
        .footer-col h4::before{
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            background-color: #fff;
            height: 2px;
            box-sizing: border-box;
            width: 50px;
        }
        .footer-col ul li:not(:last-child){
            margin-bottom: 10px;
        }
        .footer-col ul li a{
            font-size: 16px;
            text-transform: capitalize;
            color: #ffffff;
            font-weight: 300;
            color: #bbbbbb;
            display: block;
        }
        .footer-col ul li a:hover{
            color: #ffffff;
            padding-left: 8px;
        }
        .footer-col .social-links a{
            display: inline-block;
            height: 40px;
            width: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            margin: 0 10px 10px 0;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: #ffffff;
            transition: all 0.5s ease;
        }
        .footer-col .social-links a:hover{
            color: #24262b;
            background-color: #ffffff;
        }
        footer p{
            color: white;
            text-align: center;
            margin-top: 50px;
        }

        /* MEDIA QUERIES */
        @media(max-width: 1344){
          nav .box:hover input{
            width: 130px;
          }
        }
        @media(max-width: 1200px){
            nav .box input{
                width: 0px;
            }
            .hideOnMobile{
                display: none;
            }
            .menu-button{
                display: block;
            }
        }
        @media(max-width: 1170){
          .footer-col{
            width: 10px;
          }
        }
        @media(max-width: 768px){
            .footer-col{
                width: 50%;
                margin-bottom: 30px;
            }
        }
        @media(max-width: 574px){
            .footer-col{
                width: 100%;
            }
            .logo2 img{
                margin-left: 80px;
            }
        }
        @media(max-width: 500px){
            .sidebar{
                width: 100%;
            }
            nav .name{
                font-size: 28.5px;
            }
            .logo2 img{
                margin-left: 80px;
            }
        }
        @media(max-width: 399px){
            nav .name{
                font-size: 25px;
            }
        }

         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
     <!-- NAVIGATION BAR -->
     <nav>
        <ul class="sidebar">
            
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li>
            <div class="box">
            <input type="text" placeholder="Search...">
            <a href="#"></a>
            <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            </li>
            <li><a href="../index.php" class="active">Home</a></li>
            <li><a href="../shop/shop.php" class="active" >Shop</a></li>
            <li><a href="../sizechart/sizechart.php" class="active">Size</a></li>
            <li><a href="../contact/contact.php" class="active">Contact</a></li>
            <li><a href="../cart/cart.php" class="active">Cart</a></li>
            <li><a href="../profile/profile.php" class="active">Profile</a></li>
            <li><a href="../logout/logout.php" class="active">Logout</a></li>
        </ul>
        <ul>
            
            <li><a href="../index.php" class="name"><img class="logo" src="../images/logoR1.png">PROBLEM CHILD</a></li>
            <li class="hideOnMobile"><a href="../index.php" class="active">Home</a></li>
            <li class="hideOnMobile"><a href="../shop/shop.php" class="active" >Shop</a></li>
            <li class="hideOnMobile"><a href="../sizechart/sizechart.php" class="active">Size</a></li>
            <li class="hideOnMobile"><a href="../contact/contact.php" class="active">Contact</a></li>
            <li class="hideOnMobile">
            <div class="box">
            <input type="text" placeholder="Search...">
            <a href="#"></a>        
            <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            </li>
            <li class="hideOnMobile">
            <div class="cart1">
                <a href="../cart/cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            </li>
            </li>
            <li class="hideOnMobile">
            <div class="user">
                <a href="../profile/profile.php"><i class="fa-regular fa-user"></i></a>
                <!-- User menu -->
                <div class="user-menu" style="<?php echo isset($_SESSION['user_id']) ? 'right: -5px;' : ''; ?>">
                  <a href="../profile/profile.php">My Account</a>
                  <a href="#">My Purchases</a>
                  <a href="../logout/logout.php">Logout</a>
                </div>
            </div>
            </li>
            <li class="hideOnMobile">
                <div class="login">
                    <?php
                        // Check if the user is logged in
                        if(isset($_SESSION['user_id'])) {
                            
                        } else {
                            // User is not logged in, display the login button
                            echo '<a href="../login/login.php"><button class="button-74" role="button">Login</button></i></a>';
                        }
                    ?>
                </div>
            </li>
            <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>



    <!-- BODY -->
    <div class="profile-container">
        <div class="profile-box">
        
            <div class="myaccount">
                <h3><i class="fa-regular fa-user" style="margin-right: 10px;"></i>My Account</h3>
                <section class="profile">
                    <a href="../profile/profile.php"><p>Profile</p></a>
                    <!-- Add your profile information here -->
                </section>
                <section class="addresses">
                    <a href="address.php"><p>Addresses</p></a>
                    <!-- Add your addresses here -->
                </section>
                <section class="change-password">
                    <a href="../changepassword/changepassword.php"><p>Change Password</p></a>
                    <!-- Add your change password form here -->
                </section>
            </div>
        </div>
        
        <div class="profile-box1">
            <div class="flex-box1">
                <div class="info-container">
                <div class="address-container">
                    <div class="my-addresses">
                        <h4 class="title-address">My Addresses</h4>
                    </div>
                    <div class="my-addresses">
                        <button class="add-new-address" onclick="togglePo_pup()">Add New Address</button>
                    </div>
                </div>
                <div class="popup" id="popup-1">
                    <div class="overlay"></div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="content">
                            <h2 class="new-address">New address</h2>
                            <input class="first-box" type="text" name="full_name" id="full_name" placeholder="Full Name">
                            <input class="second-box" type="text" name="phone_number" id="phone_number" placeholder="Phone Number">
                            <input class="input-box" type="text" name="address_region" id="address_region" placeholder="Region, Province, City, Barangay">
                            <input class="input-box" type="text" name="postal_code" id="postal_code" placeholder="Postal Code">
                            <input class="input-box" type="text" name="street_name" id="street_name" placeholder="Street Name, Building, House No.">
                            <div class="buttons">
                                <button class="close-btn" onclick="togglePo_pup()">CANCEL</button>
                                <button class="submit-btn" name="submit">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                    </div>
        
                    <script>
                    function togglePo_pup(){
                        document.getElementById("popup-1").classList.toggle("active");
                    }
                    </script>


                    <div class="popup" id="popup-2">
                        <div class="overlay"></div>
                        <form method="post" action="update_address.php">
                            <div class="content">
                                <h2 class="new-address">Edit My address</h2>
                                <input class="first-box" type="text" name="full_name_edit" id="full_name_edit" placeholder="<?php echo htmlspecialchars($row['full_name']); ?>">
                                <input class="second-box" type="text" name="phone_number_edit" id="phone_number_edit" placeholder="<?php echo htmlspecialchars($row['phone_number']); ?>">
                                <input class="input-box" type="text" name="address_region_edit" id="address_region_edit" placeholder="<?php echo htmlspecialchars($row['address_region']); ?>">
                                <input class="input-box" type="text" name="postal_code_edit" id="postal_code_edit" placeholder="<?php echo htmlspecialchars($row['postal_code']); ?>">
                                <input class="input-box" type="text" name="street_name_edit" id="street_name_edit" placeholder="<?php echo htmlspecialchars($row['street_name']); ?>">
                                <div class="buttons">
                                    <button class="close-btn" onclick="cancelEdit(event)">CANCEL</button>
                                    <button class="submit-btn" name="update_address" onclick="submitEditForm()">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <script>
                        function togglePopup(popupId) {
                            document.getElementById(popupId).classList.toggle("active");
                        }

                        function editAddress(fullName, phoneNumber, addressRegion, postalCode, streetName) {
                            // Populate the fields in the edit popup with the information
                            document.getElementById("full_name_edit").value = fullName;
                            document.getElementById("phone_number_edit").value = phoneNumber;
                            document.getElementById("address_region_edit").value = addressRegion;
                            document.getElementById("postal_code_edit").value = postalCode;
                            document.getElementById("street_name_edit").value = streetName;

                            // Show the edit popup
                            togglePopup("popup-2");
                        }

                        function cancelEdit(event) {
                            // Prevent the default form submission behavior
                            event.preventDefault();

                            // Hide the edit popup
                            togglePopup("popup-2");
                        }

                        function submitEditForm() {
                            // Fetch values from the form
                            var fullName = document.getElementById("full_name_edit").value;
                            var phoneNumber = document.getElementById("phone_number_edit").value;
                            var addressRegion = document.getElementById("address_region_edit").value;
                            var postalCode = document.getElementById("postal_code_edit").value;
                            var streetName = document.getElementById("street_name_edit").value;

                            // AJAX request to update the database
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "update_address.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    // Handle the response from the server if needed
                                    console.log(xhr.responseText);
                                }
                            };

                            // Send the data to the server
                            xhr.send(
                                "full_name_edit=" + fullName +
                                "&phone_number_edit=" + phoneNumber +
                                "&address_region_edit=" + addressRegion +
                                "&postal_code_edit=" + postalCode +
                                "&street_name_edit=" + streetName
                            );
                        }
                    </script>


                    <?php
                    // Display existing addresses
                    while (mysqli_stmt_fetch($stmt_select)) {
                        ?>
                        <div class="address-container1">
                            <div class="second-block">
                                <div class="first-block-firstline details">
                                    <div id="full_name"><?php echo htmlspecialchars($db_full_name); ?></div>
                                </div>
                            </div>
                            <div class="second-block1">
                                <div class="first-block-firstline details">
                                    <div class="number" style="color: gray;" id="phone_number"><?php echo htmlspecialchars($db_phone_number); ?></div>
                                </div>
                            </div>
                            <div class="second-block2">
                                <div class="first-block-firstline">
                                    <u class="edit-btn" onclick="editAddress(
                                            '<?php echo htmlspecialchars($db_full_name); ?>',
                                            '<?php echo htmlspecialchars($db_phone_number); ?>',
                                            '<?php echo htmlspecialchars($db_address_region); ?>',
                                            '<?php echo htmlspecialchars($db_postal_code); ?>',
                                            '<?php echo htmlspecialchars($db_street_name); ?>'
                                        )">Edit</u>
                                    <form method="post" action="" style="display: inline-block;">
                                        <input type="hidden" name="address_id" value="<?php echo htmlspecialchars($db_address_id); ?>">
                                        <button style="border: none; font-size: 16px;" class="delete-btn" name="delete_address_submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="address-container2">
                            <div class="second-block-secondline details">
                                <div class="address-info" id="address_region"><?php echo htmlspecialchars($db_address_region); ?></div>
                                <button class="default-btn" onclick="setDefault(<?php echo $db_address_id; ?>)">Set as Default</button>
                            </div>
                        </div>
                        <div class="address-container2">
                            <div class="second-block-secondline">
                                <div class="details">
                                    <div class="first-block-thirdline" id="street_name" id="postal_code">
                                        <?php echo htmlspecialchars($db_street_name) . ', ' . htmlspecialchars($db_postal_code); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="address-container3">
                            <div class="second-block-line"></div>
                        </div>
                        <?php
                    }
                    ?>
                    <script>
                        function setDefault(addressId) {
                        console.log("Setting as default:", addressId);

                        // AJAX request to update the 'address_default' in the database
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "set_default_address.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4) {
                                if (xhr.status == 200) {
                                    // Handle the response from the server if needed
                                    console.log("Response:", xhr.responseText);
                                    // You may want to refresh the address list or update the UI here
                                } else {
                                    console.error("Error:", xhr.status, xhr.statusText);
                                }
                            }
                        };

                        // Send the data to the server
                        xhr.send("address_id=" + addressId);
                    }
                    </script>
                </div>
            </div>
        </div>

    </div>
    


    <!-- FOOTER -->
    <footer class="footer">
        <div class="container1">
            <div class="row1">
                <div class="logo2">
                    <a href="home.php"><img  src="../picture/icon/logo1.png" alt=""></a>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../shop/shop.php">Shop</a></li>
                        <li><a href="../sizechart/sizechart.php">Size Chart</a></li>
                        <li><a href="../contact/contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="../faq/faq.php">FAQ</a></li>
                        <li><a href="../about/about.php">About Us</a></li>
                        <li><a href="../privacypolicy/privacypolicy.php">Privacy Policy</a></li>
                        <li><a href="../terms/terms.php">Terms & Conditions</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/thePrblmChld"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/problemchildswc"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/problemchild.swc"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <p>&copy; Copyright © Problem Child. All rights reserved.</p>
        </div>
        
    </footer> 
    
    <script>
        function showSidebar(){
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }
        function hideSidebar(){
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }
    </script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
</body>
</html>