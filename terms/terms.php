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
        <h1>Terms and Condition</h1>
    </div>
    <div class="text-container">
        <div class="text-box">
        <p>Welcome to Problem Child! These Terms of Use outline the rules and regulations for the use of Problem Child's Website and products.</p>
        <p><br>By accessing this website or purchasing our products, you agree to be bound by these terms and conditions. If you do not agree to all of these terms, do not access or 
            use this website or purchase our products.</p>

        <h4 style="font-size: large;"><br>Use of Website</h4>
        <p><br>You agree not to use our website or products for any unlawful purpose or any purpose prohibited under this clause. You agree not to use our website or products in any way that 
            could damage the website or products or impair anyone else's use of the website or products.</p>

        <p><br>You agree not to use any robot, spider, scraper or other automated means to access our website or products without our express written permission. 
            Additionally, you agree that you will not:</p>

        <p><br>- Violate our intellectual property rights, including copyrights and trademarks</p>
        <p>- Circumvent any security features or content scrambling systems</p>
        <p>- Use our website or products to design, develop or update any similar or competing website or products</p>
        <p>- Employ scraping or similar techniques to aggregate, collect, or index product listings</p>
        <p>- Introduce viruses, spyware, or other malicious code to our website or products</p>

        <h4 style="font-size: large;"><br>User Account and Password</h4>
        <p>If you create an account on our website, you are responsible for maintaining the confidentiality of your user account credentials and activities through your account.
             You agree to notify us immediately if you believe your account has been compromised.</p>

        <h4 style="font-size: large;"><br>Products and Pricing</h4>
        <p>We reserve the right to revise or remove any products or information on our website at our discretion. This includes changing product prices at any time without notice.</p>
       
        <h4 style="font-size: large;"><br>Promotions</h4>
        <p>Promotional offers are only valid during the specified time period or while supplies last. Only one offer or code may be used per order. 
            Offers cannot be combined with other offers or applied to past purchases.</p>

        <h4 style="font-size: large;"><br>Delivery Policy</h4>
        <p>We will try our best to deliver your order on time, however, delays are possible due to high order volumes or unforeseen circumstances. 
            We shall not be liable for delays caused by force majeure events that are beyond our control.</p>
                          
        <h4 style="font-size: large;"><br>Cancellation by Us</h4>
        <p>We reserve the right to cancel your order in the following situations: The product is no longer in stock; there is an error on the website regarding pricing or other 
            product information; we cannot obtain authorization for your payment; we suspect the order may be fraudulent.</p>     
    
        <h4 style="font-size: large;"><br>Governing Law</h4>
        <p>These Terms of Use shall be governed by and construed in accordance with the laws of [Your State], without giving effect to principles of conflict of law. 
            Any disputes related to these Terms or your access to or use of our website will be subject to the exclusive jurisdiction of the state and federal courts in Philippines.</p>     

        <h4 style="font-size: large;"><br>No Refund Once Order Placed</h4>
        <p>
            Once the order is placed, it cannot be canceled or refunded. Please make sure to double-check your order before placing it. 
        </p>


        <h4 style="font-size: large;"><br>Modifications</h4>
        <p>We reserve the right to modify these Terms of Use at any time without notice. Please review these Terms of Use periodically for changes. 
            Your continued access or use of our website or products indicates your acceptance of the modified Terms.</p>    
        
        <h4 style="font-size: large;"><br>Contact Us</h4>
        <p>We reserve the right to modify these Terms of Use at any time without notice. Please review these Terms of Use periodically for changes. 
            Your continued access or use of our website or products indicates your acceptance of the modified Terms.</p>
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