<!-- d:/xampp/htdocs/project_revise/indextest.html -->
<?php 
session_start();
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
        
        #searchFormDesktop button, #searchFormMobile button{
            background: transparent;
            border: none;
            cursor: pointer;
        }
        html{
            height: 100%;
        }
        /* navbar css */
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
        .title{
            font-family: Horizon;
            text-align: center;
            margin-top: 30px;
        }
        .text-container{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .text-box{
            width: 75%;
            height: auto;
            margin: 30px;
        }
        .text-box p{
            margin-top: 5px;
            font-size: 16px;
        } 
        .container{
            width: 100%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
            margin-bottom: 100px;
        }
        .row{
            width: 100%;
            height: auto;
            gap: 50px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        .our-team {
            padding: 30px 0 40px;
            margin-bottom: 30px;
            background-color: #f7f5ec;
            text-align: center;
            overflow: hidden;
            position: relative;
        }

        .our-team .picture {
            display: inline-block;
            height: 130px;
            width: 130px;
            margin-bottom: 50px;
            z-index: 1;
            position: relative;
        }

        .our-team .picture::before {
            content: "";
            width: 100%;
            height: 0;
            border-radius: 50%;
            background-color: #000000;
            position: absolute;
            bottom: 135%;
            right: 0;
            left: 0;
            opacity: 0.9;
            transform: scale(3);
            transition: all 0.3s linear 0s;
        }

        .our-team:hover .picture::before {
            height: 100%;
        }

        .our-team .picture::after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #000000;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .our-team .picture img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            transform: scale(1);
            transition: all 0.9s ease 0s;
        }

        .our-team:hover .picture img {
            box-shadow: 0 0 0 14px #f7f5ec;
            transform: scale(0.7);
        }

        .our-team .title {
            display: block;
            font-size: 15px;
            color: #4e5052;
            text-transform: capitalize;
        }

        .our-team .social {
            width: 100%;
            padding: 0;
            margin: 0;
            background-color: #000000;
            position: absolute;
            bottom: -100px;
            left: 0;
            transition: all 0.5s ease 0s;
        }

        .our-team:hover .social {
            bottom: 0;
        }

        .our-team .social li {
            display: inline-block;
        }

        .our-team .social li a {
            display: block;
            padding: 10px;
            font-size: 17px;
            color: white;
            transition: all 0.3s ease 0s;
            text-decoration: none;
        }

        .our-team .social li a:hover {
            color: #000000;
            background-color: #f7f5ec;
        }


        /* puter css */
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

        /* media kwiri */
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
<body>
    <!-- NAVIGATION BAR -->
    <?php include_once "../components/nav.php"; ?>


    <!-- BODY -->
    <div class="title">
        <h1>About us</h1>
    </div>
    <div class="text-container">
        <div class="text-box">
        <p>Problem Child is more than just a streetwear brand - it's a lifestyle. Our goal is to provide comfortable and well-fitting clothing for those who want to express their unique sense of style. We are a group of young friends who love fashion and urban culture, and we work together to create stylish and fashionable clothing for people who are "against somebody's system." Our streetwear brand has become popular among online customers due to our unique and amazing patterns, all made using the best materials to ensure durability and comfort.
            </p>

        <p><br>But we don't just want to be known for our clothing. We want to spread positive and empowering messages through our brand, making us stand out from the rest. Fashion is more than just vanity - it's a way for people to express themselves and draw inspiration from others. Each of our products are  made using the best materials and expertly made to provide comfort and longevity. 
        </p>

        <p><br>We understand that the streetwear market can be overwhelming with so many options out there. That's why we try to simplify things for our customers by offering only the finest products at affordable rates. Our founder believes that fashion should be about extending personal individuality rather than just following trends. This is why we create unique, daring designs that are meant for individuals who don't mind being different.
        </p>

        <p><br>Experience the Problem Child lifestyle today and showcase your unique style through your clothing!</p>
        </div>
    </div>
    
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                
                <div class="our-team">
                    <div class="picture">
                    <img class="img-fluid" src="../images/pogi1.jpeg">
                    </div>
                    <div class="team-content">
                    <h3 class="name">Christopher Licuanan</h3>
                    <h4 class="title">OWNER</h4>
                    </div>
                    <ul class="social">
                    <li><a href="#" class="fa fa-facebook" aria-hidden="true"></a></li>
                    <li><a href="#" class="fa fa-instagram" aria-hidden="true"></a></li>
                    <li><a href="#" class="fa fa-twitter" aria-hidden="true"></a></li>
                    <li><a href="#" class="fa fa-github" aria-hidden="true"></a></li>
                    </ul>
                </div>
                </div>
            </div>
        </div>

    <!-- PUTER -->
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
                        <li><a href="about.php">About Us</a></li>
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
</body>
</html>