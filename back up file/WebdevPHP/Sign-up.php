<!DOCTYPE html>
<html lang="en">

<head>
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


        body{
            
            font-family: 'Roboto', sans-serif;
        }
        .signup-box{
            width: 360px;
            height: 620px;
            margin: auto;
            border-radius: 3px;
        }
        .signup-box h1{
            text-align: center;
            padding-top: 15px;
        }

        h4{
            text-align: center;
        }

        form{
            width: 300px;
            margin-left: 20px;
        }
        form label{
            display: flex;
            margin-top: 20px;
            font-size: 18px;
        }
        form input{
            width: 100%;
            padding: 7px;
            border: none;
            border: 1px solid gray;
            outline: none;
        }
        input[type="button"]{
            width: 150px;
            height: 40px;
            margin-top: 20px;
            margin-left: 60px;
            border: none;
            background-color: black;
            color: white;
            font-size: 18px;
            border-radius: 0px;
            cursor: pointer;
        }
        p{
            text-align: center;
            padding-top: 20px;
            font-size: 15px;
        }
        .para-2{
            text-align: center;
            color: black;
            font-size: 15px;
        }
        .para-2 a{
            color: blue;
        }

        .input-box{
            background: #fff;
            width: 300px;
            max-width: 500px;
            display: flex;
            align-items: center;
        }
        
        .input-box img{
            width: 35px;
            cursor: pointer;
        }
        .eye-close{
            position: absolute;
            margin-left: 260px;
            height: 25px;
            
        }
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <script>
      function totalClick(click)
      {
        const totalClicks = document.getElementById('totalClicks');
        const sumvalue = parseInt(totalClicks.innerText) + click;
        console.log(sumvalue + sumvalue);
        totalClicks.innerText = sumvalue;

        if(sumvalue < 0)
        {
          totalClicks.innerText = 0;
        }
        else if(sumvalue >9)
        {
          totalClicks.innerText = 9;
        }
      }

    </script>
</head>
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
<body>
    
    <div class="signup-box">
        <h1>SIGN UP</h1>
        <form>
            <label>First name</label>
            <input type="text" placeholder="First name">
            <label>Last name</label>
            <input type="text" placeholder="Last name">
            <label>Email</label>
            <input type="email" placeholder="email@website.com">
            <label>Password</label>


        <div class="input-box">
            <input type="password" placeholder="password" id="password">
            <img class="eye-close"  src="picture/icon/eye-close.png" id="eyeicon">
        </div>
        
        <script>
            let eyeicon = document.getElementById("eyeicon");
            let password = document.getElementById("password");

            eyeicon.onclick = function(){
                if(password.type == "password"){
                    password.type = "text";
                    eyeicon.src = "picture/icon/eye-open.png";
                } else {
                    password.type = "password"; 
                    eyeicon.src = "picture/icon/eye-close.png";
                }
            }
        </script>
            <a href="home.php"><input type="button" value="Sign in"></a>
      
        </form>
        <p>By clicking the Sign Up button, you agree to our <br>
            <a href="terms.php">Terms and Condition</a> and <a href="privacy.php">Policy Privacy</a>
            <p class="para-2">Already have an account? <a href="Login.php">Login here</a></p>

        </p>
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