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
        }
        
        #slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        #slider {
            width: 100%;
            display: flex;
            transition: transform 0.5s;
        }

        .slide {
            min-width: 100%;
        }

        .slide img {
            width: 100%;
            height: auto;
        }

        #prev, #next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        #prev {
            left: 10px;
        }

        #next {
            right: 10px;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .gallery-item {
            margin-top: 100px;
            width: calc(23.40% - 100px); /* Adjust the width as needed */
            cursor: pointer;
        }
        .gallery-item p{
            margin-left: 105px;
            margin-top: 10px;
            text-align: center;
        }

        .image {
            margin-left: 148px;
            width: 150px;
            height: auto;
        }

        .description {
            text-align: center;
            margin-top: 5px;
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
    /*@media only screen and (max-width: 1400px) {
        .logo img{
            width: 100px;
        }
        .text a{
            font-size: 0.7em;
        }
        .nav{
            margin-left: 150px;
        }
        .box:hover input{
            width: 200px;
        }

    .footer-links {
      margin-left: 284px;
    }
    .footer-links .icon img {
     margin-left: 200px;
    }
      .logo2 img{
        margin-left: -37%;
      }
      .gallery-item p{
            margin-left: 105px;
        }
        .image {
            margin-left: 90px;
        }
    } */
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
    

        <div id="slider-container">
            <div id="slider">
                    <div class="slide"><img src="picture/icon/homeimage.png" alt="image1"></div>
                    <div class="slide"><img src="picture/icon/homeimage1.png" alt="image2"></div>
                    <div class="slide"><img src="picture/icon/homeimage2.png" alt="image3"></div>
            </div>
        </div>

        <div id="prev">&lt;</div>
        <div id="next">&gt;</div>

    <script>
        const slider = document.getElementById('slider');
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;

        function goToSlide(slideIndex) {
            if (slideIndex < 0) {
                currentSlide = slides.length - 1;
            } else if (slideIndex >= slides.length) {
                currentSlide = 0;
            } else {
                currentSlide = slideIndex;
            }
            slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() {
            goToSlide(currentSlide + 1);
        }

        function prevSlide() {
            goToSlide(currentSlide - 1);
        }

        document.getElementById('next').addEventListener('click', nextSlide);
        document.getElementById('prev').addEventListener('click', prevSlide);

        // Automatically advance the slider every 3 seconds (adjust as needed)
        setInterval(nextSlide, 3000);
    </script>

    <h1>ALL PRODUCTS</h1>

    <div class="gallery">
        <div class="gallery-item">
            <a href="addtocart1.php"><img class="image" src="picture/all/pic1.png" alt="Image 1"></a>
            <p>Ink Noir</p>
            <p>₱ 350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart2.php"><img class="image" src="picture/all/pic2.png" alt="Image2"></a>
            <p>Chalkboard Chic</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart3.php"><img class="image" src="picture/all/pic3.png" alt="Image 3"></a>
            <p>Classic Contrast</p>
            <p>₱300.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart4.php"><img class="image" src="picture/all/pic4.png" alt="Image 4"></a>
            <p>Navy Chic</p>
            <p>₱300.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart5.php"><img class="image" src="picture/all/pic5.png" alt="Image 5"></a>
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart6.php"><img class="image" src="picture/all/pic6.png" alt="Image 6"></a>
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart7.php"><img class="image" src="picture/all/pic7.png" alt="Image 7"></a>
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart8.php"><img class="image" src="picture/all/pic8.png" alt="Image 8"></a>
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart9.php"><img class="image" src="picture/all/pic9.png" alt="Image 9"></a>
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart10.php"><img class="image" src="picture/all/pic10.png" alt="Image 10" ></a>
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <a href="addtocart.php"><img class="image" src="picture/all/pic11.png" alt="Image 11"></a>
            <p>Example <picture></picture></p>
            <p>₱450.00</p>
        </div>
        <div class="gallery-item">
           <a href="addtocart12.php"><img class="image" src="picture/all/pic12.png" alt="Image 12"></a>
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic13.png" alt="Image 13">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic14.png" alt="Image 14">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic15.png" alt="Image 15">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic16.png" alt="Image 16">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic17.png" alt="Image 17">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic18.png" alt="Image 18">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic19.png" alt="Image 19">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic19.png" alt="Image 20">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic21.png" alt="Image 21">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic22.png" alt="Image 22">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic23.png" alt="Image 23">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic24.png" alt="Image 24">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic24.png" alt="Image 25">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic26.png" alt="Image 26">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic27.png" alt="Image 27">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic28.png" alt="Image 28">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic29.png" alt="Image 29">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>
        <div class="gallery-item">
            <img class="image" src="picture/all/pic29.png" alt="Image 30">
            <p>Misty Figure</p>
            <p>₱350.00</p>
        </div>


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
