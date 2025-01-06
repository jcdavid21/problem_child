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
      .flex-box1{
        border-style: solid;
        border-width: thin;
        border-color: gray;
        width: 1270px;
        height: 700px;
        margin-left: 40px;
        margin-top: 35px;
      }
      
      .my-addresses{
        margin-top: 70px;
        margin-left: 50px;
        font-weight: bold;
        font-size: 20px;
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
      
       
       .popup .overlay{
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1;
        display: none;
      }

      .popup .content{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        background: #fff;
        width: 450px;
        height: 520px;
        z-index: 2;
        padding: 20px;
        box-sizing: border-box;
      }

      .close-btn{
        height: 50px;
        width: 120px;
        background-color: white;
      }

      .close-btn:hover{
        background-color: rgb(180, 178, 178);
        cursor: pointer;
      }

      .submit-btn{
        height: 50px;
        width: 120px;
        background-color: black;
        color: white;
      }

      .submit-btn:hover{
        opacity: 0.8;
        cursor: pointer;
      }

      .popup.active .overlay{
        display: block;
      }
    
    
      .popup.active .content{
        transition: all 300ms ease-in-out;
        transform: translate(-50%,-50%) scale(1);
      }
      .input-box{
        height: 30px;
        width: 400px;
        margin-top: 30px;
      }
      .first-box{
        width: 190px;
        height: 30px;
        margin-right: 10px;
      }
      .second-box{
        width: 190px;
        height: 30px;
      }
      .buttons{
        margin-top: 140px;
        margin-left: 155px;
      }
      .add-new-address{
        margin-left: 800px;
        height: 45px;
        width: 150px;
        background-color: black;
        color: white;
      }
      .add-new-address:hover{
        opacity: 0.8;
        cursor: pointer;
      }

      .new-address{
        margin-top: 20px;
        margin-bottom: 30px;
      }
      

      
      .second-block{
        margin-top: 80px;
        margin-left: 100px;
      }
      .first-block-firstline{
        display: flex;
      }
      .first-block-secondline{
        display: flex;
        margin-top: 13px;
      }
      .second-block-firstline{
        display: flex;
      }
      .second-block-secondline{
        display: flex;
        margin-top: 13px;
      }
      .default-btn{
        background-color: black;
        color: white;
        height: 25px;
        width: 120px;
        margin-left: 510px;
      }
      .default-btn:hover{
        opacity: 0.8;
        cursor: pointer;
      }
      .number{
        margin-left: 20px;
      }
      .edit-btn{
        margin-left: 770px;
        color: blue;
      }
      .edit-btn-2{
        margin-left: 714px;
        color: blue;
      }
      .edit-btn:hover{
        cursor: pointer;
      }
      .edit-btn-2:hover{
        cursor: pointer;
      }
      .delete-btn{
        margin-left: 10px;
        color: blue;
      }
      .delete-btn:hover{
        cursor: pointer;
      }
      
      .first-block{
        border: solid;
        border-top: none;
        border-left: none;
        border-right: none;
        width: 1035px;
        border-color: gray;
      }
      .second-block{
        border: solid;
        border-top: none;
        border-left: none;
        border-right: none;
        width: 1035px;
        border-color: gray;
      }
      .number{
        color: gray;
      }
      .first-block-thirdline{
        margin-bottom: 10px;
      }
      .second-block-thirdline{
        margin-bottom: 10px;
      }
      .third-block-thirdline{
        margin-bottom: 10px;
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
          <a href="#"><i class="fa-regular fa-user"></i></a>
      </div>
      <div class="logout">
          <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
  </div>
</header>

<body>
  

  <div class="flex-container1">
    <div class="container1">
      <img class="profile" src="picture/icon/profile.png" id="profile-pic">
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

  <div class="flex-box1">

        <div class="my-addresses">
          <div>My Addresses<button class="add-new-address" onclick="togglePopup()">Add New Address</button></div>
        </div>

        <div class="popup" id="popup-1">
          <div class="overlay"></div>
          <div class="content">
            <h2 class="new-address">New address</h2>
            <input class="first-box" type="text" placeholder="Full Name">
           <input class="second-box" type="text" placeholder="Phone Number">
           <input class="input-box" type="text" placeholder="Region, Province, City, Barangay">
           <input class="input-box" type="text" placeholder="Postal Code">
           <input class="input-box" type="text" placeholder="Street Name, Building, House No.">
           <div class="buttons">
            <button class="close-btn" onclick="togglePopup()">CANCEL</button>
            <button class="submit-btn">SUBMIT</button>
           </div>
          </div>
        </div>
        

        <script>
          function togglePopup(){
            document.getElementById("popup-1").classList.toggle("active");
          }
        </script>


        <div class="second-block">
            <div class="first-block-firstline">
              <div>Juan Dela Cruz</div>
              <div class="number">743573754947</div>
              <u class="edit-btn">Edit</u>
            </div>
          
          
            <div class="first-block-secondline">
              <div>Quezon City, Metro Manila, Metro Manila, Greater Lagro</div>
              <button class="default-btn">Set as Default</button>
            </div>

            <div>
              <div class="first-block-thirdline">Tatlong Hari Street,Lot 23 Block 16,Caymo Residence,1159</div>
            </div>
        </div>


        <div class="second-block">
          <div class="second-block-firstline">
            <div>Juan Dela Cruz</div>
              <div class="number">743573754947</div>
              <u class="edit-btn-2">Edit</u>
              <u class="delete-btn">Delete</u>
            </div>
          
            <div class="second-block-secondline">
              <div>Quezon City, Metro Manila, Metro Manila, Greater Lagro</div>
              <button class="default-btn">Set as Default</button>
            </div>

            <div>
              <div class="second-block-thirdline">Tatlong Hari Street,Lot 23 Block 16,Caymo Residence,1159</div>
            </div>
        </div>



        <div class="second-block">
          <div class="second-block-firstline">
            <div>Juan Dela Cruz</div>
            <div class="number">743573754947</div>
              <u class="edit-btn-2">Edit</u>
              <u class="delete-btn">Delete</u>
            </div>
          
            <div class="second-block-secondline">
              <div>Quezon City, Metro Manila, Metro Manila, Greater Lagro</div>
              <button class="default-btn">Set as Default</button>
            </div>

            <div>
              <div class="third-block-thirdline">Tatlong Hari Street,Lot 23 Block 16,Caymo Residence,1159</div>
            </div>
        </div>

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