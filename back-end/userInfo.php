<?php

// Include the DatabaseHandler class
include 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
// Function to get user information by username
function getUserInfoByUsername($username) {
    $dbHandler= DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    // Get user ID by username
    $userId = $dbHandler->getUserIdByUsername($username);

    if ($userId) {
        // Query to get user information based on user ID
        $query = "SELECT first_name, last_name, profile_image FROM users WHERE id = :id";
        $params = [':id' => $userId];

        // Execute the query
        $stmt = $dbHandler->executeQuery($query, $params);

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return user information
        return ($result !== false) ? $result : null;
    }

    // Return null if user ID is not found
    return null;
}

// Check if the username parameter is set in the request
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Call the function to get user information
    $userInfo = getUserInfoByUsername($username);

    // Output the result as JSON
    header('Content-Type: application/json');
    echo json_encode($userInfo);
} else {
    // Output an error message if username parameter is not provided
    echo json_encode(['error' => 'Username parameter is missing']);
}
?>
