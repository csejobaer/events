<?php


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
        $passwordPattern = '/^.{8,}$/';
        return preg_match($passwordPattern, $password);
    }

    // Method to authenticate user
    public function authenticate($email, $password) {
        // Hash the password using password_verify() in the authenticate method
        $query = "SELECT * FROM user WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Check if user exists
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the hashed password
            if (password_verify($password, $user['password'])) {
                // If credentials are correct, start the session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }

        return false;  // Return false if credentials are invalid
    }

    // Method to check if user is approved by admin
    public function isAdminApproved($email) {
        $query = "SELECT admin_approval FROM user WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user['admin_approval'] == 1;
        }

        return false;
    }
}
?>
