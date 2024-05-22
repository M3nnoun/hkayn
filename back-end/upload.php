<?php
session_start();
require_once 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
header('Content-Type: application/json');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['image'])) {
        // Get information about the uploaded file
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = htmlspecialchars($_FILES['image']['name']);
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];

        // Set a limit on the file size (e.g., 5MB)
        $maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

        // Specify the directory where you want to store uploaded images
        $uploadDirectory = '../uploads/';
        // Create the upload directory if it doesn't exist
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true); // Set more restrictive permissions
        }

        // Check file size
        if ($fileSize > $maxFileSize) {
            $response = ['status' => 'error', 'message' => 'File size exceeds the limit.'];
            echo json_encode($response);
            exit;
        }

        // Validate file type (you can customize this check based on your needs)
        $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fileType, $allowedFileTypes)) {
            $response = ['status' => 'error', 'message' => 'Invalid file type.'];
            echo json_encode($response);
            exit;
        }

        // Generate a unique name for the uploaded file
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = $uploadDirectory . uniqid() . '.' . $fileExtension;

        // Move the uploaded file to the destination directory
        if (is_uploaded_file($fileTmpPath) && move_uploaded_file($fileTmpPath, $newFileName)) {
    
            $databaseHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

            // Get the file name
            $uploadedFileName = basename($newFileName);
            $_SESSION['userImage'] = $uploadedFileName;
            // Update the user's profile_image column in the database
            $query = "UPDATE users SET profile_image = ? WHERE username LIKE ?";
            $params = [$uploadedFileName, trim($_SESSION['username'])];

            $result = $databaseHandler->executeQuery($query, $params);

            if ($result) {
                $response = ['status' => 'success', 'message' => 'File uploaded successfully. User profile image updated','fileName'=>$uploadedFileName];
            } else {
                $response = ['status' => 'error', 'message' => 'Error updating user profile image.'];
            }

            // Send the response as JSON
            echo json_encode($response);
        } else {
            // Error in uploading the file
            $response = ['status' => 'error', 'message' => 'Error uploading the file. Error: ' . error_get_last()['message']];
            echo json_encode($response);
        }
    } else {
        // No file uploaded or an error occurred
        $response = ['status' => 'error', 'message' => 'No file uploaded or an error occurred.'];
        echo json_encode($response);
    }
} else {
    // Request method is not POST
    $response = ['status' => 'error', 'message' => 'Invalid request method.'];
    echo json_encode($response);
}
