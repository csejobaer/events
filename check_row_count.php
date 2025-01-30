<?php
require_once 'database.php'; // Include your database connection

$response = ["success" => false, "message" => "", "row_count" => 0];

try {
    // Database connection
    $db = new Database(); // Adjust based on your connection class
    $conn = $db->getConnection();

    // Get the current row count from the user table
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user");
    $stmt->execute();

    // Fetch the row count
    $rowCount = $stmt->fetchColumn();

    // Return success response with the current row count
    $response["success"] = true;
    $response["row_count"] = $rowCount;
} catch (PDOException $e) {
    // Handle database error
    $response["message"] = "Database error: " . $e->getMessage();
}

// Return the response as JSON
echo json_encode($response);
?>
