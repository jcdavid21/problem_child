<?php 

    include('config.php');

    if(isset($_POST["submit"])){
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $gender = $_POST["gender"];
        $contactnumber = $_POST["contactnumber"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
        if(mysqli_num_rows($duplicate) > 0){
            echo "<script> alert('Username or Email Has Already Taken'); </script>";
        }
        else{
            if($password == $confirmpassword){
                $query = "INSERT INTO tb_user VALUES('','$firstname','$lastname','$username','$gender','$contactnumber','$address','$email','$password')";
                mysqli_query($conn,$query);
                echo "<script> alert('Registration Successful'); </script>";
            }
            else{
                echo "<script> alert('Password Does Not Match'); </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <!-- Internal CSS -->
    <style>
        body{
            background: #F6F5F0;
            width: 100%;
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container{
            width: 360px;
            height: 950px;
            margin: auto;
            background: #FAE9D7;
            border-radius: 7px;
        }

        h1{
            text-align: center;
        }

        h4{
            text-align: center;
            padding-top: 15px;
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
            border-radius: 6px;
            outline: none;
        }

        input[type="submit"]{
            width: 320px;
            height: 35px;
            margin-top: 20px;
            border: none;
            background-color: black;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        input[type="submit"]:hover{
            color: white;
            background: #CFB292;
        }

        p{
            text-align: center;
            padding-top: 20px;
            font-size: 15px;
        }
    </style>

</head>
<body>
    <div class="container">
        <h1>REGISTER</h1>
        <h4>It's Free and only takes a minute</h4>
        <form class="" action="" method="post" autocomplete="off">
            <label>First Name</label>
            <input type="text" name="firstname" id="firstname" placeholder="First Name" required value="">
            <label>Last Name</label>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required value="">
            <label>Username</label>
            <input type="text" name="username" id="Username" placeholder="Username" required value="">
            <label>Gender</label>
            <input type="text" name="gender" id="gender" placeholder="Gender" required value="">
            <label>Contact Number</label>
            <input type="tel" name="contactnumber" id="contactnumber" placeholder="Contact Number" required value="">
            <label>Address</label>
            <input type="text" name="address" id="address" placeholder="Address" required value="">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="email@website.com" required value="">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required value="">
            <label>Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required value="">
            <input type="submit" name="" value="Submit">
        </form>
        <p>By clicking the Sign Up button, you agree to our<br>
        <a href="#">Terms and Condition</a> and <a href="#">Policy Privacy</a></p>
        <p>Already have an account? <a href="Login.php">Login Here</a></p>
    </div>
</body>
</html>