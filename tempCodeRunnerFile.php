<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PhpMailer/Exception.php';
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';

// Debugging: Print $_POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST); // Debugging - Check if form data is received
    echo "</pre>";

    if (isset($_POST['submit'])) {
        $name = htmlspecialchars($_POST['name']); // Prevent XSS
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
            $mail->addAddress('2101743.cse.cec@cgc.edu.in', 'Portfolio');

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
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Page</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300i,400,400i,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">    
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand">Manisha</a>          
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="Poster.html">Posters</a></li>
                    <li class="nav-item"><a class="nav-link" href="Logo.html">Logo Design</a></li>                              
                    <li class="nav-item"><a class="nav-link" href="Flyer.html">Flyers</a></li>            
                    <li class="nav-item"><a class="nav-link" href="banner.html">Banners</a></li>
                    <li class="nav-item"><a class="nav-link" href="Cards.html">Cards</a></li>
                </ul>
            </div>
        </div>
    </nav>  

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact_form">
                    <h2 class="text-center">Contact Us</h2>
                    <form action="" method="POST" id="main_contact_form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" rows="6" placeholder="Your Message" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery-min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>