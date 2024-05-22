<?php

class DatabaseHandler {
    private static $instance;
    private $db;

    // Private constructor to prevent creating multiple instances
    private function __construct($host, $dbname, $username, $password) {
        $this->connect($host, $dbname, $username, $password);
    }

    // Method to get the singleton instance
    public static function getInstance($host, $dbname, $username, $password) {
        if (!self::$instance) {
            self::$instance = new self($host, $dbname, $username, $password);
        }
        return self::$instance;
    }

    // Function to connect to the database
    private function connect($host, $dbname, $username, $password) {
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Function to send a query to the database
    public function executeQuery($query, $params = []) {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }

    // Destructor to close the database connection when the object is destroyed
    public function __destruct() {
        $this->db = null;
    }

    public function getUserIdByUsername($username) {
        $query = "SELECT id FROM users WHERE username = :username";
        $params = [':username' => $username];
        $stmt = $this->executeQuery($query, $params);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result !== false) ? $result['id'] : null;
    }
}

