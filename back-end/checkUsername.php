<?php

// Include the file containing the DatabaseHandler class definition
require_once 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
function checkUserNameExists($searchUsername) {
    try {
        // Create an instance of the DatabaseHandler class
        $databaseHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

        // Example usage to execute a query
        $query = "SELECT * FROM users WHERE username LIKE :username";
        $params = [':username' => $searchUsername];
        $result = $databaseHandler->executeQuery($query, $params);

        // Example fetching data from the result
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Process each row as needed
            return true;
        }

        // If the code execution reaches here, everything is successful
        return false;
    } catch (Exception $e) {
        // If an exception occurs, return false
        return false;
    }
}

// Check if 'username' is set in the POST request
if (isset($_POST['username'])) {
    $searchUsername = $_POST['username'];
    echo(checkUserNameExists($searchUsername));
} else {
    echo "Username not provided in the POST request.";
}

