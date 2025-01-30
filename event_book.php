<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once 'database.php';  // Assuming this includes the necessary DB connection logic
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $seat = htmlspecialchars(trim($_POST['seat']));
    $tshirt_size = htmlspecialchars(trim($_POST['tshirt_size']));
    $event_id = htmlspecialchars(trim($_POST['eventId']));

    // Check if all required fields are provided
    if (empty($name) || empty($email) || empty($phone) || empty($seat) || empty($tshirt_size) || empty($event_id)) {
        echo 'Input missing';
        exit();
    }

    // Fetch event price
    $query = "SELECT price FROM event WHERE event_id = :eventId";
    $estmt = $conn->prepare($query);
    $estmt->bindParam(':eventId', $event_id, PDO::PARAM_INT);
    $estmt->execute();
    $event = $estmt->fetch(PDO::FETCH_ASSOC);

    // Check if the event exists
    if (!$event) {
        echo 'Event not found';
        exit();
    }

    $price = $event['price'];

    // Prepare the insert query
    try {
        $stmt = $conn->prepare("INSERT INTO ticket (event_id, seat_number, price, tshirt_size, purchased_at, approval_status, user_name, user_email, user_phone) 
            VALUES (:event_id, :seat, :price, :tshirt_size, NOW(), 'pending', :name, :email, :phone)");

        // Bind the parameters
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':seat', $seat, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':tshirt_size', $tshirt_size, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

        // Execute the statement
        if ($stmt->execute()) {
            echo 'success';  // Return success response
        } else {
            $errorInfo = $stmt->errorInfo();
            echo 'error_db: ' . $errorInfo[2];  // Provide the error message for debugging
        }
    } catch (PDOException $e) {
        echo 'error_db_exception: ' . $e->getMessage();
        error_log("Database error: " . $e->getMessage());
    }
} else {
    echo 'error_request_method';  // Return error if form is not submitted via POST
}
?>
