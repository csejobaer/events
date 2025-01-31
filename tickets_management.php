
<?php 


if(file_exists('functions.php')){
 require_once('functions.php');
}

get_header('logged_in');

require_once 'database.php'; // Include your database connection

// Fetch the data from the database
$db = new Database();
$pdo = $db->getConnection();

// Number of rows per page
define('ROWS_PER_PAGE', 10);

// Get current page number and search term
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Calculate the offset for pagination
$offset = ($page - 1) * ROWS_PER_PAGE;

// Prepare the SQL query to get tickets and user info
$query = "
    SELECT 
        ticket_id, event_id, seat_number, price, tshirt_size, purchased_at, approval_status,
        user_name, user_email, user_phone
    FROM ticket
    WHERE user_name LIKE :search OR user_email LIKE :search OR user_phone LIKE :search
    LIMIT :offset, :limit";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', ROWS_PER_PAGE, PDO::PARAM_INT);
$stmt->execute();

// Fetch the results
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total number of rows for pagination
$countQuery = "
    SELECT COUNT(*) 
    FROM ticket
    WHERE user_name LIKE :search OR user_email LIKE :search OR user_phone LIKE :search";
$countStmt = $pdo->prepare($countQuery);
$countStmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$countStmt->execute();
$totalRows = $countStmt->fetchColumn();

// Calculate total pages
$totalPages = ceil($totalRows / ROWS_PER_PAGE);



$eSQuery =  "SELECT DISTINCT t.event_id, 
                e.event_name, 
                e.event_date
            FROM ticket t
            JOIN event e ON t.event_id = e.event_id";
$estmt = $pdo->prepare($eSQuery);
$estmt->execute();

// Fetch the results
$events = $estmt->fetchAll(PDO::FETCH_ASSOC);




 ?>



<!-- Search Bar -->
<div class="row search-bar">
    <div class="col-md-6 offset-md-3">
        <select id="search-input" class="form-control">
            <option value="">Select Event</option>
            <?php foreach ($events as $event) { ?>
                <option value="<?php echo $event['event_id']?>"><?php echo $event['event_id']." - ". $event['event_name'];?></option>
            <?php } ?>
        </select>
    </div>
</div>

<!-- Table for Tickets -->
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="ticketTable">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Seat Number</th>
                <th>Price</th>
                <th>T-shirt Size</th>
                <th>Purchased At</th>
                <th>Approval Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="ticketTableBody">
            <!-- Initial rows will be populated by PHP or AJAX -->
            <?php foreach ($tickets as $ticket) { ?>
                <tr class="ticket-row" data-event-id="<?php echo $ticket['event_id']; ?>" id="ticket-row-<?php echo $ticket['ticket_id']; ?>">
                    <td><?php echo $ticket['user_name']; ?></td>
                    <td><?php echo $ticket['user_email']; ?></td>
                    <td><?php echo $ticket['user_phone']; ?></td>
                    <td><?php echo $ticket['seat_number']; ?></td>
                    <td><?php echo $ticket['price']; ?></td>
                    <td><?php echo $ticket['tshirt_size']; ?></td>
                    <td><?php echo $ticket['purchased_at']; ?></td>
                    <td>
                        <span class="status-<?php echo $ticket['ticket_id']; ?>">
                            <?php
                            echo $ticket['approval_status'] == 'approved' ? "<i class='fas fa-check-circle approved-icon'></i>" :
                                ($ticket['approval_status'] == 'rejected' ? "<i class='fas fa-times-circle rejected-icon'></i>" : "<i class='fas fa-clock'></i>");
                            ?>
                        </span>
                    </td>
                    <td>
                        <?php echo $ticket['approval_status'] == 'pending' ? "<button class='btn btn-approve btn-sm' onclick='approveTicket({$ticket['ticket_id']})'>Approve</button>" : ""; ?>
                        <button class="btn btn-reject btn-sm" onclick="rejectTicket(<?php echo $ticket['ticket_id']; ?>)">Reject</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>









									</div>
									<!-- /Deshboard Content -->
								</div>
							<!-- /Header top -->
						</div>
					</div>
				<!-- /Deshboard content -->
			</div>

		</div>
		</div> <!-- /Container -->
	</section>






<?php get_footer(); ?>