<?php 

session_start();
require_once '../../config/dbcon.php';

if(isset($_POST["cart_id"]) && isset($_POST["comment"]))
{
    $user_id = $_SESSION["user_id"];
    $cart_id = $_POST["cart_id"];
    $comment = $_POST["comment"];
    $date = date("Y-m-d");
    $variation_id = $_POST["variation_id"];

    $query = "INSERT INTO tbl_feedback (product_id, fd_comment, fd_date, user_id, variation_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issii", $cart_id, $comment, $date, $user_id, $variation_id);
    $stmt->execute();

    if($stmt->affected_rows > 0)
    {
        echo "success";
    }
    else
    {
        echo "error";
    }

}
?>