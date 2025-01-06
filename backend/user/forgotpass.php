<?php 
    session_start();
    require_once '../../config/dbcon.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "../../PHPMailer/src/Exception.php";
    require "../../PHPMailer/src/PHPMailer.php";
    require "../../PHPMailer/src/SMTP.php";

    if(isset($_POST["email"])) {
        $email = $_POST["email"];
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if($result->num_rows > 0) {
            $six_digit_random_number = mt_rand(100000, 999999);
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'deepdiveest24@gmail.com';
            $mail->Password = "qupw ciaf rspp xodm";
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('deepdiveest24@gmail.com');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Verication Code";
            $mail->Body = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Message</title>
                </head>
                <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>
                    <div style='max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);'>
                        <h1 style='color: #333333; font-size: 24px; text-align: center;'>Code</h1>
                        <p style='color: #555555; font-size: 16px; line-height: 1.5;'>
                            Your verification code is <strong>$six_digit_random_number</strong>
                        </p>
                        <div style='margin-top: 20px; text-align: center; font-size: 12px; color: #999999;'>
                            <p>&copy; 2024 ProblemChild. All Rights Reserved.</p>
                        </div>
                    </div>
                </body>
</html>
";


            if ($mail->send()) {
                echo json_encode(["status" => "success", "message" => "Email sent", "digitCode" => $six_digit_random_number]);
            } else {
                echo 'Error: ' . $mail->ErrorInfo;
            }

            exit();
        }else{
            echo "Email not found";
        }
    }
    else {
        echo "Email is required";
    }
?>