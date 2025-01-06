<?php 
require '../config/dbcon.php';
$_SESSION = [];
session_start();
session_unset();
session_destroy();
header("Location: ../login/login.php");
