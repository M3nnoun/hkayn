<?php
session_start();

// Check if the user is already authenticated
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    // If authenticated, redirect to home.php or any other authenticated page
    header("Location: home.php");
    exit();
} else {
    // If not authenticated, allow access to index.html (assets/index.html)
    if ($_SERVER['REQUEST_URI'] !== '/assets/index.html') {
        // If trying to access a restricted page, redirect to index.html
        header("Location: assets/index.html");
        exit();
    }
}
?>