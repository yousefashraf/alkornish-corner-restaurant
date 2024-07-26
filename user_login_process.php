<?php
session_start();
require 'DatabaseConnection.php';
require 'User.php';
require 'flash.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

$user = new User($conn);

$username = $_POST['username'];
$password = $_POST['password'];

$loggedInUser = $user->login($username, $password);

if ($loggedInUser) {
    // Login successful
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_id'] = $loggedInUser['id'];
    $_SESSION['username'] = $loggedInUser['username'];
    set_flash_message('success', 'You have successfully logged in.');
    header('Location: user_dashboard.php');
    exit();
} else {
    // Invalid credentials
    set_flash_message('error', 'Invalid username or password.');
    header('Location: user_login.php');
    exit();
}
?>
