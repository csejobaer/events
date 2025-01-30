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


?>




<?php
require_once 'database.php'; // Include database connection

// $response = ["success" => false, "message" => ""];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Database connection
        $db = new Database(); // Adjust based on your connection class
        $conn = $db->getConnection();

        // Check if email already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $response["message"] = "Email is already registered.";
        } else {
            // Insert user data into the database
            $stmt = $conn->prepare("INSERT INTO user (name, email, phone, gender, password, role, created_at, admin_approval) 
                                    VALUES (:name, :email, :phone, :gender, :password, :role, NOW(), 0)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            $response["success"] = true;
            $response["message"] = "Registration successful!";
        }
    } catch (PDOException $e) {
        // Database error
        $response["message"] = "Database error: " . $e->getMessage();
    }
}

// Return JSON response
// echo json_encode($response);
?>




		<div class="slider">
			<div class="container">
				<div class="row  justify-content-center vh-100">
					<div class="col-md-12 align-self-center text-center">
							<div class="row justify-content-center">
							<div class="col-md-8">
								<div class="form bg-w registration-area registration-page inputfield">
									<form method="POST" id="registrationForm">
							        <div class="form-group text-left">
							        	<div class="row">
							        		
										<h3 class="color-primary text-uppercase border-buttom-primary">Register Now</h2>
							        	</div>		
							        	<!-- row -->
							        		<div class="row">
							        			<div class="col-md-4">
							        				<!-- single field -->
													<div class="form-group">
														<label for="name">Name</label>
														<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
													</div>
							        				<!-- /single field -->
							        			</div><!-- /col-md-6 -->
							        			
							        			
							        			<div class="col-md-4">
							        				<!-- Email -->
													<div class="form-group">
														<label for="email">Email Address</label>
														<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
													</div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
												    <label for="phone">Phone Number</label>
												    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
												  </div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
												    <label for="gender">Gender</label><br>
												    <Select id="gender" class="form-control">
													    <option id="male" name="gender" value="male"> Male</option>
													    <option id="male" name="gender" value="female"> Female</option>
													    <option id="male" name="gender" value="other"> Other</option>
													</Select>
												  </div>
							        			</div><!-- /col-md-4 -->

							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
												    <label for="password">Set Password</label>
    												<input type="password" class="form-control" id="password" name="password">
												  </div>
							        			</div><!-- /col-md-4 -->



							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
												    <label for="confirm_password">Confirm Password</label>
    												<input type="password" class="form-control" id="confirm_password" name="confirm_password">
												  </div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
												    <label for="role">Role</label>
												    <select class="form-control" id="role">
												      <option value="author">Author</option>
												      <option value="subscriber">Subscriber</option>
												      <option value="contributor">Contributor</option>
												    </select>
												  </div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
													 <!-- Terms & Conditions -->
													  <div class="form-group form-check">
													    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
													    <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
													  </div>
												  </div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
													 <button type="submit" class="primary-theme-bg btn btn text-uppercase color-secondary">Confirm</button>
												  </div>
							        			</div><!-- /col-md-4 -->

							        		</div>
							        	<!-- row -->
							        </div>
							        

							      </form>
								</div>	
							</div> <!--col-md-4 -->
						</div> <!--row -->
					</div>

					
				</div>
			</div>
		</div>
		<!-- /Slider -->
		<div id="notification"></div>
	</header>
	<!-- /header -->
	<!-- /Header area -->





	<!-- Main content -->
	
	<!-- /Main content -->
	
	<?php get_footer(); ?>

