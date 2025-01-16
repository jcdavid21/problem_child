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
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
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

        /* MEDIA QUERIES */
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
                display: block !important;
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
            .w3-row-padding{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .w3-row-padding .w3-third{
                width: 100%;
            }

            .body-title{
                font-size: 35px;
                padding: 20px;
            }
        }

        #searchFormDesktop button, #searchFormMobile button{
            background: transparent;
            border: none;
            cursor: pointer;
        }

        
         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../styles/navbar.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php require_once('../components/nav.php'); ?>


    <!-- BODY -->
    <div class="reg-log-container">
        <div class="container">
            <div class="forms">
                <div class="form login">
                    <span class="title">Login</span>
                    <form action="../functions/authcode.php" method="post">
                        <div class="input-field">
                            <input type="email" name="email" id="email" placeholder="Enter your email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" id="password" class="password" placeholder="Enter your password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="logCheck">
                                <label for="logCheck" class="text">Remember me</label>
                            </div>
                            <a href="../components/forgotpassword.php" class="text">Forgot password?</a>
                        </div>
                        <div class="input-field button">
                            <input type="submit" name="login" id="login" value="Login">
                        </div>
                    </form>
                    <div class="login-signup">
                        <span class="text">Not a member?
                            <a href="#" class="text signup-link">Signup Now</a>
                        </span>
                    </div>
                </div>
                <!-- Registration Form -->
                <div class="form signup">
                    <span class="title">Registration</span>
                    <form action="../functions/authcode.php" method="post">
                        <div class="input-field">
                            <input type="text" name="first_name" id="name" placeholder="Enter your firstname" required>
                            <i class="uil uil-user"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="last_name" id="name" placeholder="Enter your lastname" required>
                            <i class="uil uil-user"></i>
                        </div>
                        <div class="input-field">
                            <input type="email" name="email" id="email" placeholder="Enter your email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="password" id="password" class="password" placeholder="Create a password" required>
                            <i class="uil uil-lock icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="confirm_password" id="confirm_password" class="password" placeholder="Confirm a password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="termCon" name="term_con" value="1">
                                <a href="../terms/terms.php" style="color: black;">
                                    I accept all terms and conditions
                                </a>
                            </div>
                        </div>
                        <div class="input-field button">
                            <input type="submit" name="signup-submit" id="submit" value="Sign up">
                        </div>
                    </form>
                    <div class="login-signup">
                        <span class="text">Already a member?
                            <a href="#" class="text login-link">Login Now</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT FOR BODY -->
    <script>

        const container = document.querySelector(".container"),
        pwShowHide = document.querySelectorAll(".showHidePw"),
        pwFields = document.querySelectorAll(".password"),
        signUp = document.querySelector(".signup-link"),
        login = document.querySelector(".login-link");
        //   js code to show/hide password and change icon
        pwShowHide.forEach(eyeIcon =>{
            eyeIcon.addEventListener("click", ()=>{
                pwFields.forEach(pwField =>{
                    if(pwField.type ==="password"){
                        pwField.type = "text";
                        pwShowHide.forEach(icon =>{
                            icon.classList.replace("uil-eye-slash", "uil-eye");
                        })
                    }else{
                        pwField.type = "password";
                        pwShowHide.forEach(icon =>{
                            icon.classList.replace("uil-eye", "uil-eye-slash");
                        })
                    }
                }) 
            })
        })
        // js code to appear signup and login form
        signUp.addEventListener("click", ( )=>{
            container.classList.add("active");
        });
        login.addEventListener("click", ( )=>{
            container.classList.remove("active");
        });
    </script>



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
</body>
</html>