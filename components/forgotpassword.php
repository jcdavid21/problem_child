<?php
session_start();
include('../config/dbcon.php');

// Check if the user is already logged in
if (!empty($_SESSION["login"])) {
    echo "<script>alert('You are already logged in. Please log out before signing in again.');</script>";
    echo "<script>window.location.href='../index.php';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font-awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
        .submit-btn{
            display: none;
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
        .reg-log-container{
            width: 100%;
            height: auto;
            margin-top: 80px;
            margin-bottom: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container{
            position: relative;
            max-width: 430px;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0 20px;
        }
        .container .forms{
            display: flex;
            align-items: center;
            height: 440px;
            width: 200%;
            transition: height 0.2s ease;
        }
        .container .form{
            width: 50%;
            padding: 30px;
            background-color: #fff;
            transition: margin-left 0.18s ease;
        }
        .container.active .login{
            margin-left: -50%;
            opacity: 0;
            transition: margin-left 0.18s ease, opacity 0.15s ease;
        }
        .container .signup{
            opacity: 0;
            transition: opacity 0.09s ease;
        }
        .container.active .signup{
            opacity: 1;
            transition: opacity 0.2s ease;
        }
        .container.active .forms{
            height: 600px;
        }
        .container .form .title{
            position: relative;
            font-size: 27px;
            font-weight: 600;
            font-family: Horizon;
        }
        .form .title::before{
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            background-color: #000000;
            border-radius: 25px;
        }
        .form .input-field{
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 20px;
        }
        .input-field input{
            position: absolute;
            height: 100%;
            width: 100%;
            padding: 0 35px;
            border: none;
            outline: none;
            font-size: 16px;
            border-bottom: 2px solid #ccc;
            border-top: 2px solid transparent;
            transition: all 0.2s ease;
        }
        .input-field input:is(:focus, :valid){
            border-bottom-color: #000000;
        }
        .input-field i{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 23px;
            transition: all 0.2s ease;
        }
        .input-field input:is(:focus, :valid) ~ i{
            color: #000000;
        }
        .input-field i.icon{
            left: 0;
        }
        .input-field i.showHidePw{
            right: 0;
            cursor: pointer;
            padding: 10px;
        }
        .form .checkbox-text{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
        }
        .checkbox-text .checkbox-content{
            display: flex;
            align-items: center;
        }
        .checkbox-content input{
            margin-right: 10px;
            accent-color: #000000;
        }
        .form .text{
            color: #333;
            font-size: 14px;
        }
        .form a.text{
            color: #4070f4;
            text-decoration: none;
        }
        .form a:hover{
            text-decoration: underline;
        }
        .form .button{
            margin-top: 35px;
        }
        .form .button input{
            border: none;
            color: #fff;
            font-size: 17px;
            font-weight: 500;
            letter-spacing: 1px;
            border-radius: 6px;
            background-color: #000000;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .button input:hover{
            background-color: #242424;
        }
        .form .login-signup{
            margin-top: 30px;
            text-align: center;
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

        .input-password{
            display: none;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- NAVIGATION BAR -->
     <?php include "./nav.php" ?>


    <!-- BODY -->
    <div class="reg-log-container">
        <div class="container">
            <div class="forms">
                <div class="form login">
                    <span class="title">Reset Password</span>
                    <form>
                        <div class="input-field">
                            <input type="email" name="email" id="email" placeholder="Enter your email" >
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <!-- 6 digits code -->
                            <input type="text" name="authcode" id="authcode" placeholder="Enter your 6-digit code" >
                            <i class="uil uil-lock icon"></i>
                        </div>
                        <div class="input-field input-password">
                            <input type="password" name="password" id="password" class="password" placeholder="Enter your new password" >
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                        <div class="input-field button sendCode-btn">
                            <input type="submit" name="sendCode" id="sendCode" value="Send Code">
                        </div>

                        <div class="input-field button submit-btn">
                            <input type="submit" name="submit" id="submit" value="Submit">
                        </div>
                    </form>
                    <div class="login-signup">
                        <span class="text">Remember your password?</span>
                            <a href="../login/login.php">Login Now</a>
                        </span>
                    </div>
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

    <script src="../js/forgotpass.js"></script>
    
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
</body>
</html>