<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('http://fonts.googleapis.com/css2?family=Poppins&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        @font-face{
            font-family: Horizon;
            src:url(font/horizon.otf);
        }
        header{
            width: 100%;
            height: 100px; 
            background: #FAE9D7;
            display: flex;
            align-items: center;
        }
        body{
          background-color: #F6F5F0;
        } 
        .logo img{
            width: 150px;
            height: auto;
        }
        .text{
            color: rgb(44, 44, 44);
            font-size: 1.5em;
        }
        .text a{
            font-family: Horizon;
            text-decoration: none;
            color: rgb(0, 0, 0);
            font-size: 1.5em;
        }
        .logo{
            color: rgb(44, 44, 44);
            font-size: 1.5em;
        }
        .nav{
            display: flex;
            align-items: center;
            margin-left: 385px;
        }
        .nav ol{
            display: flex;
            list-style: none;
        }
        .nav ol li{
            margin: 1em;
        }
        .nav ol li a{
            text-decoration: none;
            padding: 0.2em 1.2em 0.9em 1.2em;
            border-radius: 10px 10px 0 0;
            color: rgb(39, 39, 39);
            transition: all .4s;
            position: relative;
            z-index: 1;
        }
        .nav ol li a::before{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 41px;
            border-radius: 10px 10px 0 0;
            background: #853333;
            transform-origin: bottom;
            background: linear-gradient(to right, #A69CAC, #474973, #2D2D2B);
            transform: scaleY(0.05);
            z-index: -1;
            transition: all 0.4s;
        }
        .nav ol li a:hover::before{transform: scaleY(1.1);}
        .nav ol li a:hover{color: white;}


        .box{
            height: 50px;
            display: flex;
            cursor: pointer;
            padding: 10px 20px;
            background: #A69CAC;
            border-radius: 30px;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            margin-left: 20px;
        }
        .box:hover input{
            width: 200px;
        }
        .box input{
            width: 0;
            outline: none;
            border: none;
            font-weight: 500;
            transition: 0.8s;
            background: transparent;
        }

        .box a .fa{
            color: #FAE9D7;
            font-size: 18px;
        }


        .cart a i{
            color: black;
            display: flex;
            margin-left: 20px;
        }
        .cart a{
            text-decoration: none;
        }
        .user a i{
            color: black;
            display: flex;
            margin-left: 20px;
        }
        .user a{
            text-decoration: none;
        }
        .logout a i{
            color: black;
            display: flex;
            margin-left: 20px;
        }
        .logout a{
            text-decoration: none;
        }


        h1{
          font-family: Horizon;
          text-align: center;
          margin-top: 20px;
          margin-right: 60px;
        }

        .text1 h4{
            margin-left: 100px;
            margin-top: 60px;
            font-size: x-large;

        }
        .text1 p{
            margin-left: 100px;
            margin-top: 10px;
            margin-right: 7px;
            font-size: large;
            margin-right: 90px;
        }

        .text2 h4{
            margin-left: 100px;
            margin-top: 60px;
            font-size: x-large;
        }
        .text2 p{
            margin-left: 100px;
            margin-right: 90px;
            margin-top: 10px;
            margin-right: 7px;
            font-size: large;
        }

        
      .logo2 img{
        position: absolute;
        margin-left: 20px;
        width: 118px;
        height: 106px;
      }
      .logo2 img{
        position: absolute;
        margin-top: -3%;
        margin-left: -28%;
        width: 200px;
        height: 190px;
      }
      footer {
      background-color: black;
      color: #fff;
      padding: 50px;
      text-align: center;
      margin-top: 10%;
      }

      .footer-content {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .footer-links {
      margin-left: 390px;
      list-style: none;
      padding: 0;
      margin-top: -20px;
    }

      .footer-links li {
      display: inline;
      margin: 0 10px;
    }

    .footer-links a {
     text-decoration: none;
      color: #fff;
    }
    .footer-links .icon img{
        margin-left: 250px;
        width: 55px;
    }
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
    <header>
        <a class="logo" href="home.php"><img src="picture/icon/logo.png" alt=""></a>
        <h2 class="text"><a href="home.php">PROBLEM CHILD</a></h2>
        <div class="nav">
            <ol>
                <li><a href="home.php">Home</a></li>
                <li><a href="Shop.php">Shop</a></li>
                <li><a href="sizechart.php">Size Chart</a></li>
                <li><a href="contact.php">Contacts</a></li>
            </ol>
            <div class="box">
                <input type="text" placeholder="Search...">
                <a href="#"></a>
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="cart">
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class="user">
                <a href="Login.php"><i class="fa-regular fa-user"></i></a>
            </div>
            <div class="logout">
                <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </header>
    
   
    <h1>Terms and Condition</h1>



    <div class="text1">
        <p style="margin-top: 80px;">Welcome to Problem Child! These Terms of Use outline the rules and regulations for the use of Problem Child's Website and products.</p>
        <p style="margin-top: 30px;">By accessing this website or purchasing our products, you agree to be bound by these terms and conditions. If you do not agree to all of these terms, do not access or 
            use this website or purchase our products.</p>
        <h4>Use of Website</h4>
        <p>You agree not to use our website or products for any unlawful purpose or any purpose prohibited under this clause. You agree not to use our website or products in any way that 
            could damage the website or products or impair anyone else's use of the website or products.</p>
         <p style="margin-top: 30px;">You agree not to use any robot, spider, scraper or other automated means to access our website or products without our express written permission. 
            Additionally, you agree that you will not:</p>
          <p style="margin-top: 30px;">- Violate our intellectual property rights, including copyrights and trademarks</p>
          <p>- Circumvent any security features or content scrambling systems</p>
          <p>- Use our website or products to design, develop or update any similar or competing website or products</p>
          <p>- Employ scraping or similar techniques to aggregate, collect, or index product listings</p>
          <p>- Introduce viruses, spyware, or other malicious code to our website or products</p>  
  


    

    <div class="text2">
        <h4>User Account and Password</h4>
        <p>If you create an account on our website, you are responsible for maintaining the confidentiality of your user account credentials and activities through your account.
             You agree to notify us immediately if you believe your account has been compromised.</p>

        <h4>Products and Pricing</h4>
            <p>We reserve the right to revise or remove any products or information on our website at our discretion. This includes changing product prices at any time without notice.</p>
       
        <h4>Promotions</h4>
             <p>Promotional offers are only valid during the specified time period or while supplies last. Only one offer or code may be used per order. 
                Offers cannot be combined with other offers or applied to past purchases.</p>

        <h4>Delivery Policy</h4>
                 <p>We will try our best to deliver your order on time, however, delays are possible due to high order volumes or unforeseen circumstances. 
                    We shall not be liable for delays caused by force majeure events that are beyond our control.</p>
                          
        <h4>Cancellation by Us</h4>
                 <p>We reserve the right to cancel your order in the following situations: The product is no longer in stock; there is an error on the website regarding pricing or other 
                    product information; we cannot obtain authorization for your payment; we suspect the order may be fraudulent.</p>     
    
        <h4>Governing Law</h4>
                 <p>These Terms of Use shall be governed by and construed in accordance with the laws of [Your State], without giving effect to principles of conflict of law. 
                    Any disputes related to these Terms or your access to or use of our website will be subject to the exclusive jurisdiction of the state and federal courts in Philippines.</p>     

        <h4>Modifications</h4>
                 <p>We reserve the right to modify these Terms of Use at any time without notice. Please review these Terms of Use periodically for changes. 
                    Your continued access or use of our website or products indicates your acceptance of the modified Terms.</p>    
        
        <h4>Contact Us</h4>
                <p>We reserve the right to modify these Terms of Use at any time without notice. Please review these Terms of Use periodically for changes. 
                       Your continued access or use of our website or products indicates your acceptance of the modified Terms.</p>    
            </div>


    <footer>
        <div class="footer-content">
          
          <div class="logo2">
            <a href="home.php"><img  src="picture/icon/logo1.png" alt=""></a>
          </div>
  
            <ul class="footer-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="Shop.php">Shop</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="sizechart.php">Size Chart</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="terms.php">Terms and Condition</a></li>
                <a href="https://www.facebook.com/thePrblmChld" class="icon"><img src="picture/icon/facebook.png" alt=""></a>
                <a href="https://www.instagram.com/problemchild.swc"><img src="picture/icon/instagram.png" alt="" style="width: 43px; margin-left: -10px; "></a>
                <a href="https://twitter.com/problemchildswc"><img src="picture/icon/twitter.png" alt="" style="width: 39px;"></a>
            </ul>
            <p style="font-size: 12px; margin-top: 3%;">&copy; Copyright © Problem Child. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>