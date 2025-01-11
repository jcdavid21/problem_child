<!-- c:/xampp/htdocs/project_revise/indextest.html -->
<?php
session_start();
include('../config/dbcon.php');

// Check if the user is already logged in
if (empty($_SESSION["login"])) {
    echo "<script>alert('Please log in first.');</script>";
    echo "<script>window.location.href='../login/login.php';</script>";
    exit;
}

// Function to create the "uploads" directory if it doesn't exist
function createUploadsDirectory()
{
    $uploadsDir = __DIR__ . '/../uploads';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0755, true);
    }
}

// Call the function to create the "uploads" directory
createUploadsDirectory();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Sanitize and retrieve user data from the form
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $contact_no = mysqli_real_escape_string($conn, $_POST["contact_no"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST["date_of_birth"]);

    // Update user data in the database using prepared statement
    $updateQuery = "UPDATE users SET first_name=?, last_name=?, email=?, contact_no=?, gender=?, date_of_birth=? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssssssi", $first_name, $last_name, $email, $contact_no, $gender, $date_of_birth, $_SESSION['user_id']);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Profile updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
    }

    // Handle profile picture upload
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK) {
        // Validate file type and move the uploaded file
        $targetDir = __DIR__ . '/../uploads/';
        $uniqueFilename = uniqid() . "_" . $_FILES["profile_picture"]["name"]; // Generate a unique filename
        $targetFile = $targetDir . $uniqueFilename;

        $allowedTypes = array('jpg', 'jpeg', 'png');
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                // Update the profile picture path in the database
                $relativePath = '../uploads/' . $uniqueFilename; // Add relative path
                $updatePictureQuery = "UPDATE users SET picture_path=? WHERE user_id = ?";
                $stmt = mysqli_prepare($conn, $updatePictureQuery);
                mysqli_stmt_bind_param($stmt, "si", $relativePath, $_SESSION['user_id']);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Profile and picture updated successfully.');</script>";
                } else {
                    echo "<script>alert('Error updating profile picture: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                echo "<script>alert('Error moving uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type.');</script>";
        }
    } elseif (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] != UPLOAD_ERR_NO_FILE) {
        echo "<script>alert('Error during file upload: " . $_FILES['profile_picture']['error'] . "');</script>";
    }
}

// Retrieve user data from the database
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '{$_SESSION['user_id']}'");
$userData = mysqli_fetch_assoc($result);

// Check if user data is found
if (!$userData) {
    echo "<script>alert('User not found.');</script>";
    exit(header("Location: signin.php"));
}

