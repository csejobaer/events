<?php
// Include database connection
require_once 'database.php';

$response = array(); // Initialize the response array

// Check if the request is a POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get the event ID
    $event_id = isset($_POST['event_id']) ? $_POST['event_id'] : null;

    // Get other form data
    $event_name = isset($_POST['event_name']) ? $_POST['event_name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : '';
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // Image upload handling
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Handle file upload (optional)
        $target_dir = "uploads/";
        $image_name = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        // Validate image file
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($image_extension), $allowed_extensions)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $target_file; // Save the image path
            } else {
                $response['error'] = 'Failed to upload image.';
            }
        } else {
            $response['error'] = 'Invalid image file type.';
        }
    }

    // Validate if event ID exists
    if (empty($event_id)) {
        $response['error'] = 'Event ID is required.';
    } elseif (empty($event_name) || empty($price) || empty($event_date) || empty($start_time) || empty($end_time) || empty($location) || empty($description)) {
        $response['error'] = 'All fields are required.';
    }

    // If no error, proceed with updating the event
    if (!isset($response['error'])) {
        try {
            // Create a new database instance
            $db = new Database();
            $conn = $db->getConnection();

            // Prepare the SQL query to update the event data
            $query = "UPDATE event SET 
                        event_name = :event_name, 
                        price = :price, 
                        event_date = :event_date, 
                        start_time = :start_time, 
                        end_time = :end_time, 
                        location = :location, 
                        description = :description";
            
            // Add image field only if it's provided
            if ($image) {
                $query .= ", image = :image";
            }

            // Add condition for the event ID
            $query .= " WHERE event_id = :event_id";

            // Prepare and execute the SQL statement
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':event_name', $event_name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':event_date', $event_date);
            $stmt->bindParam(':start_time', $start_time);
            $stmt->bindParam(':end_time', $end_time);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':event_id', $event_id);
            
            // Bind image parameter only if image is provided
            if ($image) {
                $stmt->bindParam(':image', $image);
            }

            // Execute the query
            if ($stmt->execute()) {
                $response['success'] = 'Event updated successfully.';
            } else {
                $response['error'] = 'Failed to update the event.';
            }
        } catch (Exception $e) {
            $response['error'] = 'Error: ' . $e->getMessage();
        }
    }
} else {
    $response['error'] = 'Invalid request method.';
}

// Return response as JSON
echo json_encode($response);
?>
