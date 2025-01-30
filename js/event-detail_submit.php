<?php
// Include the Database class
include 'database.php';

// Check if the form data is set
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve form data
    $event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;
    $name = trim($_GET['name']);
    $email = trim($_GET['email']);
    $phone = trim($_GET['phone']);
    $seat = trim($_GET['seat']);  // Assuming seat is passed in the form
    $tshirt_size = $_GET['tshirt_size'];

    // Server-side validation (optional if you trust the client-side)
    if (empty($name) || empty($email) || empty($phone) || empty($seat)) {
        echo "All fields are required.";
        exit;
    }

    // Prepare the SQL insert query
    $sql = "INSERT INTO ticket (event_id, user_name, user_email, user_phone, seat_number, tshirt_size) 
            VALUES (?, ?, ?, ?, ?, ?)";

    try {
        // Create a new database connection
        $db = new Database();
        $pdo = $db->getConnection();

        // Prepare and execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$event_id, $name, $email, $phone, $seat, $tshirt_size]);

        // If the insert is successful, return success message
        echo "success";
    } catch (PDOException $e) {
        // Catch any errors and display an error message
        echo "Error: " . $e->getMessage();
    }
}
?>
