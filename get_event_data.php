<?php
// Include database connection
require_once 'database.php';
$response = array(); // Initialize the response array

// Check if event_id is passed via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $event_id = $_GET['id'];

    try {
        // Create a new database instance
        $db = new Database();
        $conn = $db->getConnection();

        // Prepare the SQL query to fetch the event data
        $query = "SELECT * FROM event WHERE event_id = :event_id LIMIT 1";
        
        // Prepare the SQL statement
        $stmt = $conn->prepare($query);
        
        // Bind the event_id parameter
        $stmt->bindParam(':event_id', $event_id);
        
        // Execute the statement
        $stmt->execute();
        
        // Fetch the event data
        if ($stmt->rowCount() > 0) {
            $event = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Return the event data in the response
            $response = $event;
        } else {
            // If no event found, return an error message
            $response['error'] = 'Event not found.';
        }
    } catch (Exception $e) {
        $response['error'] = 'Error: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'Event ID is required.';
}

// Return the response as JSON
echo json_encode($response);
?>
