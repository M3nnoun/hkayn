<?php
session_start();
require_once 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
$databaseHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

// Get user ID by username
$currentUserName = $_SESSION['username'];
$currentUserId = $databaseHandler->getUserIdByUsername($currentUserName);

$query = "
    SELECT
        users.id AS user_id,
        users.username AS friend_username,
        CONCAT(users.first_name, ' ', users.last_name) AS full_name,
        users.profile_image,
        MAX(messages.timestamp) AS last_message_timestamp,
        messages.message_text AS last_message
    FROM
        friends
    INNER JOIN
        users ON friends.user1_id = users.id OR friends.user2_id = users.id
    LEFT JOIN
        messages ON
        (friends.user1_id = messages.sender_id AND friends.user2_id = messages.receiver_id)
        OR
        (friends.user2_id = messages.sender_id AND friends.user1_id = messages.receiver_id)
    WHERE
        (friends.user1_id = :currentUserId OR friends.user2_id = :currentUserId)
        AND users.id != :currentUserId
    GROUP BY
        users.id
    ORDER BY
        MAX(messages.timestamp) DESC
";
$params = [':currentUserId' => $currentUserId];
$stmt = $databaseHandler->executeQuery($query, $params);
$friendsWithMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return friend data with messages as JSON
header('Content-Type: application/json');
echo json_encode($friendsWithMessages);
?>
