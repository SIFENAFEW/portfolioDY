<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Only process the form if it's submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input fields to prevent XSS
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        die("Please fill in all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please provide a valid email address.");
    }

    // Email details
    $to = "sifenafework1@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $emailBody = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Attempt to send email
    if (@mail($to, $subject, $emailBody, $headers)) {
        echo "Thank you, $name! Your message has been sent.";
    } else {
        echo "Sorry, there was an issue sending your message.";
    }
} else {
    // If accessed without form submission, redirect to the form page
    header("Location: contactUs.html");
    exit();
}
?>
