<?php
    /* ******************************************
     ========================================= Databse file link===========================
                                                        ******************************** */
    if(file_exists('functions.php')){
        require_once('functions.php');
    }
    // Include the database connection class
    include_once 'database.php';


/* ******************************************
     ========================================= Databse file link===========================
                                                        ******************************** */
    if(file_exists('header.php')){
        require_once('header.php');
    }
    $logs = '';
    get_header($logs);












// Initialize the database connection
$db = new Database();
$conn = $db->getConnection();

// Get the event ID from the URL parameter
if (isset($_GET['id'])) {
    $event_id = (int)$_GET['id'];  // Sanitize and cast to integer
} else {
    die("Event ID is missing.");
}

// Prepare the SQL query to fetch the event details
$sql = "SELECT e.event_id, e.event_name, e.event_date, e.start_time, e.end_time, e.description, e.image, e.location, e.price, e.updated_at, a.name AS author_name, a.designation AS position
        FROM event e
        JOIN admin a ON e.admin_id = a.admin_id
        WHERE e.event_id = :event_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch the event details
$event = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the event exists
if ($event) {
    // Format event start and end time (convert to 12-hour format)
    $start_time = new DateTime($event['start_time']);
    $end_time = new DateTime($event['end_time']);
    $formatted_start_time = $start_time->format('h:i A'); // Format as 12-hour (12:00 AM)
    $formatted_end_time = $end_time->format('h:i A'); // Format as 12-hour (01:00 PM)

    // Display event details


?>



  <!-- Slider -->
        <!-- Row -->
                

    </header>
    <!-- /header -->
    <!-- /Header area -->

<div class="row justify-content-center bg-w pt-50 event-information-container">
                    <div class="col-md-8" style="margin-top: 100px;">

                        <div class="event-detail">
                        <!-- Content area -->
                        <div class="image-box">





                            <figure class="image wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;"><a href="images/resource/event-detail.jpg" class="lightbox-image">
                                <?php 
                                     // You can also display the event image if it exists
                                    if (!empty($event['image'])) {
                                        echo '<img src="'. htmlspecialchars($event['image']) . '" alt="Event Image" />';
                                    }
                                ?></a>
                            </figure>

                        </div>
                        <div class="content-box">

                            <div class="speaker-info">

                                <figure class="thumb"><img src="images/resource/thumb-1.jpg" alt=""></figure> 
                                <h5 class="name"><?php echo  htmlspecialchars($event['author_name']);?></h5>

                                <span class="designation"><?php echo htmlspecialchars($event['position']);?></span>
                            </div>

                            <ul class="upper-info">

                                <li><span class="icon far fa-clock"></span><?php echo  $formatted_start_time . ' - ' . $formatted_end_time ?></li>
                                <li><span class="icon fa fa-calendar-alt"></span><?php echo   htmlspecialchars($event['event_date']); ?></li>
                                <li><?php echo  htmlspecialchars($event['price']); ?>$</li>
                                <li><span class="icon fa fa-map-marker-alt"></span><?php echo  htmlspecialchars($event['location']); ?></li>

                            </ul>


                                <h2><?php echo  htmlspecialchars($event['event_name']); ?></h2>





<?php

    echo '<div class="event-detail">';


    echo '<p class="event-description">' . nl2br(htmlspecialchars($event['description'])) . '</p>';
   
    
    echo '</div>';
} else {
    echo '<p>Event not found.</p>';
}
?>




                        </div>
                        <!-- /content-box -->
                        <!-- /Content area -->
                        </div>


<?php
// Fetch the event_id from the URL
$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;












?>
                    </div>
                    <!-- /col-md-9 -->
                    <div class="col-md-2" style="margin-top: 100px;">
                    <span id="event_booked" role="alert"></span>
                       <form id="event_book_form">
                        <div class="book-form inputfield">
                            <!-- single-field -->
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                <span class="error" id="name_error"></span> <!-- Error message for name -->
                            </div>

                            <!-- single-field -->
                            <div class="form-group">
                                <label for="eamil">Email*</label>
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                                    <span class="error" id="email_error"></span> <!-- Error message for email -->
                            </div>

                            <!-- single-field -->
                            <div class="form-group">
                                <label for="phone">Phone*</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number">
                                <span class="error" id="phone_error"></span> <!-- Error message for phone -->
                            </div>

                            <!-- Seat Selection -->
                            <div class="form-group">
                                <label for="inputField">Select Seat*</label>
                                <input type="text" id="inputField" class="form-control" placeholder="Click to select seat">
                                <span class="error" id="seat_error"></span> <!-- Error message for seat -->
                                <!-- Popup with Seat Selection -->
                                <div id="popupSelect" class="popup-select">
                                    <div id="seatingChart">
                                        <!-- Add your seat selection logic here -->
                                    </div>
                                </div>
                            </div>

                            <!-- T-shirt Size -->
                            <div class="form-group">
                                <label for="tshirt_size">T-shirt Size</label>
                                <select class="form-control" id="tshirt_size" name="tshirt_size">
                                    <option value="">Select Size</option>
                                    <option value="S">Small</option>
                                    <option value="M">Medium</option>
                                    <option value="L">Large</option>
                                    <option value="XL">X-Large</option>
                                    <option value="XXL">XX-Large</option>
                                </select>
                                <span class="error" id="tshirt_error"></span> <!-- Error message for t-shirt size -->
                            </div>

                            <div class="form-group">
                                <button type="submit" class="primary-theme-bg btn btn text-uppercase color-secondary" id="book_event">Book Now</button>
                            </div>
                        </div>
                    </form>

                    </div>
                    <!-- /col-md-3 -->

                </div>
                <!--/ Row -->
            </div>
        </div>
<?php get_footer(); ?>