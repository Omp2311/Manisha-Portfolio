<?php
if (isset($_POST["submit"])) {
    // Sanitize and validate input
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    
    $to = 'omprakashraj100078@gmail.com'; 
    $body = "From: $name\n E-Mail: $email\n Subject: $subject\n Message:\n $message";
    
    // Set headers
    $headers = "From: Om Contact Form <omprakashraj@gmail.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $body, $headers)) {
        header("Location: thank-you.html");
        exit();
    } else {
        echo "Error: Email sending failed.";
    }
} else {
    echo "Form not submitted.";
}
?>
