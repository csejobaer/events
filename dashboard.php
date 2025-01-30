<?php 


if(file_exists('functions.php')){
 require_once('functions.php');
}

get_header('logged_in');
include_once 'database.php';  // Assuming this includes the necessary DB connection logic
$db = new Database();
$conn = $db->getConnection();

// SQL query to count the number of tickets booked
$query = "SELECT COUNT(*) AS total_tickets FROM ticket WHERE approval_status = 'approved'";  // Corrected column name

// Prepare the statement
$stmt = $conn->prepare($query);

// Execute the query
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Get the total count of tickets
$total_tickets = $result['total_tickets'];




// SQL query to count the number of present events
$query = "SELECT COUNT(*) AS total_present_events 
          FROM event 
          WHERE event_date >= CURDATE()";  // Compare event_date with today's date

// Prepare the statement
$present_query = $conn->prepare($query);

// Execute the query
$present_query->execute();

// Fetch the result
$present_query_result = $present_query->fetch(PDO::FETCH_ASSOC);

// Get the total count of present events
$total_present_events = $present_query_result['total_present_events'];


$query  = "SELECT COUNT(*) as all_event FROM event";

$all_prepare = $conn->prepare($query);
$all_prepare->execute();
$all_event_number = $all_prepare->fetch(PDO::FETCH_ASSOC);
$all_count_result = $all_event_number['all_event'];


 ?>
                                    <p class="color-primary">Event Your are Managing </p>
                                        <div class="row">
                                            <!-- single-deshboard-menu -->
                                            <div class="col-md-3">
                                                <a class="desh-button" href="">
                                                    <div class="desh-item">
                                                        <div class="desh-icon">
                                                            <i class="icon fa fa-chair"></i>
                                                        </div>
                                                        <h4><?php echo $total_tickets; ?></h4>
                                                        <p>Registered Participants</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- /single-deshboard-menu -->

                                            <!-- single-deshboard-menu -->
                                            <div class="col-md-3">
                                                <a class="desh-button" href="">
                                                    <div class="desh-item">
                                                        <div class="desh-icon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <h4><?php echo $total_present_events; ?></h4>
                                                        <p>Present Event</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- /single-deshboard-menu -->

                                           

                                            <!-- single-deshboard-menu -->
                                            <div class="col-md-3">
                                                <a class="desh-button" href="">
                                                    <div class="desh-item">
                                                        <div class="desh-icon">
                                                            <i class="fa fa-user"></i>
                                                        </div>
                                                        <h4><?php echo $all_count_result; ?></h4>
                                                        <p>Total Events</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- /single-deshboard-menu -->
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