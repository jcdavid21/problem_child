<?php 
include('../config/dbcon.php');

    function getAll($table){
        global $conn;

        // Check if the connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM $table";
        $query_run = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($query_run) {
            return $query_run;
        } else {
            die("Query failed: " . mysqli_error($conn));
        }
    }
    function getByID($table, $id){
        global $conn;

        // Check if the connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM $table WHERE id ='$id'";
        $query_run = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($query_run) {
            return $query_run;
        } else {
            die("Query failed: " . mysqli_error($conn));
        }
    }

    function redirect($url, $message){
        echo "<script> alert(' ". $message ."'); </script>";
        echo "<script> window.location.replace('".$url."'); </script>";
    }
?>