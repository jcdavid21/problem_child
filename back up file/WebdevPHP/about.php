<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            margin-left: 330px;
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
            width: 250px;
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
          margin-right: 55px;
          margin-bottom: 50px;
        }

        p{
          margin-left: 100px;
          font-size: large;
          margin-top: 45px;
          margin-right: 90px;
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
    
    

    <h1>ABOUT US</h1>

    <p>Problem Child is more than just a streetwear brand - it's a lifestyle. Our goal is to provide comfortable and well-fitting clothing for those who want to express their unique sense 
        of style. We are a group of young friends who love fashion and urban culture, and we work together to create stylish and fashionable clothing for people who are "against somebody's
         system." Our streetwear brand has become popular among online customers due to our unique and amazing patterns, all made using the best materials to ensure durability and comfort.</p>

        <p>But we don't just want to be known for our clothing. We want to spread positive and empowering messages through our brand, making us stand out from the rest. Fashion is more 
            than just vanity - it's a way for people to express themselves and draw inspiration from others. Each of our products are  made using the best materials and expertly made to provide
             comfort and longevity.</p>

      <p>We understand that the streetwear market can be overwhelming with so many options out there. That's why we try to simplify things for our customers by offering only the finest 
        products at affordable rates. Our founder believes that fashion should be about extending personal individuality rather than just following trends. This is why we create unique,
         daring designs that are meant for individuals who don't mind being different.</p>

         <p>Experience the Problem Child lifestyle today and showcase your unique style through your clothing!</p>


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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>