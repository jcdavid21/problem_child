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
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
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
        .login-box form{
            width: 300px;
            margin-left: 20px;
        }
        .login-box form label{
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
        form input[type="submit"]{
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
    <?php include_once "../components/footer.php"  ?>
    
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