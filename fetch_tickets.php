
<?php
// Include the Database class
include('database.php');

// Create an instance of the Database class
$database = new Database();

// Get the PDO instance
$pdo = $database->getConnection();

// Get the event_id from the AJAX request
$event_id = isset($_POST['event_id']) ? $_POST['event_id'] : '';

// Check if event_id is provided
if ($event_id !== '') {
    $query = "
        SELECT 
            ticket_id, event_id, seat_number, price, tshirt_size, purchased_at, approval_status,
            user_name, user_email, user_phone
        FROM ticket
        WHERE event_id = :event_id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the results
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($tickets) > 0) {
        // Return the tickets in a JSON format
        echo json_encode(['success' => true, 'tickets' => $tickets]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No tickets found for this event.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Event ID is required.']);
}
?>
