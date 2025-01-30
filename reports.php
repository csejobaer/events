<?php 


if(file_exists('functions.php')){
 require_once('functions.php');
}

get_header('logged_in');
include_once 'database.php';  
$db = new Database();
$conn = $db->getConnection();





// Assuming the database connection is already included
$query = "SELECT DAY(purchased_at) as day, COUNT(ticket_id) as tickets_sold 
          FROM ticket
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







// Query to fetch the total sold price per day

// Query to fetch the total sold price per day
$query = "SELECT DAY(purchased_at) as day_of_month, SUM(price) as total_revenue 
          FROM ticket 
          GROUP BY DAY(purchased_at)
          ORDER BY DAY(purchased_at)";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$daysOfMonth = [];
$totalRevenue = [];

// Ensure the result isn't empty
if ($result) {
    // Process the result to create arrays for the chart
    foreach ($result as $row) {
        $daysOfMonth[] = $row['day_of_month']; // Store the day of the month (1 to 31)
        $totalRevenue[] = $row['total_revenue']; // Store the total revenue (sold price) for each day
    }
} else {
    // Default empty values if no data is found (or handle appropriately)
    $daysOfMonth = range(1, 31); // Assuming a 31-day month
    $totalRevenue = array_fill(0, 31, 0); // Initialize all revenue values to 0
}

// Convert the arrays to JSON format for use in JavaScript
$daysOfMonthJson = json_encode($daysOfMonth);
$totalRevenueJson = json_encode($totalRevenue);






?>

<style>
	.report-area h4, .report-area p{
		color: #e84393;
	}
</style>
										<p class="color-primary">Manage Users </p>
										<div class="row">
											<!-- single-deshboard-menu -->
											<div class="col-md-6 report-area">
											        <div class="desh-item">
											            <div class="desh-icon">
											                <i class="fa fa-ticket-alt"></i> <!-- Ticket icon -->
											            </div>
											            <div class="chart">
											                <canvas id="ticket_sold" width="400" height="300"></canvas>
											            </div>
											            <h4>Ticket Sales</h4>
											            <p>Sold Ticket Information</p>
											        </div>
											</div>

											<!-- /single-deshboard-menu -->

											<!-- single-deshboard-menu -->
											<div class="col-md-6 report-area">
													<div class="desh-item">
														<div class="desh-icon">
															 <i class="fa fa-dollar-sign"></i> 
														</div>
														<div class="chart"> 
															<canvas id="sold_price_per_day" width="400" height="300"></canvas>
														</div>
														<h4>Total TK</h4>
														<p>Generate Event Performance Reports.</p>
													</div>
											</div>
											<!-- /single-deshboard-menu -->

											<!-- single-dashboard-menu -->

											<?php // Fetch the events from the database
												$query = "SELECT event_id, event_name FROM event";
												$stmt = $conn->prepare($query);
												$stmt->execute();
												$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
												?>

												<!-- HTML Form to Select an Event -->
												<div class="col-md-6 export-area">
												<form method="POST" action="export_csv.php">
												    <div class="col-md-12">
												        <label for="event">Select Event</label>
												        <select name="event_id" id="event" class="form-control">
												            <option value="">Select an Event</option>
												            <?php foreach ($events as $event): ?>
												                <option value="<?= $event['event_id']; ?>"><?= $event['event_id']; ?>-<?= $event['event_name']; ?></option>
												            <?php endforeach; ?>
												        </select>
												    </div>
												    <button class="desh-button" type="submit">
												        <div class="desh-item">
												            <div class="desh-icon">
												                <i class="fa fa-file-excel"></i> <!-- Excel export icon -->
												            </div>
												            <h4>Export</h4> <!-- You can change this to your preferred heading -->
												            <p>Excel</p> <!-- Subtitle for the option -->
												        </div>
												    </button>
												</form>
												</div>


												?>

    

<!-- /single-dashboard-menu -->


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


<script>



const days = <?php echo $daysJson; ?>;
const ticketsSold = <?php echo $ticketsSoldJson; ?>;

const ctx = document.getElementById('ticket_sold');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: days, // Dynamic days from PHP
        datasets: [{
            label: 'Tickets Sold',
            data: ticketsSold, // Dynamic ticket data from PHP
            borderColor: '#e84393',
            backgroundColor: '#e84393',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



const daysOfMonth = <?php echo $daysOfMonthJson; ?>;
const totalRevenue = <?php echo $totalRevenueJson; ?>;

const sold_price_per_day = document.getElementById('sold_price_per_day');

new Chart(sold_price_per_day, {
    type: 'line',
    data: {
    labels: daysOfMonth, // Dynamic days from PHP
    datasets: [{
        label: 'Revenue per Day (Tk)',
        data: totalRevenue, // Dynamic total revenue data from PHP
        borderColor: '#e84393', // Line color
        backgroundColor: 'rgba(232, 67, 147, 0.2)', // Light background color for the line chart
        borderWidth: 2,
        fill: true, // This will fill the area under the line
    }]
},
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



</script>