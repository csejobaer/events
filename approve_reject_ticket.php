<?php
// Include the database connection class
include('database.php');

// Check if the required POST data is available
if (isset($_POST['action']) && isset($_POST['ticket_id'])) {
    $action = $_POST['action'];
    $ticketId = $_POST['ticket_id'];

    // Check if the action is either 'approve' or 'reject'
    if ($action === 'approve' || $action === 'reject') {
        try {
            // Initialize the database connection
            $db = new Database();
            $pdo = $db->getConnection();

            // Prepare the SQL query to update the approval status
            $approvalStatus = ($action === 'approve') ? 'approved' : 'rejected';

            // SQL query to update the approval status
            $query = "UPDATE ticket SET approval_status = :approval_status WHERE ticket_id = :ticket_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':approval_status', $approvalStatus, PDO::PARAM_STR);
            $stmt->bindValue(':ticket_id', $ticketId, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Return success message
            echo 'success';
        } catch (PDOException $e) {
            // Return error message if there's a problem with the database query
            echo 'error: ' . $e->getMessage();
        }
    } else {
        echo 'error: Invalid action';
    }
} else {
    echo 'error: Missing action or ticket ID';
}
?>
