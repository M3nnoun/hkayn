<?php
session_start(); // Start or resume the session

// Include the file containing the DatabaseHandler class definition
require_once 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the posted data
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    // Perform your login logic using DatabaseHandler for authentication
    $isValidLogin = authenticateUser($username, $password);

    if ($isValidLogin) {
        // Successful login
        // Set session variables
        $userInfo = getUserInfo($username);
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $userInfo['first_name'];
        $_SESSION['userImage'] = $userInfo['profile_image'];
        echo('Login');
        // header("Location: ../home.php");
    } else {
        // Failed login
        http_response_code(401); // Unauthorized status code
        echo 'Invalid username or password'.$username.' ' .$password .' => Responxe'.$isValidLogin;
    }
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed status code
    echo 'Invalid request method';
}

// Function to authenticate the user using DatabaseHandler
function authenticateUser($user, $userpassword) {
    try {
        // Create an instance of the DatabaseHandler class
        $databaseHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

        // Example usage to execute a query for authentication
        $query = "SELECT * FROM login l
        JOIN users u ON l.id_user = u.id
        WHERE u.username = :username";
        $params = [':username' => $user];
        $result = $databaseHandler->executeQuery($query, $params);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        // Example fetching data from the result
        // return $row['password'];
        return password_verify($userpassword, $row['password']);; // Returns true if authentication is successful, false otherwise
    } catch (Exception $e) {
        // If an exception occurs, return false
        return false;
    }
}

// Function to get the first name and profile image based on the username
function getUserInfo($username) {
    try {
        // Create an instance of the DatabaseHandler class
        $databaseHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

        // Example query to retrieve the first name and profile image based on the username
        $query = "SELECT `first_name`, `profile_image` FROM `users` WHERE `username` = :username";
        $params = [':username' => $username];
        $result = $databaseHandler->executeQuery($query, $params);

        // Example fetching data from the result
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row; // Return the associative array containing first name and profile image
    } catch (Exception $e) {
        // If an exception occurs, return an empty array
        return [];
    }
}

?>
