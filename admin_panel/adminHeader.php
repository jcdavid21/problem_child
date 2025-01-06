<?php
   session_start();
   include_once "./config/dbconnect.php";

   // Assuming you have a users table with a column named 'picture_path'
   $userId = $_SESSION['user_id'];
   $query = "SELECT picture_path FROM users WHERE user_id = ?";
   $stmt = mysqli_prepare($conn, $query);

   if ($stmt) {
       mysqli_stmt_bind_param($stmt, "i", $userId);
       mysqli_stmt_execute($stmt);
       mysqli_stmt_bind_result($stmt, $picturePath);

       if (mysqli_stmt_fetch($stmt)) {
           // Use the fetched picture_path to display the profile picture
           $profilePicture = $picturePath ? $picturePath : "./assets/images/logo.png";
       } else {
           // If fetching fails, use a default profile picture
           $profilePicture = "./assets/images/logo.png";
       }

       mysqli_stmt_close($stmt);
   } else {
       // If preparing the statement fails, use a default profile picture
       $profilePicture = "./assets/images/logo.png";
   }
?>
       
<!-- nav -->
<nav class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #3B3131;">
    <a class="navbar-brand ml-5" href="./index.php">
        <img src="<?php echo $profilePicture; ?>" width="80" height="80" style="border-radius: 50%;" alt="Swiss Collection">
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
    <div class="user-cart">  
        <?php           
        if(isset($_SESSION['user_id'])){
          ?>
            <a href="../logout/logout.php" style="text-decoration:none;">
                <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
            </a>
          <?php
        } else {
            echo "<script> alert('Your Not Authorized To Access This Page'); </script>";
            echo "<script> window.location.replace('../index.php'); </script>";
        } ?>
    </div>  
</nav>