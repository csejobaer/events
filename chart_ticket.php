<?php
// Assuming the database connection is already included
$query = "SELECT DAY(purchased_at) as day, COUNT(ticket_id) as tickets_sold 
          FROM tickets 
          GROUP BY DAY(purchased_at)
          ORDER BY DAY(purchased_at)";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$days = [];
$ticketsSold = [];

// Process data to create arrays for chart
foreach ($result as $row) {
    $days[] = $row['day']; // Store days
    $ticketsSold[] = $row['tickets_sold']; // Store the number of tickets sold for each day
}

// Convert arrays to JSON format
$daysJson = json_encode($days);
$ticketsSoldJson = json_encode($ticketsSold);
?>
