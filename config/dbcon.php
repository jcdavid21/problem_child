<?php

$serverhost = "localhost";
$servername = "root";
$password = "";
$dbname = "problemchild_db";

$conn = mysqli_connect($serverhost, $servername, $password, $dbname);

//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>