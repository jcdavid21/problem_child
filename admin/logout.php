<?php 
    session_start();
    unset($_SESSION["isAdmin"]);
?>

<script>
    window.location.href =  "../logout/logout.php";
</script>