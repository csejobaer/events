<?php
	/* ******************************************
	 ========================================= Databse file link===========================
	 													******************************** */
	if(file_exists('functions.php')){
		require_once('functions.php');
	}

/* ******************************************
	 ========================================= Databse file link===========================
	 													******************************** */
	if(file_exists('header.php')){
		require_once('header.php');
	}
	$logs = '';
	get_header($logs);




require_once 'database.php'; // Include your database connection

// Fetch the data from the database
$db = new Database();
$pdo = $db->getConnection();

// Query to get distinct event dates for future events only
$query = "SELECT DISTINCT event_date, event_id FROM event WHERE event_date >= CURDATE() ORDER BY event_date ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all events grouped by date
$events_by_date = [];
foreach ($events as $event) {
    $events_by_date[$event['event_date']][] = $event;
}
?>
<!-- Slider -->
<div class="slider">
    <div class="container">
        <div class="row justify-content-center vh-100">
            <div class="col-md-12 align-self-center text-center">
                <div class="event-top">
                    <h5 class="color-primary text-uppercase">One Stop</h5>
                    <h1 class="color-primary text-uppercase">Schedule Plan</h1>
                </div>

                <!-- List of Event Dates -->
                <div class="list-of-event-date">
                    <ul class="tab-buttons clearfix">
                        <?php foreach ($events as $event): 
                            // Convert event_date to a readable format (assuming the date is stored in `Y-m-d` format)
                            $eventDate = new DateTime($event['event_date']);
                            $day = $eventDate->format('d');
                            $month = $eventDate->format('M');
                            $year = $eventDate->format('Y');
                        ?>
                            <li class="tab-btn" data-tab="#tab-<?php echo $event['event_id']; ?>" onclick="showEvents('<?php echo $event['event_date']; ?>')">
                                <span class="day"><?php echo $day; ?></span>
                                <span class="date"><?php echo $day; ?></span>
                                <span class="month"><?php echo $month; ?></span> <?php echo $year; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>










<!--  -->



					</div>
				</div>
				<div class="row">
					


				</div>
			</div>



















		</div>
		<!-- /Slider -->
	</header>
	<!-- /header -->
	<!-- /Header area -->


	<!-- Main content -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				

<div class="tab active-tab" >

                        <div class="schedule-timeline">










<?php
// Initialize the database connection
$db = new Database();
$conn = $db->getConnection();

// Define how many events per page
$events_per_page = 10;

// Get the current page from the URL, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset based on the current page
$offset = ($page - 1) * $events_per_page;

// Fetch events and author details with pagination
$sql = "SELECT e.event_id, e.event_name, e.event_date AS edate, e.start_time, e.end_time, e.description, e.image, e.updated_at, a.name AS author_name, a.designation
        FROM event e
        JOIN admin a ON e.admin_id = a.admin_id
        WHERE e.event_date >= CURDATE()  -- Filter for present and upcoming events
        ORDER BY e.event_date DESC
        LIMIT :limit OFFSET :offset";  // Using LIMIT and OFFSET for pagination

$stmt = $conn->prepare($sql);
$stmt->bindParam(':limit', $events_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// Fetch all events
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are events
if ($events) {
    // Loop through each event and display in the schedule block format
    foreach ($events as $index => $event) {
        // Set the 'even' or 'odd' class for alternating styles
        $even_odd_class = ($index % 2 == 0) ? 'even' : '';
        
        // Format event start and end time (convert to 12-hour format)
        $start_time = new DateTime($event['start_time']);
        $end_time = new DateTime($event['end_time']);
        $formatted_start_time = $start_time->format('h:i A'); // Format as 12-hour (12:00 AM)
        $formatted_end_time = $end_time->format('h:i A'); // Format as 12-hour (01:00 PM)

        // Event description (trim to 100 characters for a preview)
        $event_description = (strlen($event['description']) > 100) ? substr($event['description'], 0, 100) . '...' : $event['description'];
        
        // Display event block
        echo '<!-- schedule Block -->';
        echo '<div class="schedule-block tab active-tab animated ' . $even_odd_class . '" id="tab-'.$event['event_id'].'">';
        echo '<div class="inner-box">';
        echo '<div class="inner">';
        
        // Display the formatted start and end time
        echo '<div class="date">' . $formatted_start_time . ' <br> ' . $formatted_end_time . '</div>';
        
        // Speaker info (author)
        echo '<div class="speaker-info">';
        echo '<figure class="thumb"><img src="images/resource/thumb-1.jpg" alt="' . htmlspecialchars($event['author_name']) . '"></figure>'; // Default image, replace accordingly
        echo '<h5 class="name">' . htmlspecialchars($event['author_name']) . '</h5>';
        echo '<span class="designation">' . htmlspecialchars($event['designation']) . '<br/>'.htmlspecialchars($event['edate']).'</span>';  // You can modify this if needed
        echo '</div>';

        // Event title and description
        echo '<h4><a href="event-detail.php?id=' . $event['event_id'] . '">' . htmlspecialchars($event['event_name']) . '</a></h4>';
        echo '<div class="text">' . htmlspecialchars($event_description) . '</div>'; // Event description (truncated)
        
        // Read more button
        echo '<div class="btn-box">';
        echo '<a href="event-detail.php?id=' . $event['event_id'] . '" class="theme-btn">Read More</a>';
        echo '</div>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No events found.</p>';
}

// Pagination: Calculate the total number of pages
$total_sql = "SELECT COUNT(*) FROM event WHERE event_date >= CURDATE()"; // Filter total count as well
$total_stmt = $conn->prepare($total_sql);
$total_stmt->execute();
$total_events = $total_stmt->fetchColumn();

// Calculate the total number of pages
$total_pages = ceil($total_events / $events_per_page);

// Display pagination links
echo "<div class='page-nevigation'>";
// Pagination controls
echo '<nav>';
echo '<ul class="pagination justify-content-center">';
if ($page > 1) {
    echo '<a href="?page=' . ($page - 1) . '" class="prev">Previous</a>';
}
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo '<li class="page-item"><a class="page-link">' . $i . '</a></li>';
    } else {
        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
}
if ($page < $total_pages) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '" class="next">Next</a></li>';
}
echo '</nav>';
echo '</ul>';
echo '</div>';
?>


















			</div>
		</div>
	</div>

	<!-- /Main content -->

<?php get_footer() ?>
