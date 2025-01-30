<?php
// Start the session first
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include the database connection class
include_once 'database.php';

// Initialize the database connection
$db = new Database();
$conn = $db->getConnection();

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize form data
    $event_name = htmlspecialchars(trim($_POST['title']));
    $seats_no = htmlspecialchars(trim($_POST['seats_no']));
    $price = htmlspecialchars(trim($_POST['price']));
    $event_date = htmlspecialchars(trim($_POST['date']));
    $start_time = htmlspecialchars(trim($_POST['stime']));
    $end_time = htmlspecialchars(trim($_POST['etime']));
    $location = htmlspecialchars(trim($_POST['location']));
    $description = htmlspecialchars(trim($_POST['des']));

    // Get admin_id from session (make sure the user is logged in)
    $admin_id = $_SESSION['user_id'];  // Make sure admin_id is set in session

    // Validate required fields
    if (empty($event_name) || empty($price) || empty($seats_no) || empty($event_date) || empty($start_time) || empty($end_time) || empty($location) || empty($description) || empty($admin_id)) {
        echo 'error_empty_fields';  // More specific error message
        exit();
    }

    // Validate time (start time should be earlier than end time)
    try {
        $start_time_obj = new DateTime("1970-01-01T" . $start_time);
        $end_time_obj = new DateTime("1970-01-01T" . $end_time);
        if ($start_time_obj > $end_time_obj) {
            echo 'error_time';  // Return error if the end time is earlier than start time
            exit();
        }
    } catch (Exception $e) {
        echo 'error_time';  // In case of invalid date format
        exit();
    }

    // Handle file upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_type = $_FILES['image']['type'];

        // Validate file size (max 2MB)
        if ($image_size <= 2097152) {  // 2MB in bytes
            // Check for valid image type (JPEG, PNG, GIF)
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($image_type, $allowed_types)) {
                echo 'error_invalid_file_type';
                exit();
            }

            $upload_dir = 'uploads/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);  // Create uploads directory if it doesn't exist
            }

            $image_path = $upload_dir . basename($image_name);

            // Move uploaded image to the 'uploads' folder
            if (!move_uploaded_file($image_tmp_name, $image_path)) {
                echo 'error_upload';  // Return error if file upload fails
                exit();
            }
        } else {
            echo 'error_size';  // Return error if file size exceeds 2MB
            exit();
        }
    }

    // Prepare the SQL query to insert the event data into the database
    try {
        // Insert event data into the 'event' table
        $stmt = $conn->prepare("INSERT INTO event (admin_id, event_name, seats_no,  price, event_date, start_time, end_time, location, description, image) 
                                VALUES (:admin_id, :event_name, :seats_no, :price, :event_date, :start_time, :end_time, :location, :description, :image)");
        $stmt->bindParam(':admin_id', $admin_id);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':seats_no', $seats_no);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':start_time', $start_time);
        $stmt->bindParam(':end_time', $end_time);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image_path);

        // Execute the statement
        if ($stmt->execute()) {
            echo 'success';  // Return success response
        } else {
            $errorInfo = $stmt->errorInfo();
            echo 'error_db: ' . $errorInfo[2];  // Provide the error message for debugging
        }
    } catch (PDOException $e) {
        // Handle any exceptions
        echo 'error_db_exception: ' . $e->getMessage();  // More detailed error message
        error_log("Database error: " . $e->getMessage());
    }
} else {
    echo 'error_request_method';  // Return error if form is not submitted via POST
}
?>
