<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "info@phasenetinnovations.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $body = "<h2>Contact Form Submission</h2>
             <p><strong>First Name:</strong> {$first_name}</p>
             <p><strong>Last Name:</strong> {$last_name}</p>
             <p><strong>Email:</strong> {$email}</p>
             <p><strong>Message:</strong><br>{$message}</p>";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Thank you for contacting us. We will get back to you soon.'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Message sending failed. Please try again later.'); window.location.href = 'contact.html';</script>";
    }
}
?>
