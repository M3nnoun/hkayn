<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the specified page
    header('Location: ./assets/index.html');
    exit();
}
// /opt/lampp/htdocs/Lp-SID/hkayn/assets/index.html

?>
