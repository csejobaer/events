<?php
// DB.php - Database connection class

class Database {
    private $host = "localhost";
    private $dbname = "event_management";  // Replace with your DB name
    private $username = "root";           // Replace with your DB username
    private $password = "";               // Replace with your DB password
    private $pdo;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->connect();
    }

    // Method to establish database connection using PDO
    private function connect() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Method to get the PDO instance for querying the database
    public function getConnection() {
        return $this->pdo;
    }
}
?>
