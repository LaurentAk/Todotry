<?php
session_start();

if ($_POST['otp'] == $_SESSION['otp']) {
    echo "Login successful!";
    unset($_SESSION['otp']);
} else {
    echo "Invalid OTP!";
}
?>
