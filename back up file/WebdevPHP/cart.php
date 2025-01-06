<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROBLEM CHILD</title>
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

    


    .ShopCart
      {
        margin-top: 100px;
        margin-bottom: 0px;
        text-align: center;
        font-size: 23px;
      }

      .TotalItems
      {
        margin-top: 29px;
        text-align: center;
        font-weight: 10px;
        margin-bottom: 20px;
      }

      .flex-container
      {
        display: flex;
      }

      .container1
      {
        margin-top: 50px;
      }
      
      .container2
      {
        margin-top: 50px;
      }

      .container3
      {
        margin-left: 450px;
        
        margin-top: 50px;
      }

      .total-price
      {
        margin-top: 50px;
        margin-left: 50px;
      }

      .container4
      {
        margin-left: 70px;
        margin-top: 50px;
      }

      .Subtotal
      {
        margin-top: 150px;
        margin-left: 250px;
        margin-bottom: 13px;
        
      }


      .price
      {
        margin-left: 10px;
      }

      .container5
      {
        margin-left: 200px;
      }

   
      .hoodie
      {
        margin-left: 250px;
        width: 200px;
      }

     

      .minus
      {
        margin-top: 6px;
        margin-right: 27px;
        border: none;
        background-color: white;
        cursor: pointer;
        align-content: center;  
       
      }
      
      .plus
      {
        border: none;
        margin-left: 27px;
        background-color: white;
        cursor: pointer;
      }

      .incrementbutton
      {
        background-color: white;
        border: none;
      }

      .buttonborder
      {
        border-style: solid;
        border-width: 1px;
        height: 50px;
        width: 150px;
        border-radius: 10px;
        text-align: center;
      }
      
      .checkout
      {
        color: white;
        background-color: black;
        border: none;
        height: 45px;
        width: 185px;
        cursor: pointer;
        margin-left: 50px;
      }

      .checkout:hover
      {
        opacity: 0.8;
      }
      .checkout:active
      {
        color: black;
        background-color: gray;
      }

      .continue
      {
        background-color: white;
        border-width: 1px;
        height: 45px;
        width: 185px;
        cursor: pointer;
      }

      .continue:hover
      {
        
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
      }
      
      .continue:active
      {
        color: white;
        background-color: black;
      }

      .quantity
      {
        text-align: center;
      }

      .heading-5
      {
        margin-top: 0px;
      }

      .BlushingBreeze
      {
        font-size: 1.5em;
      }

     .price
     {
      text-align: center;
     }

     .number
     {
      width: 50px;
      height: 30px;
      text-align: center;
      border: none;
     }
    
     .minus-btn
     {
      font-size: 20px;
      width: 30px;
      height: 30px;
      border: none;
      background-color: white;
     }
     
     .minus-btn:hover
     {
      cursor: pointer;
     }


     .plus-btn
     {
      font-size: 20px;
      width: 30px;
      height: 30px;
      margin-top: 9px;
      border: none;
      background-color: white;
     }

     .plus-btn:hover
     {
      cursor: pointer;
     }

     .quantity
     {
      margin-bottom: 10px;
     }
     
     .total
     {
      margin-bottom: 25px;
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
    
    <h3 class="ShopCart">
      Your Shopping Cart
    </h3>
    <p class="TotalItems">
      Total Items (1)
    </p>


    <div class="w-layout-grid grid">
      <div id="w-node-_19">
              
      </div>

    <div class="flex-container">
        <div class="container1">
          <img class="hoodie" src="picture/all/pic11.png" alt="">
        </div>

        <div class="container2">
          <div class="BlushingBreeze">Blushing Breeze</div>
          <div class="medium">Medium</div>
          <div>₱450.00</div>
        </div>
    
        <div class="container3">
          <div class="quantity">Quantity</div>
          <div class="buttonborder">
      <button class="btn minus-btn disabled" type="button" disabled="disabled">-</button>
      <input class="number" type="text" id="quantity" value="1">
      <button class="btn plus-btn" type="button">+</button>
    </div>
    </div>

    <div class="total-price">
      <div class="total">Total</div>
      <div id="price">450</div>
    </div>

    
  </div>
</div>

<div>
  <h3 class="Subtotal">
    Subtotal:
    <span class="price">₱450.00</span>
  </h3>
</div>

<div class="container5">
  <a href="checkout.php"><button class="checkout">CHECKOUT</button></a>
  <button class="continue"> <a href="home.php" style="text-decoration: none;">CONTINUE SHOPPING</a></button>
</div>

    <script>
      document.querySelector(".minus-btn").setAttribute("disabled", "disabled");

      var valueCount
      var price = document.getElementById("price").innerText;
      function priceTotal()
      {
        var total = valueCount * price;
        document.getElementById("price").innerText = total
      }

      document.querySelector(".plus-btn").addEventListener("click", function()
      {
        valueCount = document.getElementById("quantity").value;
        valueCount++;
        document.getElementById("quantity").value = valueCount;

        if (valueCount > 1)
        {
          document.querySelector(".minus-btn").removeAttribute("disabled");
          document.querySelector(".minus-btn").classList.remove("disabled");
        }
        priceTotal()
      })

      document.querySelector(".minus-btn").addEventListener("click", function()
      {
        valueCount = document.getElementById("quantity").value;
        valueCount--;
        document.getElementById("quantity").value = valueCount

        if (valueCount==1)
        {
          document.querySelector(".minus-btn").setAttribute("disabled", "disabled")
        }
        priceTotal()
      })

    </script>
          

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