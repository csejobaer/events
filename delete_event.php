<?php
// Include database connection
require_once 'database.php';

// Initialize the response array
$response = array();

// Check if event_id is passed in the POST request
if (isset($_POST['event_id']) && !empty($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    try {
        // Create a new database instance
        $db = new Database();
        $conn = $db->getConnection();

        // Prepare the SQL query to delete the event from the database
        $query = "DELETE FROM event WHERE event_id = :event_id";

        // Prepare the SQL statement
        $stmt = $conn->prepare($query);

        // Bind the event_id parameter
        $stmt->bindParam(':event_id', $event_id);

        // Execute the delete query
        if ($stmt->execute()) {
            // Return a success message
            $response['success'] = 'Event deleted successfully.';
        } else {
            // Return an error message if something went wrong
            $response['error'] = 'Failed to delete the event.';
        }
    } catch (Exception $e) {
        $response['error'] = 'Error: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'Event ID is required.';
}

// Return the response as a JSON object
echo json_encode($response);
?>
