<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';

// Check if REQUEST_METHOD is set before using it
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST); // Debugging - Check if form data is received
    echo "</pre>";

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            die("All fields are required!");
        }

        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'omprakashraj100078@gmail.com'; // Corrected
            $mail->Password   = 'flvs krld izwy rics'; // Use Google App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Sender & Recipient
            $mail->setFrom('omprakashraj100078@gmail.com', 'Contact Form');
            $mail->addAddress('elitehouse2002@gmail.com', 'Portfolio');

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "
                <strong>Sender Name:</strong> $name <br>
                <strong>Sender Email:</strong> $email <br>
                <strong>Subject:</strong> $subject <br>
                <strong>Message:</strong> $message <br>
            ";

            $mail->send();
            echo '<script>alert("Message sent successfully!"); window.location.href="contact.html";</script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        die("Submit button not clicked properly!");
    }
} else {
    die("Form must be submitted via a web browser!");
}
?>
