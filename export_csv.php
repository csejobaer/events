<?php
// Include the database connection file
include_once 'database.php';  
$db = new Database();
$conn = $db->getConnection();

// Handle the form submission for exporting the selected event's ticket data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];  // Get the selected event ID from the form submission
    
    // Ensure the event ID is not empty
    if (!empty($event_id)) {
        
        // Fetch the ticket data for the selected event, excluding the approval_status column
        $query = "
            SELECT 
                ticket_id, event_id, seat_number, price, tshirt_size, purchased_at, 
                user_name, user_email, user_phone 
            FROM ticket 
            WHERE event_id = :event_id
        ";
        
        // Prepare the SQL query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch all ticket data
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        // If tickets are found, generate and export the CSV file
        if ($tickets) {
            // Set the headers to force the browser to download the CSV file
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="event_' . $event_id . '_tickets.csv"');
            
            // Open PHP output stream to write the CSV file
            $output = fopen('php://output', 'w');
            
            // Write the header row in a more formal, organized way
            fputcsv($output, [
                'Ticket ID', 
                'Event ID', 
                'Seat Number', 
                'Price (Tk)', 
                'T-shirt Size', 
                'Purchased At', 
                'User Name', 
                'User Email', 
                'User Phone'
            ]);
            
            // Iterate through each ticket and write its data to the CSV file
            foreach ($tickets as $ticket) {
                // Format the purchased_at date for clarity (optional)
                $formattedDate = date('Y-m-d', strtotime($ticket['purchased_at']));
                
                // Write ticket data to the CSV file in a clean, organized way
                fputcsv($output, [
                    $ticket['ticket_id'], 
                    $ticket['event_id'], 
                    $ticket['seat_number'], 
                    $ticket['price'], 
                    $ticket['tshirt_size'], 
                    $formattedDate,  // Formatted purchase date
                    $ticket['user_name'], 
                    $ticket['user_email'], 
                    $ticket['user_phone']
                ]);
            }
            
            // Close the output stream to complete the CSV generation
            fclose($output);
            exit;  // Ensure the script stops after generating the file
        } else {
            // Handle case if no tickets are found for the selected event
            echo "No tickets found for the selected event.";  
        }
    } else {
        // Handle case if no event is selected
        echo "Please select an event.";  
    }
}
?>