// Use the retrieved data to pre-fill the input fields
$profilePicPath = !empty($userData["picture_path"]) ? $userData["picture_path"] : "../images/icon/profile.png";
$first_name = $userData["first_name"];
$last_name = $userData["last_name"];
$email = $userData["email"];
$contact_no = $userData["contact_no"];
$gender = $userData["gender"];
$date_of_birth = $userData["date_of_birth"];

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
        body{
            min-height: 100vh;
            width: 100%;
            background: #F6F5F0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }



        
        /* CSS FOR BODY */
        .profile-container{
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 0 40px;
        }
        .profile-box{
            display: inline-block;
            width: 25%;
            height: auto;
        }
        .profile-box1{
            width: 70%;
            height: auto;
        }
        .profile-pic-container {
            display: flex;
            flex-direction: row;
        }

        .profile-pic-container #profile-pic {
            width: 100px;
            height: 100px;  
            border-radius: 50%; 
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 150px;
            display: flex;  
        }
        .profile-pic-container p{
            font-size: 17px;
            font-weight: 500;
            color: #ccc;
        }
        #profile-pic-input{
            margin-top: 10px;
            margin-bottom: 20px;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-left: 150px;
        }
        .edit-container {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
            margin-left: 10px;
        }
        #profile-pic-input-label{
            margin-top: 5px;
        }
        #profile-pic-input-label:hover{
            color: #bbbbbb;
        }
        .myaccount {
            width: 300px;
            height: 200px;
            padding: 20px;
            border-radius: 10px;
            margin-left: 25px;
        }

        .change-password a p, .addresses a p, .profile a p{
            font-size: 15px;
            margin-left: 50px;
            margin-top: 5px;
            color: #000000;
            cursor: pointer;
        }
        .change-password a p:hover{
            color: #EBC8A4;
        }
        .addresses a p:hover{
            color: #EBC8A4;
        }
        .profile a p:hover{
            color: #EBC8A4;
        }
        

        .flex-box{
            border-style: solid;
            border-width: thin;
            border-color: gray;
            width: 100%;
            height: auto;

        }
        .form-container{
            width: 100%;
            height: auto;
            display: flex;
            flex-direction: column;
            margin-top: 50px;
        }
        .form-container .details-input{
            margin-left: 150px;
        }
        .last_name{
            margin-top: 50px;
        }
        .input-last_name{
            margin-left: 30px;
            margin-top: 45px;
            width: 400px;
            height: 35px;
        }
        
        .input-name{
            margin-left: 31px;
            margin-top: 20px;
            width: 400px;
            height: 35px;
        }
        

        .input-email{
            margin-left: 68px;
            margin-top: 20px;
            width: 400px;
            height: 35px;
        }
        .phone-no{
            margin-top: 15px;
        }
        .input-phone-no{
            width: 400px;
            height: 35px;
            margin-top: 20px;
        }
        .input-date{
            width: 400px;
            height: 35px;
            margin-top: 20px;
            margin-left: 25px;
        }
        .save{
            color: white;
            background-color: black;
            height: 50px;
            width: 130px;
            margin-top: 40px;
            margin-bottom: 30px;
        }
        .save:hover{
            opacity: 0.8;
            cursor: pointer;
        }


        .gender-details{
            margin-top: 20px;
        }
        form .gender-details .gender-title{
            font-size: 20px;
            font-weight: 500;
        }
        form .category{
            display: flex;
            width: 43%;
            margin: 14px 0 ;
            justify-content: space-between;
        }
        form .category label{
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        form .category label .dot{
            height: 18px;
            width: 18px;
            border-radius: 50%;
            margin-right: 10px;
            background: #d9d9d9;
            border: 5px solid transparent;
            transition: all 0.3s ease;
        }
        #dot-1:checked ~ .category label .one,
        #dot-2:checked ~ .category label .two,
        #dot-3:checked ~ .category label .three{
            background: #000000;
            border-color: #d9d9d9;
        }
        form input[type="radio"]{
            display: none;
        }
        .profile-text{
            font-weight: bold;
            font-size: 20px;
            margin-left: 20px;
        }
        .profile-text1{
            margin-left: 20px;
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

        @media (max-width: 1000px) {
            .profile-container{
                flex-direction: column;
                gap: 0;
            }

            .myaccount{
                height: max-content;
                display: flex;
                align-items: center;
                gap: 50px;
                justify-content: space-between;
            }

            .myaccount h3{
                display: none;
            }
            
            .profile-box1{
                width: 100%;
            }

            .details-input{
                display: flex;
                flex-direction: column;
                gap: 6px;
            }

            .details-input input{
                margin: 0;
                width: 100%;
                margin-bottom: 40px;
            }

            .profile-box1 .flex-box .form-container{
                padding: 40px;
            }

            .form-container .details-input, .form-container .profile-pic-container{
                margin-left: 0;
            }
            
            .profile-pic-container #profile-pic{
                margin-left: 0;
            }
            
        }

        .change-password a p, .addresses a p, .profile a p{
            margin-left: 0;
            width: 100%;
        }
    </style>
    <script src="https://kit.fontawesome.com/e8e1132798.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="../styles/navbar.css">
