<?php

require_once 'DatabaseHandler.php';  // Replace with the actual path to DatabaseHandler.php

// Check if it's a POST request and if 'state' is set in the POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['state'])) {
    // Retrieve the 'state' value from the POST data
    $state = $_POST['state'];
    $email = $_POST['email'];

    // Your database connection parameters
    $host = '127.0.0.1';
    $dbname = 'hkayn';
    $username = 'root';
    $password = '';

    // Get an instance of DatabaseHandler
    $dbHandler = DatabaseHandler::getInstance($host, $dbname, $username, $password);

    // Update database column based on the 'state' value
    if ($state === 'OK') {
        // Replace 'your_table_name' and 'your_column_name' with your actual table and column names
        $query = "UPDATE users SET confirmated_email = '1' WHERE email = '$email'";

        // Execute the query
        $stmt = $dbHandler->executeQuery($query);

        // Check if the query executed successfully
        if ($stmt) {
            // Database column updated successfully, no need to send a response to the client
        } else {
            // Handle the error if needed
            echo "Error updating database column.";
        }
    }

    // Exit without sending any response to the client
    exit;
} else {
    // Return an error response if the request is not a valid POST request
    $response = [
        'success' => false,
        'message' => 'Invalid request.'
    ];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
