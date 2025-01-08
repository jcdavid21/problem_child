<!-- c:/xampp/htdocs/project_revise/indextest.html -->
<?php
session_start();
include('../config/dbcon.php');

// Check if the user is already logged in
if (empty($_SESSION["login"])) {
    echo "<script>alert('Please log in first.');</script>";
    echo "<script>window.location.href='../login/login.php';</script>";
    exit;
}

if (isset($_POST["submit"])) {
    $new_password = mysqli_real_escape_string($conn, $_POST["new_password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    // Validate if new password and confirm password match
    if ($new_password != $confirm_password) {
        echo "<script>alert('New password and confirm password do not match.');</script>";
    } else {
        // Fetch user information
        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";
            
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('Password updated successfully.');</script>";
            } else {
                echo "<script>alert('Error updating password: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('User ID not set.');</script>";
        }
    }
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
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .profile-box{
            display: inline-block;
            width: 25%;
            height: auto;
        }
        .profile-box1{
            width: 70%;
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
        

        .flex-box{
            border-style: solid;
            border-width: thin;
            border-color: gray;
            width: 100%;
            height: auto;
            margin-bottom: 50px;
            padding-bottom: 100px;
        }
        
        .change-password1{
            margin-top: 70px;
            margin-left: 50px;
            font-weight: bold;
            font-size: 20px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .shake {
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25%, 75% {
                transform: translateX(-5px);
            }
            50% {
                transform: translateX(5px);
            }
        }
        .security{
            margin-top: 5px;
            margin-left: 50px;
        }

        .manage{
            margin-top: 10px;
            margin-left: 50px;
            font-size: 14px;
        }
        .profile_{
            margin-top: 10px;
            margin-left: 50px;
        }
        .change-pass{
            margin-top: 10px;
            margin-left: 10px;
        }
        form{
            width: 300px;
            margin-left: 20px;
        }
        form label{
            display: flex;
            margin-top: 20px;
            font-size: 18px;
        }
        form input{
            width: 100%;
            padding: 7px;
            border: none;
            border: 1px solid gray;
            outline: none;
        }
        input[type="submit"]{
            width: 150px;
            height: 40px;
            margin-top: 20px;
            margin-left: 60px;
            border: none;
            background-color: black;
            color: white;
            font-size: 18px;
            border-radius: 0px;
        }
        
        
        .input-box{
            background: #fff;
            width: 300px;
            max-width: 500px;
            display: flex;
            align-items: center;
        }
        .input-box img{
            width: 35px;
            cursor: pointer;
        }
        .eye-close{
            position: absolute;
            margin-left: 260px;
            height: 25px;
        }
        .login-box{
          width: 360px;
          height: 270px;
          margin: auto;
          background-color: 3px;
        }
        .confirm:hover{
          cursor: pointer;
          opacity: 0.8;
        }
       .new-password{
        margin-top: 50px;
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

        @media (max-width: 1000px) {
            .profile-container{
                flex-direction: column;
                gap: 0;
            }

            .myaccount{
                height: max-content;
                display: flex;
                align-items: center;
                gap: 50px;
                justify-content: space-between;
            }

            .myaccount h3{
                display: none;
            }
            
            .profile-box1{
                width: 100%;
            }

            .details-input{
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .details-input input{
                margin: 0;
                width: 100%;
                margin-bottom: 40px;
            }

            .profile-box1 .flex-box .form-container{
                padding: 40px;
            }

            .form-container .details-input, .form-container .profile-pic-container{
                margin-left: 0;
            }
            
            .profile-pic-container #profile-pic{
                margin-left: 0;
            }
            
        }
         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
     <!-- NAVIGATION BAR -->
     <?php include_once "../components/nav.php"  ?>



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
                    <a href="../address/address.php"><p>Addresses</p></a>
                    <!-- Add your addresses here -->
                </section>
                <section class="change-password">
                    <a href="changepassword.php"><p>Change Password</p></a>
                    <!-- Add your change password form here -->
                </section>
            </div>
        </div>

        <div class="profile-box1">
            <div class="flex-box">
                <div class="change-password1">
                    <div>Change Password</div>
                </div>
                <div class="security">For your account's security, do not share your password with anyone else.</div>

                <div class="login-box">
                    <form action="" method="post" onsubmit="return validatePassword()">
                        <label class="new-password" for="new_password">New Password</label>
                        <div class="input-box">
                            <input class="input-new-password" type="password" name="new_password" id="new_password" required>
                            <img class="eye-close" src="../images/icon/eye-close.png" onclick="togglePasswordVisibility('new_password', 'eyeicon1')">
                        </div>

                        <label class="confirm-password" for="confirm_password">Confirm Password</label>
                        <div class="input-box">
                            <input class="confirmpass" type="password" name="confirm_password" id="confirm_password" required>
                            <img class="eye-close" src="../images/icon/eye-close.png" onclick="togglePasswordVisibility('confirm_password', 'eyeicon2')">
                        </div>

                        <div id="error-message" class="error-message">Password does not match.</div>

                        <script>
                            function togglePasswordVisibility(inputId, eyeIconId) {
                                let eyeicon = document.getElementById(eyeIconId);
                                let password = document.getElementById(inputId);

                                if (password.type === "password") {
                                    password.type = "text";
                                    eyeicon.src = "../images/icon/eye-open.png";
                                } else {
                                    password.type = "password";
                                    eyeicon.src = "../images/icon/eye-close.png";
                                }
                            }

                            function validatePassword() {
                                let newPassword = document.getElementById("new_password").value;
                                let confirmPassword = document.getElementById("confirm_password").value;
                                let errorMessage = document.getElementById("error-message");

                                if (newPassword !== confirmPassword) {
                                    errorMessage.style.display = "block";
                                    document.getElementById("confirm_password").classList.add("shake");
                                    return false;
                                } else {
                                    errorMessage.style.display = "none";
                                    document.getElementById("confirm_password").classList.remove("shake");
                                    return true;
                                }
                            }
                        </script>

                        <input class="confirm" type="submit" name="submit" value="Confirm">
                    </form>
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
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'flex';
        }

        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'none';
        }

        // Automatically close sidebar if width is 900px or more
        function handleResize() {
            const sidebar = document.querySelector('.sidebar');
            if (window.innerWidth >= 900) {
                sidebar.style.display = 'none';
            }
        }

        // Add event listener for resize
        window.addEventListener('resize', handleResize);
    </script>
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
</body>
</html>