</head>
    <!-- NAVIGATION BAR -->
    <?php include_once "../components/nav.php" ?>


    <!-- BODY -->
    <div class="profile-container">
        <div class="profile-box">
            <div class="myaccount">
                <h3><i class="fa-regular fa-user" style="margin-right: 10px;"></i>My Account</h3>
                <section class="profile">
                    <a href="profile.php"><p>Profile</p></a>
                    <!-- Add your profile information here -->
                </section>
                <section class="addresses">
                    <a href="../address/address.php"><p>Addresses</p></a>
                    <!-- Add your addresses here -->
                </section>
                <section class="change-password">
                    <a href="../changepassword/changepassword.php"><p>Change Password</p></a>
                    <!-- Add your change password form here -->
                </section>
            </div>
        </div>
        <div class="profile-box1">
            <div class="flex-box">
                <div class="form-container">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="profile-text">My Profile</div>
                        <div class="profile-text1">Manage and protect your account</div>
                        <div class="profile-pic-container">
                            <img id="profile-pic" src="<?php echo $profilePicPath; ?>" alt="Profile Picture">
                            <!-- Move the edit-container inside profile-pic-container -->
                            <div class="edit-container">
                                <h3 id="name"><?php echo $first_name . " " . $last_name; ?></h3>
                                <label for="profile-pic-input" id="profile-pic-input-label">
                                    <i class="fa-regular fa-pen-to-square"></i>Edit profile
                                </label>
                                <input type="file" id="profile-pic-input" accept="image/jpeg, image/png, image/jpg" name="profile_picture" style="display: none;">
                            </div>
                        </div>
                        <div class="details-input">
                            <label for="first_name" class="last_name">First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="input-last_name" value="<?php echo $first_name; ?>">
                        </div>
                        <div class="details-input">
                            <label for="last_name" class="Name">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" class="input-name" value="<?php echo $last_name; ?>" req>
                        </div>
                        <div class="details-input">
                            <label for="email" class="email">Email:</label>
                            <input type="email" name="email" id="email" class="input-email" value="<?php echo $email; ?>">
                        </div>
                        <div class="details-input">
                            <label for="contact_no" class="phone-no">Phone Number:</label>
                            <input type="tel" name="contact_no" id="contact_no" class="input-phone-no" value="<?php echo $contact_no; ?>" maxlength="11"> 
                        </div>
                        <div class="details-input">
                            <div class="gender-details">
                                <input type="radio" name="gender" id="dot-1" require value="male" <?php echo ($gender === 'male') ? 'checked' : ''; ?>>
                                <input type="radio" name="gender" id="dot-2" require value="female" <?php echo ($gender === 'female') ? 'checked' : ''; ?>>
                                <input type="radio" name="gender" id="dot-3" require value="prefer_not_to_say" <?php echo ($gender === 'prefer_not_to_say') ? 'checked' : ''; ?>>
                                <span class="gender-title">Gender:</span>
                                <div class="category">
                                    <label for="dot-1">
                                        <span class="dot one"></span>
                                        <span class="gender">Male</span>
                                    </label>
                                    <label for="dot-2">
                                        <span class="dot two"></span>
                                        <span class="gender">Female</span>
                                    </label>
                                    <label for="dot-3">
                                        <span class="dot three"></span>
                                        <span class="gender">Other</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="details-input">
                            <label for="date_of_birth"><span>Date of Birth:</span><input type="date" name="date_of_birth" class="input-date" id="date_of_birth" required value="<?php echo $date_of_birth; ?>"></label>
                        </div>
                        <div class="details-input">
                            <button type="submit" name="submit" class="save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT FOR BODY -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the profile picture input and the profile picture element
            const profilePicInput = document.getElementById('profile-pic-input');
            const profilePic = document.getElementById('profile-pic');

            // Add an event listener to the input for changes
            profilePicInput.addEventListener('change', function (event) {
                // Check if a file is selected
                if (event.target.files && event.target.files[0]) {
                    // Read the selected file
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Set the source of the profile picture element to the selected image
                        profilePic.src = e.target.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        });
    </script>


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
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
</body>
</html>