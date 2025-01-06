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



        .img{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .img img{
            width: 100%;
            margin-top: 1px;
        }
        h1{
          font-family: Horizon;
          margin-top: 30px;
          text-align: center;
          margin-right: 100px ;
        }
        .image{
          margin-left: 1040px;
          margin-top: 170px;
          margin-right: 300px;
          position: absolute;
          float: right;
        }
        .image1{
        margin-top: -220px;
        position: absolute;
        float:left;
       }
       .image1 img{
        margin-left: 30px;
       }
       .image2{
        position: absolute;
        left: 1020px;
        margin-top: 300px;
       }
       .image2 img{
        width: 410px;
        height: 360px;
       }
       .image3{
        position: absolute;
        left: 30px;
        margin-top: 300px
       }
       .image3 img{
        width: 430px;
        height: 380px;
       }

       .title{
        margin-left: 1330px;
        font-weight: bold;
        position: absolute;
        margin-top: 50px;
        font-size: x-large;
       }
       .title1{
        margin-left: 340px;
        font-weight: bold;
        position: absolute;
        margin-top: -350px;
        font-size: x-large;
       }
       .title2{
        margin-left: 1330px;
        font-weight: bold;
        position: absolute;
        margin-top: 210px;
        font-size: x-large;
       }
       .title3{
        margin-left: 340px;
        font-weight: bold;
        position: absolute;
        margin-top: 200px;
        font-size: x-large;
       }
       .list{
        position: absolute;
        font-size: medium;
        left: 1463px;
        margin-top: 230px;
        line-height: 44px;
        list-style-type: none;
       }
       .list1{
        position: absolute;
        font-size: medium;
        left: 450px;
        margin-top: -158px;
        line-height: 40px;
        list-style-type: none;
       }
       .list2{
        position: absolute;
        font-size: medium;
        left: 1460px;
        margin-top: 382px;
        line-height: 41px;
        list-style-type: none;
       }
       .list3{
        position: absolute;
        font-size: medium;
        left: 470px;
        margin-top: 385px;
        line-height: 42px;
        list-style-type: none;
       }
       .table {
         width: 14%;
         margin-top: 200px;
         margin-left: 1500px;
         padding-top: -80px;
         border-collapse: collapse;
       }
       .table1 {
         width: 14%;
         margin-top: -10%;
         margin-left: 500px;
         border-collapse: collapse;
         position: absolute;
       }

       .table2 {
         width: 14%;
         margin-top: 350px;
         margin-left: 1500px;
         border-collapse: collapse;
         position: absolute;
       }
       
       .table3 {
         width: 14%;
         margin-top: 350px;
         margin-left: 520px;
         border-collapse: collapse;
         position: absolute;
       }
       

         th, td {
        border: 1px solid #000000;
        text-align: center;
        padding: 10px;
       }

         tr:nth-child(even) {
        background-color: #ffffff;
       }
       th:nth-child(odd) {
        background-color: #ffffff;
       }
       th:nth-child(even) {
        background-color: #ffffff;
       }
       td:nth-child(even) {
        background-color: #ffffff;
       }
       td:nth-child(odd) {
        background-color: #ffffff;
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
      margin-top: 50%;
      }

      .footer-content {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .footer-links {
      margin-left: 490px;
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
    
    <div class="img">
        <img src="" alt="">
    </div>

    <h1>SIZE CHART</h1>

    <div class="image">
          <img src="picture/icon/image1.png" alt="">
    </div>

    <div class="title">
      <p>OVERSIZE FIT</p>
    </div>

    <ul class="list">
      <li>S</li>
      <li>M</li>
      <li>L</li>
      <li>XL</li>
    </ul>

    <table class="table">
      <tr>
        <th>LENGTH</th>
        <th>WIDTH</th>
      </tr>
      <tr>
        <td>27"</td>
        <td>17"</td>
      </tr>
      <tr>
        <td>28"</td>
        <td>18"</td>
      </tr>
      <tr>
        <td>29.5"</td>
        <td>20"</td>
      </tr>
      <tr>
        <td>31"</td>
        <td>22"</td>
      </tr>
      <tr>
    </table>

    <div class="image1">
    <img src="picture/icon/image1.png" alt="">
    </div>

    <div class="title1">
    <p>REGULAR FIT</p>
    </div>

    <ul class="list1">
      <li>XS</li>
      <li>S</li>
      <li>M</li>
      <li>L</li>
      <li>XL</li>
      <li>XXL</li>
    </ul>

    <table class="table1">

      <tr>
        <th>LENGTH</th>
        <th>WIDTH</th>
      </tr>
      <tr>
        <td>27"</td>
        <td>17"</td>
      </tr>
      <tr>
        <td>28"</td>
        <td>18"</td>
      </tr>
      <tr>
        <td>29.5"</td>
        <td>20"</td>
      </tr>
      <tr>
        <td>31"</td>
        <td>22"</td>
      </tr>
      <tr>
        <td>32"</td>
        <td>24"</td>
      </tr>
      <tr>
        <td>34"</td>
        <td>26"</td>
      </tr>
      <tr>
    </table>
    
    <div class="image2">
    <img src="picture/icon/image3.png" alt="">
    </div>

    <div class="title2">
      <p>LONGSLEEVES</p>
    </div>

    <ul class="list2">
      <li>S</li>
      <li>M</li>
      <li>L</li>
      <li>XL</li>
      <li>XXL</li>
    </ul>

    <table class="table2">
      <tr>
        <th>LENGTH</th>
        <th>WIDTH</th>
        <th>SLEEVE</th>
      </tr>
      <tr>
        <td>55"</td>
        <td>44"</td>
        <td>44"</td>
      </tr>
      <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
      </tr>
      <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
      </tr>
      <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
      </tr>
      <tr>
        <td>1</td>
        <td>1 2</td>
        <td>R1 3</td>
      </tr>
    </table>

    <div class="image3">
    <img src="picture/icon/image2.png" alt="">
    </div>

    <div class="title3">
    <p>HOODIE</p>
    </div>

    <ul class="list3">
      <li>S</li>
      <li>M</li>
      <li>L</li>
      <li>XL</li>
      <li>XXL</li>
    </ul>
    
    <table class="table3">
      <tr>
        <th>LENGTH</th>
        <th>WIDTH</th>
      </tr>
      <tr>
        <td>27"</td>
        <td>17"</td>
      </tr>
      <tr>
        <td>28"</td>
        <td>18"</td>
      </tr>
      <tr>
        <td>29.5"</td>
        <td>20"</td>
      </tr>
      <tr>
        <td>31"</td>
        <td>22"</td>
      </tr>
      <tr>
        <td>32"</td>
        <td>24"</td>
      </tr>
      
    </table>

  

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
                <a href="https://www.facebook.com/thePrblmChld"><img src="picture/icon/facebook.png" alt="" style="width: 55px; margin-left: 350px;"></a>
                <a href="https://www.instagram.com/problemchild.swc"><img src="picture/icon/instagram.png" alt="" style="width: 43px; margin-left: -5px;"></a>
                <a href="https://twitter.com/problemchildswc"><img src="picture/icon/twitter.png" alt="" style="width: 40px;"></a>
            </ul>
            <p style="font-size: 12px; margin-top: 3%;">&copy; Copyright © Problem Child. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>