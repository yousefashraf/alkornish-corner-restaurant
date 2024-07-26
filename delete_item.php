<?php
require 'flash.php';
include 'DatabaseConnection.php';
include 'Menu.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->getConnection();

$menu = new Menu($conn);

// Get the item ID from the URL
$itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle deletion
if ($itemId > 0) {
    $menu->deleteMenuItem($itemId);
    $_SESSION['flash_message'] = 'Item deleted successfully!';
} else {
    $_SESSION['flash_message'] = 'Invalid item ID.';
}

// Redirect to the add item page
header('Location: user_dashboard.php');
exit();
?>
