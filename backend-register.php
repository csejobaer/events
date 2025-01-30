<?php
require_once 'database.php'; // Include your database connection

$response = ["success" => false, "message" => "", "errors" => []];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);
    $role = trim($_POST['preferences']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $db = new Database(); // Adjust based on your database connection implementation
        $conn = $db->getConnection();

        // Check if email exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $response["message"] = "Email has already been registered.";
        } else {
            // Insert into database
            $stmt = $conn->prepare("INSERT INTO user (name, gender, email, password, phone, role, created_at, updated_at, admin_approval) 
                                    VALUES (:name, :gender, :email, :password, :phone, :role, NOW(), NOW(), 0)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            $response["success"] = true;
            $response["message"] = "Registration successful!";
        }
    } catch (PDOException $e) {
        $response["message"] = "Database error: " . $e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
