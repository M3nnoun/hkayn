<?php
include 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');

// Get usernames from the request or any source
$user1_username = $_GET['user1_username'] ?? '';
$user2_username = $_GET['user2_username'] ?? '';

// Create a DatabaseHandler instance
$dbHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

// Get user IDs
$user1_id = $dbHandler->getUserIdByUsername($user1_username);
$user2_id = $dbHandler->getUserIdByUsername($user2_username);

if ($user1_id === null || $user2_id === null) {
    // Handle cases where one or both users don't exist
    echo json_encode(['error' => 'One or more users not found']);
    exit;
}

// SQL query to get messages between the two users
$query = "SELECT `message_id`, `sender_id`, `receiver_id`, `message_text`, `timestamp`
          FROM `messages`
          WHERE (sender_id = :user1_id AND receiver_id = :user2_id)
             OR (sender_id = :user2_id AND receiver_id = :user1_id)
          ORDER BY `timestamp`";

$params = [
    ':user1_id' => $user1_id,
    ':user2_id' => $user2_id,
];

// Execute the query
$stmt = $dbHandler->executeQuery($query, $params);

// Fetch all messages
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return messages as JSON
echo json_encode(['messages' => $messages,'currentUserId'=>$user1_id]);
