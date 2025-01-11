<?php
session_start();
include('../config/dbcon.php');
include('myfunctons.php');

if (isset($_POST['signup-submit'])) {
    // Validate inputs
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $term_con = isset($_POST['term_con']) ? mysqli_real_escape_string($conn, $_POST['term_con']) : '';

    if (empty($term_con)) {
        redirect("../login/login.php", "Please agree to the terms and conditions");
        exit();
    }


    // Validate inputs
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
       redirect("../login/login.php", "All fields are required");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect("../login/login.php", "Invalid email");
    } elseif (strlen($password) < 6) {
        redirect("../login/login.php", "Password must be at least 6 characters long");
    } elseif ($password != $confirm_password) {
        redirect("../login/login.php", "Passwords do not match");
    } else {
        // Use prepared statements
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            redirect("../login/login.php", "Email has already been taken");
        } else {
            // Hash the password
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

            // Use prepared statements
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashedpassword);

            if ($stmt->execute()) {
                redirect("../login/login.php", "Registration successful");
            } else {
                redirect("../login/login.php", "Registration failed");
            }
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}else if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Modify the query to check both username and email
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {
        if (password_verify($password, $row["password"])) {

            if($row["status_id"] == 0){
                redirect("../login/login.php", "Account is deactivated");
                exit;
            }


            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION['isAdmin'] = $row['isAdmin']; 
            $_SESSION['auth'] = true;

            if ($_SESSION['isAdmin'] == 1) {
                date_default_timezone_set("Asia/Manila");
                $date = date('Y-m-d H:i:s');
                $query2 = "INSERT INTO tbl_audit_log(log_user_id, log_username, log_user_type, log_date) VALUES(?, ?, ?, ?)";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bind_param("isss", $row['user_id'], $row['first_name'], $row['isAdmin'], $date);
                $stmt2->execute();

                redirect("../admin/index.php", "Login Successful");
                exit;
            }

            header("Location: ../index.php");
            exit;
        } else {
            redirect("../login/login.php", "Wrong Password");
        }
    } else {
        redirect("../login/login.php", "Email Not Registered");
    }
}

?>