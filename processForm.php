<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(array("success" => false, "message" => "Please fill in all the fields."));
        exit;
    }

    // Further validation (e.g., validate email format)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("success" => false, "message" => "Invalid email format."));
        exit;
    }

    // Set up PHPMailer
    $mail = new PHPMailer(true); // Pass `true` to enable exceptions

    // Set up SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Update with your SMTP server details
    $mail->Port = 587; // or $mail->Port = 465;
    // Uncomment the following lines if authentication is required
     $mail->SMTPAuth = true;
     $mail->Username = 'sifatsakib26@gmail.com';
     $mail->Password = 'abqekuzajszwichx';

    // Set recipient email address
    $mail->addAddress('sifatsakib26@gmail.com');

    // Set email subject
    $mail->Subject = 'New Contact Form Submission from ' . $name;

    // Set email body
    $mail->Body = "Name: $name\nEmail: $email\nMessage:\n$message";

    try {
        // Attempt to send the email
        $mail->send();
        echo json_encode(array("success" => true, "message" => "Email sent successfully."));
    } catch (Exception $e) {
        echo json_encode(array("success" => false, "message" => "Failed to send email. Error: {$mail->ErrorInfo}"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request."));
}
?>