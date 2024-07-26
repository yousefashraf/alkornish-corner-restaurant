<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function set_flash_message($key, $message) {
    $_SESSION['flash_messages'][$key] = $message;
}

function get_flash_message($key) {
    if (isset($_SESSION['flash_messages'][$key])) {
        $message = $_SESSION['flash_messages'][$key];
        unset($_SESSION['flash_messages'][$key]);
        return $message;
    }
    return null;
}
?>
