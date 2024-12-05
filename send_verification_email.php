<?php
require 'vendor/autoload.php'; // Include Composer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendVerificationEmail($email, $token)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'grievance.kiit@gmail.com'; // Your SMTP username (email)
        $mail->Password = 'vlbu bmox sghl rhbi'; // Your SMTP password or App Password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('grievance.kiit@gmail.com', 'KIIT Grievance Portal'); // Sender's email and name
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Email Verification';
        $mail->Body    = "Click this link to verify your email: <a href='http://localhost/smartconnectgrievanceportal/verify_email.php?token=$token'>Verify Email</a>";
        $mail->AltBody = "Click this link to verify your email: http://localhost/smartconnectgrievanceportal/verify_email.php?token=$token";

        // Debugging
        $mail->SMTPDebug = 0; // Enable verbose debug output

        // Send the email
        $mail->send();
        return true; // Return true on success
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Output error message
        return false; // Return false on failure
    }
}
