<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_otp = $_POST['otp'];

    if ($user_otp == $_SESSION['otp'] && time() <= $_SESSION['otp_expiry']) {
        $user = $_SESSION['user_data'];
        $stmt = $conn->prepare("INSERT INTO enquiries (name, email, password, verified) VALUES (?, ?, ?, 1)");
        $stmt->bind_param("sss", $user['name'], $user['email'], $user['password']);
        $stmt->execute();
        
        echo "Registration successful!";
        unset($_SESSION['otp'], $_SESSION['user_data']);
    } else {
        echo "Invalid or expired OTP.";
    }
}
?>
