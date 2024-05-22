<?php
include 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
// Create an instance of the DatabaseHandler
$database = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

// Assuming you have a session or some form of authentication to get the user's ID
$user1_username = $_POST['user1_username']; // Replace with your actual method of getting the sender's username
$user2_username = $_POST['user2_username']; // Replace with your actual method of getting the recipient's username
$message_text = $_POST['message_text'];

// Get sender and recipient IDs from the database using the DatabaseHandler
$user1_id = $database->getUserIdByUsername($user1_username);
$user2_id = $database->getUserIdByUsername($user2_username);

// Insert the new message into the database
try {
    $query = "INSERT INTO messages (sender_id, receiver_id, message_text, timestamp) VALUES (?, ?, ?, NOW())";
    $params = [$user1_id, $user2_id, $message_text];
    $database->executeQuery($query, $params);
    // Send a success response
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    // Handle the error
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
