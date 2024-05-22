<?php
require_once 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
header('Content-Type: application/json');
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the raw JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Decode the JSON data
    $requestData = json_decode($json_data, true);

    // Check if decoding was successful
    if ($requestData !== null) {
    $dbHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

        // Extract username and friends from the requestData
        $username = $dbHandler->executeQuery("SELECT id FROM users WHERE username = ?", [$requestData['username']]);
        $user1_id = $username->fetchColumn();

        // Process the friends array and insert into the friends table
        foreach ($requestData['friends'] as $friend) {
            $user2_id = $dbHandler->executeQuery("SELECT id FROM users WHERE username = ?", [$friend])->fetchColumn();

            // Insert data into the 'friends' table (adjust the table and column names accordingly)
            $sqlInsert = "INSERT INTO friends (user1_id, user2_id) VALUES (?, ?)";
            $dbHandler->executeQuery($sqlInsert, [$user1_id, $user2_id]);
        }

        // Send a response back to the client if needed
        $response = array("status" => "success", "message" => "Friendships received and stored successfully");
        echo json_encode($response);
    } else {
        // Failed to decode JSON
        $response = array("status" => "error", "message" => "Invalid JSON data");
        echo json_encode($response);
    }
} else {
    // Not a POST request
    $response = array("status" => "error", "message" => "Invalid request method");
    echo json_encode($response);
}
?>
