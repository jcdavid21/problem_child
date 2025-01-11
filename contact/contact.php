<!-- c:/xampp/htdocs/project_revise/indextest.html -->
<?php 
session_start();
include_once("../config/dbcon.php");
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


        
        /* CSS FOR BODY */
        .title{
            width: 100%;
            height: auto;
        }
        .title h1{
            font-family: Horizon;
            text-align: center;
            margin-top: 20px;
        }
        .cont-container {
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .cont-box {
            width: 350px;
            height: 337px;
            background: #000000;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .body {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
        }

        .body img {
            width: 170px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .body h3 {
            text-align: center;
            color: #ffffff;
        }
        .cont-box1 {
            width: 500px;
            height: 337px;
            border-style: solid;
            text-align: center;  
        }
        .body1 {
            display: flex;
            flex-direction: row;
            margin-top: 30px;
        }
        .social img{
            padding: 3px;
            width: 50px;
            height: auto;
        }
        .social-links{
            text-align: left;
        }
        /* MEDIA QUERIES FOR BODY */
        @media screen and (max-width: 866px){
            .cont-box{
                width: 450px;
            }
            .cont-box1{
                margin-top: -50px;
                width: 450px;
                margin-bottom: 50px;
            }
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

         
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../styles/navbar.css">
</head>
<body>
    <!-- NAVIGATION BAR -->
    <?php include_once "../components/nav.php"  ?>


    <!-- BODY -->
    <div class="title">
        <h1>Contact Us</h1>
    </div>
    <div class="cont-container">
        <div class="cont-box">
            <div class="body">
                <img src="../images/paperplane.png" alt="">
                <h3>We value your thoughts. <br> Get in touch to share them.</h3>
            </div>
        </div>
        <div class="cont-box1">
            <div class="body1">
                <div class="social">
                <ul>
                    <li><img src="../images/icon/twitter.png" alt=""></li>
                    <li><img src="../images/icon/facebook.png" alt="" style="width: 70px; height: auto; "></li>
                    <li><img src="../images/icon/email.png" alt="" style="width: 50px; height: auto;"></li>
                    <li><img src="../images/icon/instagram.png" alt="" style="width: 47px; height: auto;"></li>
                    <li><img src="../images/icon/phone.png" alt="" style="width: 55px; height: auto;"></li>
                </ul>
                </div>
                <div class="social-links">
                <ul>
                    <li style="margin-top: 18px; font-weight: bold;"><a href="https://twitter.com/problemchildswc" style="text-decoration: none;">https://twitter.com/problemchildswc</a></li>
                    <li style="margin-top: 38px; font-weight: bold;"><a href="https://www.facebook.com/thePrblmChld" style="text-decoration: none;">https://www.facebook.com/thePrblmChld</a></li>
                    <li style="margin-top: 36px; font-weight: bold;"><a href="problemchild.swc@gmail.com" style="text-decoration: none;">problemchild.swc@gmail.com</a></li>
                    <li style="margin-top: 36px; font-weight: bold;"><a href="https://www.instagram.com/prblmchld_official/" style="text-decoration: none;">https://www.instagram.com/prblmchld_official/</a></li>
                    <li style="margin-top: 30px; font-weight: bold; color: #000000;">(+63) 9776089980</li>
                </ul>
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
</body>
</html>