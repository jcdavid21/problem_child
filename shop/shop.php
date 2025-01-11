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
    <!-- CSS for Collections Link -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <title>Problem Child</title>
    <style>

        

        /* CSS FOR BODY */
        .body-title{
            font-family: Horizon;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            font-size: 45px;
        }
        .w3-third{
            overflow-x: hidden;
            overflow: hidden;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .centered-text {
            font-family: Horizon;
            color: #ffffff;
            text-shadow: 2.5px 2.5px #999999;
            position: absolute;
            font-size: 35px;
            font-weight: bold;
            z-index: 50;    

        }

        .w3-third img {
            margin-top: 5px;
            transition: transform 2.0s;
        }

        .w3-third:hover img {
            transform: scale(1.1);
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
            margin-top: 23%;
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

        @media (max-width: 768px) {
           
            .w3-row-padding .w3-third p{
                font-size: 20px;
            }

            .body-title{
                font-size: 20px;
                padding: 20px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
     <!-- NAVIGATION BAR -->
     <?php include '../components/nav.php'; ?>
    
    <!-- BODY -->
    <h1 class="body-title">COLLECTIONS</h1>
    <div class="w3-row-padding">
        <div class="w3-third">
            
            <p class="centered-text"><a href="../index.php">ALL PRODUCTS</a></p>
            <img src="../images/gallery.png" style="width:100%">
            
        </div>
        <div class="w3-third">
            
            <p class="centered-text"><a href="../tshirt/tshirt.php">T-SHIRT</a></p>
            <img src="../images/edit_gallery1.png" style="width:100%">
            
        </div>
        <div class="w3-third">
            
            <p class="centered-text"><a href="../hoodies/hoodies.php">HOODIES</a></p>
            <img src="../images/edit_gallery2.png" style="width:100%">
            
        </div>
    </div>
    <div class="w3-row-padding">
        <div class="w3-third">
            
            <p class="centered-text"><a href="../bottoms/bottoms.php">BOTTOMS</a></p>
            <img src="../images/edit_gallery3.png" style="width:100%">
            
        </div>
        
    <!-- FOOTER -->
    <?php include '../components/footer.php'; ?>
    
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