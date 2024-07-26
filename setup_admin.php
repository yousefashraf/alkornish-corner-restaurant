<?php
require 'DatabaseConnection.php';
require 'User.php';

// Check if the script has been executed before
if (file_exists('admin_setup.lock')) {
    die('Admin user has already been set up.');
}

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin user details
$adminUsername = 'admin';
$adminPassword = 'adminpassword'; // You should hash this password before saving it
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

// Insert the admin user into the database
$sql = "INSERT INTO admin_users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Preparation failed: " . $conn->error);
}

$stmt->bind_param("ss", $adminUsername, $hashedPassword);

if ($stmt->execute()) {
    echo "Admin user has been created successfully.";
    // Create a lock file to prevent this script from running again
    file_put_contents('admin_setup.lock', '');
} else {
    echo "Execution failed: " . $stmt->error;
}

$stmt->close();
$dbConnection->closeConnection();
?>
