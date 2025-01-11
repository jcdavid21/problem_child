<!-- c:/xampp/htdocs/project_revise/indextest.html -->
<?php 
session_start();
require_once("../config/dbcon.php");
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
            font-family: Horizon;
            font-weight: bold;
            margin-top: 30px;
            text-align: center;
            width: 100%;
        }
        .box-container{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }
        .box-body{
            width: 45%;
            height: 550px;
            margin: 30px;
            box-sizing: border-box;
        }
        .box-body p{
            font-size: 25px;
            font-weight: bold;
            text-align: center;
            margin: 20px;
        }
        .box-body img{
            width: 100%;
            height: 481px;
        }
        /* MEDIA QUERIES FOR BODY */
        @media screen and (max-width: 1216px){
            .box-body{
                width: 85%;
            }
            .box-container{
                justify-content: center;
            }
        }
        @media screen and (max-width: 900px){
            .box-body{
                width: 95%;
            }
            .box-container{
                justify-content: space-between;
            }
        }
        @media screen and (max-width: 600px){
            .box-body{
                width: 100%;
                margin-left: 0;
                margin-right: 0;
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
    <?php include_once "../components/nav.php" ?>


    <!-- BODY -->
    <div class="title">
        <h1>SIZE CHART</h1>
    </div>
    <div class="box-container">
        <div class="box-body">
            <p>REGULAR FIT</p>
            <img src="../images/size1.png" alt="REGULAR FIT SIZE">
        </div>
        <div class="box-body">
            <p>OVERSIZE FIT</p>
            <img src="../images/size2.png" alt="OVERSIZE FIT SIZE">
        </div>
    </div>
    <div class="box-container">
        <div class="box-body">
            <p>HOODIE</p>
            <img src="../images/size3.png" alt="REGULAR FIT SIZE">
        </div>
        <div class="box-body">
            <p>LONGSLEEVES</p>
            <img src="../images/size4.png" alt="OVERSIZE FIT SIZE">
        </div>
    </div>


     <!-- FOOTER -->
        <?php include_once "../components/footer.php" ?>
    
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