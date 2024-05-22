<?php

require_once 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
header('Content-Type: application/json');
function storeLoginInformation($username, $password)
{
    $db = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    $query = "INSERT INTO login (id_user, password) VALUES (:id_user, :password)";

    // Bind parameters
    $params = [
        ':id_user' => $db->getUserIdByUsername($username),
        ':password' => $password,
    ];

    try {
        // Execute the query inside a try block
        $stmt = $db->executeQuery($query, $params);

        // Check if the query was successful
        return $stmt !== false;
    } catch (PDOException $e) {
        // Handle database-related exceptions
        return false;
    }
}
// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

    // Get the raw JSON data from the request
    $json_data = file_get_contents('php://input');

    // Decode JSON data
    $data = json_decode($json_data, true);

    // Validate and sanitize the data (perform additional validation as needed)
    $firstname = filter_var($data['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($data['lastname'], FILTER_SANITIZE_STRING);
    $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Hash the password
    $gender = filter_var($data['gender'], FILTER_SANITIZE_STRING);
    $dob = $data['dob']; // You might want to validate the date format
    $phone = filter_var($data['phone'], FILTER_SANITIZE_STRING); // Assuming you have a 'phone' field

    $query = "INSERT INTO users (username, first_name, last_name, email, phone, gender, date_of_birth, created_at, updated_at) 
              VALUES (:username, :firstname, :lastname, :email, :phone, :gender, :dob, NOW(), NOW())";

    // Bind parameters
    $params = [
        ':username' => $username,
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':email' => $email,
        ':phone' => $phone,
        ':gender' => $gender,
        ':dob' => $dob,
    ];

    try {
        // Execute the query inside a try block
        $stmt = $db->executeQuery($query, $params);

        // Check if the query was successful
        if ($stmt) {
            // Start a new session
            if(storeLoginInformation($username,$password)){
                session_start();

            // Store user information in session variables
            // $_SESSION['user_id'] = $db->lastInsertId(); // Assuming 'user_id' is your primary key
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;

            echo json_encode(['status' => 'success', 'message' => 'Signup successful', 'username' => $username]);
            }
            else {
            echo json_encode(['status' => 'error', 'message' => 'Error inserting login data']);
            }
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error inserting user data']);
        }
    } catch (PDOException $e) {
        // Handle database-related exceptions
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Handle non-POST requests (optional)
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
