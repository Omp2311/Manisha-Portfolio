<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'] ;
    $email = $_POST['email'] ;
    $subject = $_POST['subject'] ;
    $message = $_POST['message'] ;
} else {
    die("Form not submitted properly!");
}


require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'omprakashraj100078@gmail.com';
    $mail->Password   = 'flvs krld izwy rics'; // Use Google App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('2101743.cse.cec@cgc.edu.in', 'Contact form');
    $mail->addAddress('omprakashraj100078@gmail.com', 'Portfolio');

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = "Sender Name: $name <br> Sender Email: $email <br> Subject: $subject <br> Message: $message <br>";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
