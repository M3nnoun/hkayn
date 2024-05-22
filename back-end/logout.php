<?php
session_start();

// Destroy the session
session_destroy();

// Respond with a success message or any necessary data
echo json_encode(['status' => 'success', 'message' => 'Logout successful']);
?>
