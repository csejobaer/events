
<?php 


if(file_exists('functions.php')){
 require_once('functions.php');
}

get_header('logged_in');




 ?>




				<div class="container mt-4">
				    <h2 class="text-center">Event Management Dashboard</h2>

				    <div class="table-responsive">
				        <?php
				// Include the database connection class
				include_once 'database.php';

				// Initialize the database connection
				$db = new Database();
				$conn = $db->getConnection();

				// Get the current page number from the URL, default to 1 if not set
				$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

				// Get the number of items per page from the select option, default to 10
				$items_per_page = isset($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 10;

				// Calculate the offset for the SQL query
				$offset = ($page - 1) * $items_per_page;

				// SQL query to get the total number of events for pagination
				$sql_count = "SELECT COUNT(*) FROM event";
				$stmt_count = $conn->prepare($sql_count);
				$stmt_count->execute();
				$total_events = $stmt_count->fetchColumn();

				// Calculate the total number of pages
				$total_pages = ceil($total_events / $items_per_page);

				// SQL query to retrieve the events for the current page
				$sql = "SELECT event_id, event_name, price, event_date, image, updated_at 
        FROM event 
        ORDER BY updated_at DESC 
        LIMIT :offset, :limit";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
				$stmt->bindParam(':limit', $items_per_page, PDO::PARAM_INT);
				$stmt->execute();

				// Fetch all the results
				$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

				// Output the events in an HTML table
				echo '<table class="table table-striped table-bordered">';
				echo '<thead class="table-dark">';
				echo '<tr>';
				echo '<th>Image</th>';
				echo '<th>Event Name</th>';
				echo '<th>Event Date</th>';
				echo '<th>Event Status</th>';
				echo '<th>Budget</th>';
				echo '<th>Last Modification Date</th>';
				echo '<th>Actions</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';

				foreach ($events as $event) {
				    echo '<tr>';
				    echo '<td class="list-img"><img src="' . htmlspecialchars($event['image']) . '" alt="Event Image" class="img-fluid" style="max-width: 100px;"></td>';
				    echo '<td><a href="/event/'.md5($event['event_id']).'">' . htmlspecialchars($event['event_name']) . '</a></td>';
				    echo '<td>' . htmlspecialchars($event['event_date']) . '</td>';

				    // Determine event status
				    $status = 'Upcoming'; // Default status
				    $current_date = new DateTime();
				    $event_date = new DateTime($event['event_date']);
				    if ($event_date < $current_date) {
				        $status = 'Past';
				    } else {
				        $status = 'Upcoming';
				    }

				    echo '<td><span class="badge bg-' . ($status == 'Past' ? 'danger' : 'success') . '">' . $status . '</span></td>';
				    echo '<td>$' . number_format($event['price'], 2) . '</td>';
				    echo '<td>' . htmlspecialchars($event['updated_at']) . '</td>';
				    echo '<td class="action-btns">
				            <i class="fas fa-edit" id="'.$event['event_id'].'" title="Edit"></i>
				            <i class="fas fa-trash" data-event-id="'.$event['event_id'].'" title="Delete"></i>

				          </td>';
				    echo '</tr>';
				}

				echo '</tbody>';
				echo '</table>';





				echo "<div class='container'>";
					echo "<div class='row'>";
						echo "<div class='col-md-6 page-nevigation'>";
							// Pagination controls
							echo '<nav>';
							echo '<ul class="pagination justify-content-center">';

							// Previous button
							if ($page > 1) {
							    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '&items_per_page=' . $items_per_page . '">Previous</a></li>';
							}

							// Page numbers
							for ($i = 1; $i <= $total_pages; $i++) {
							    $active = $i == $page ? 'active' : '';
							    echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '&items_per_page=' . $items_per_page . '">' . $i . '</a></li>';
							}

							// Next button
							if ($page < $total_pages) {
							    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '&items_per_page=' . $items_per_page . '">Next</a></li>';
							}

							echo '</ul>';
							echo '</nav>';
						echo '</div>'; // end col-md-6

						echo "<div class='col-md-6 post-per-page'>";
							// Select dropdown for number of items per page
							echo '<div class="form-group">';
							echo '<label for="items_per_page">Items per page:</label>';
							echo '<select id="items_per_page" class="pagination_items" onchange="window.location.href=\'?page=1&items_per_page=\' + this.value;">';
							echo '<option value="10"' . ($items_per_page == 10 ? ' selected' : '') . '>10</option>';
							echo '<option value="25"' . ($items_per_page == 25 ? ' selected' : '') . '>25</option>';
							echo '<option value="50"' . ($items_per_page == 50 ? ' selected' : '') . '>50</option>';
							echo '</select>';
							echo '</div>';
						echo '</div>';// end col-md-6



					echo '</div>'; //end row
				echo '</div>'; //end row
				?>

    </div>
</div>










<!-- Event Create form (Modal) -->
<div class="modal fade" id="createEventForm" tabindex="-1" aria-labelledby="createEventFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createEventFormLabel">Edit Event</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="eventRegister" enctype="multipart/form-data">
          <input type="hidden" id="event_id" name="event_id" /> <!-- Hidden input for event ID -->
          
          <div class="form-group">
            <label for="title">Event Title*</label>
            <input type="text" class="form-control" id="title" name="event_name" required />
          </div>
          <div class="form-group">
            <label for="price">Ticket Price*</label>
            <input type="number" class="form-control" id="price" name="price" required />
          </div>
          <div class="form-group">
            <label for="date">Event Date*</label>
            <input type="date" class="form-control" id="date" name="event_date" required />
          </div>
          <div class="form-group">
            <label for="stime">Start Time*</label>
            <input type="time" class="form-control" id="stime" name="start_time" required />
          </div>
          <div class="form-group">
            <label for="etime">End Time*</label>
            <input type="time" class="form-control" id="etime" name="end_time" required />
          </div>
          <div class="form-group">
            <label for="location">Event Location*</label>
            <input type="text" class="form-control" id="location" name="location" required />
          </div>
          <div class="form-group">
            <label for="des">Event Description*</label>
            <textarea class="form-control" id="des" name="description" required></textarea>
          </div>
          <div class="form-group">
            <label for="image">Upload Event Image (optional)</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-control" />
          </div>
          <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>










<?php get_footer(); ?>