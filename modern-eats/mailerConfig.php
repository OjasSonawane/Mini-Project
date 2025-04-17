<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // PHPMailer path

function sendOTP($email, $otp) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pratikanpat89@gmail.com';   // Replace with your email
        $mail->Password   = 'yivo iivh qdhv ksbq';      // App-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('your_email@gmail.com', 'ModernEats');
        $mail->addAddress($email); // Recipient's email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for ModernEats Registration';
        $mail->Body    = "<h3>Your OTP is: <strong>$otp</strong></h3>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
