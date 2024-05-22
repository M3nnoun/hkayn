<?php
session_start();
// Assuming you have a DatabaseHandler class for database interactions
require_once 'DatabaseHandler.php';
include_once(__DIR__ . '/../config/database.php');
// Fetch user data from the database
$hostDb = '127.0.0.1';
$dbnameDb = 'hkayn';
$usernameDb = 'root';
$passwordDb = '';
$databaseHandler = DatabaseHandler::getInstance(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);

$query = "SELECT username, profile_image FROM users WHERE username != :currentUsername ORDER BY created_at DESC";
$params = [':currentUsername' => trim($_SESSION['username'])];
$stmt = $databaseHandler->executeQuery($query, $params);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return user data as JSON
header('Content-Type: application/json');
echo json_encode($users);
?>
