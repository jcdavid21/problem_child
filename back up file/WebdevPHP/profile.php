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




    .profile{
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-top: 50px;
      margin-left: 150px;
    }

    .flex-container1
      {
        display: flex;
      }

      .flex-container2
      {
        display: flex;
      }
      .flex-container3{
        display: flex;
        margin-left: 410px;
      }
      .flex-container4{
        display: flex;
        margin-top: 30px;
        margin-left: 375px;
      }
      .edit-profile{
        cursor: pointer;
      }
      .edit-profile:hover{
        opacity: 0.4  ;
      }
      .none{
        display: none;
      }
      .container2{
        display: flex;
        margin-top: 70px;
        margin-left: 20px;
      }
      .container3{
        margin-top: 50px;
        margin-left: 100px;
      }
      .flex-box{
        border-style: solid;
        border-width: thin;
        border-color: gray;
        width: 1270px;
        height: 700px;
        margin-left: 40px;
        margin-top: 35px;
      }
      
      .my-profile{
        margin-top: 70px;
        margin-left: 50px;
        font-weight: bold;
      }
      .manage{
        margin-top: 10px;
        margin-left: 50px;
        font-size: 14px;
      }
      .profile_{
        margin-top: 10px;
        margin-left: 50px;
      }
      .addresses{
        margin-top: 10px;
        margin-left: 50px;
      }
      .change-pass{
        margin-top: 10px;
        margin-left: 10px;
      }
      .username{
        margin-top: 50px;
        margin-left: 400px;
        margin-right: 10px;
      }
      .input-username{
        margin-top: 45px;
        width: 400px;
        height: 35px;
      }
      .changed-once{
        margin-top: 4px;
        color: gray;
        font-size: 14px;
        margin-left: 520px;
      }
      .Name{
        margin-top: 15px;
        margin-left: 416px;
      }
      .input-name{
        margin-top: 10px;
        margin-left: 25px;
        width: 400px;
        height: 35px;
      }
      .email{
        margin-left: 417px;
        margin-right: 16px;
      }
      .input-email{
        margin-top: 15px;
        margin-left: 10px;
        width: 400px;
        height: 35px;
      }
      .phone-no{
        margin-top: 15px;
        margin-left: 355px;
        margin-right: 23px;
      }
      .input-phone-no{
        width: 400px;
        height: 35px;
        margin-top: 25px;
      }
      .gender-button{
        height: 20px;
        width: 20px;
        margin-top: 40px;
        margin-left: 21px;
        margin-right: 5px;
      }
      select{
      width: 100px;
      height: 40px;
      text-align: center;
      margin-left: 15px;
     }
     select:hover{
      cursor: pointer;
     }
      .DateOfBirth{
      margin-right: 5px;
     }
     .save{
      color: white;
      background-color: black;
      height: 50px;
      width: 130px;
      margin-top: 40px;
      margin-left: 490px;
     }
     .save:hover{
      opacity: 0.8;
      cursor: pointer;
     }
     .account p{
        color: #000000;
      }
  </style>
  <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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
  

  <div class="flex-container1">
    <div class="container1">
      <img class="profile" src="picture/icon/profile.png" id="profile-pic" style="margin-left: -15;">
      <div class="container3">
        <div class="account"><h4>My Account</h4>
          <a href="profile.php" style="text-decoration: none;"><div class="profile_" style="margin-left: 40px;"><p>Profile</p></div></a>
          <a href="address.php" style="text-decoration: none;"><div class="addresses" style="margin-left: 40px;"><p>Addresses</p></div></a>
          <a href="change-password.php" style="text-decoration: none;"><div class="change-pass" style="margin-left: 40px;"><p>Change Password</p></div></a>
        </div>
      </div>
    </div>

    <div class="container2">
      <div>
        <div style="margin-left: -25px;">asd</div>
        <label class="edit-profile" for="input-file" style="margin-left: -25px;">Edit Profile</label>
        <input class="none" type="file" accept="image/jpeg, image/png, image/jpg" id="input-file">
      </div>
      
    </div>
    <div class="flex-box">
      <div class="my-profile">My Profile</div>
      <div class="manage">Manage and protect your account</div>
      <label class="username">Username</label>
      <input class="input-username" type="text" placeholder="">
      <div class="changed-once">Username can only be changed once</div>
      <label class="Name">Name</label>
      <input class="input-name" type="text">
<div>
  <label class="email">Email</label>
  <input class="input-email" type="text">
</div>
<div>
  <label class="phone-no">Phone Number</label>
  <input class="input-phone-no" type="text">
</div>

<div class="flex-container3">
  <div>
    <label>Gender</label>
    <input class="gender-button" type="radio">
    <label class="male">Male</label>
    <input class="gender-button" type="radio">
    <label >Female</label>
    <input class="gender-button" type="radio">
    <label >Other</label>
  </div>
</div>

<div class="flex-container4">
  <div>
    <label class="DateOfBirth">Date of Birth</label>
    <select>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
      <option>13</option>
      <option>14</option>
      <option>15</option>
      <option>16</option>
      <option>17</option>
      <option>18</option>
      <option>19</option>
      <option>20</option>
      <option>21</option>
      <option>21</option>
      <option>22</option>
      <option>23</option>
      <option>24</option>
      <option>25</option>
      <option>26</option>
      <option>27</option>
      <option>28</option>
      <option>29</option>
      <option>30</option>
      <option>31</option>
    </select>
    <select>
      <option>January</option>
      <option>February</option>
      <option>March</option>
      <option>April</option>
      <option>May</option>
      <option>June</option>
      <option>July</option>
      <option>August</option>
      <option>September</option>
      <option>October</option>
      <option>November</option>
      <option>December</option>
    </select>
    

    <select>
      <option>1990</option>
      <option>1991</option>
      <option>1992</option>
      <option>1993</option>
      <option>1994</option>
      <option>1995</option>
      <option>1996</option>
      <option>1997</option>
      <option>1998</option>
      <option>1999</option>
      <option>2000</option>
      <option>2001</option>
      <option>2002</option>
      <option>2003</option>
      <option>2004</option>
      <option>2005</option>
      <option>2006</option>
      <option>2007</option>
      <option>2008</option>
      <option>2009</option>
      <option>2010</option>
      <option>2011</option>
      <option>2012</option>
      <option>2013</option>
      <option>2014</option>
      <option>2015</option>
      <option>2016</option>
      <option>2017</option>
      <option>2018</option>
      <option>2019</option>
      <option>2020</option>
      <option>2021</option>
      <option>2022</option>
      <option>2023</option>
      
    </select>
  </div>
</div>
<button class="save">Save</button>
    </div>
</div>
    <script>

      let profilePic = document.getElementById("profile-pic");
      let inputFile = document.getElementById("input-file");
  
      inputFile.onchange = function(){
        profilePic.src = URL.createObjectURL(inputFile.files[0]);
      }
  
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