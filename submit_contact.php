<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate and sanitize inputs
    $name = htmlspecialchars(trim($name));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($message));

    // Prepare the email
    $to = 'yousef.uwk@gmail.com'; // Replace with your email address
    $subject = 'ركن الكورنيش - تواصل معنا';
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        $_SESSION['flash_message'] = 'Your message was sent successfully!';
    } else {
        $_SESSION['flash_message'] = 'Failed to send your message. Please try again later.';
    }

    // Redirect back to the contact page
    header('Location: contact.php');
    exit();
} else {
    // If accessed directly, redirect to the contact page
    header('Location: contact.php');
    exit();
}
