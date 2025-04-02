<?php
session_start();
require 'connection.php';

// Ensure proper path to PHPMailer files
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Generate OTP and store in session
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['user_data'] = compact('name', 'email', 'password');
    $_SESSION['otp_expiry'] = time() + 300; // OTP valid for 5 minutes

    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'khankooemann@gmail.com'; // Replace with your email
        $mail->Password = 'hfmj sqtn boqc vite';       // Replace with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email Content
        $mail->setFrom('khankooemann@gmail.com', 'ToDo App');
        $mail->addAddress($email);
        $mail->Subject = 'Your OTP for Registration';
        $mail->Body = "Your OTP is: $otp (valid for 5 minutes).";

        // Send the email
        $mail->send();
        header("Location: verify.html");
        exit();
    } catch (Exception $e) {
        echo "Error sending OTP: " . $mail->ErrorInfo;
    }
}
?>
