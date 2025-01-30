<?php
// User.php - User login and validation class

include('database.php');

class User {
    private $db;
    private $pdo;

    public function __construct() {
        // Initialize database connection
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    // Method to validate password pattern
    public function validatePassword($password) {
        $passwordPattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        return preg_match($passwordPattern, $password);
    }

    // Method to authenticate user
    public function authenticate($email, $password) {
        $password = md5($password); // Hash password using MD5

        // Prepared statement to prevent SQL Injection
        $query = "SELECT * FROM admin WHERE (email = :email OR username = :email) AND password = :password LIMIT 1";
        $stmt = $this->pdo->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // If the user exists, start the session and return true
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user['admin_id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = 'admin';
            return true;
        }

        return false;  // Return false if credentials are invalid
    }
}
?>
