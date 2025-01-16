<!-- c:/xampp/htdocs/project_revise/indextest.html -->
<?php 
session_start();
include_once "../config/dbcon.php";
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
            text-align: center;
            margin-top: 40px;
        }
        .text-container{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            margin-bottom: 100px;
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
        <h1>Privacy Policy</h1>
    </div>
    <div class="text-container">
        <div class="text-box">
        <p>This privacy policy discloses the privacy practices for Problem Child. This privacy policy applies solely to information collected by this website. It will notify you of the following:
        </p>
        
        <h4 style="font-size: large;"><br>Information Collection, Use, and Sharing  
        </h4>
        <p>We only collect personally identifiable information that you voluntarily provide to us when you make a purchase or sign up for our newsletter. This information may include your name, email address, phone number, billing and shipping address, payment information, and other information you choose to provide.
        </p>

        <p><br>We use this information to complete transactions, send periodic emails such as order confirmations or newsletter signups, and improve our store and product offerings. 
        </p>

        <p><br>Your information will not be sold or rented to third parties. We only share your information with third party service providers as necessary to complete purchases you authorize, such as processing credit cards, shipping orders, or delivering newsletter emails. 
        </p>

        <p>Unless you ask us not to, we may contact you via email or other channels in the future to tell you about new products, specials, or changes to this privacy policy.
        </p>
       
        <h4 style="font-size: large;"><br>Cookies</h4>
        <p>We use cookies and similar technologies to track user traffic patterns and website usage. This helps us analyze data about web page traffic and improve our website to tailor it to our visitors' needs. Cookies do not provide us access to your computer or any personally identifiable information. 
        </p>

        <p>You can choose to disable cookies through your browser settings. However, this may affect the functionality of the website.
        </p>
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