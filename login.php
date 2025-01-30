<?php
//session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Redirect to login page if not logged in
    exit();
}

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




/* ******************************************
	 ========================================= Login Validatoin===========================
	 													******************************** */



?>
		<!-- Slider -->
		<div class="slider">
			<div class="container">
				<div class="row  justify-content-center vh-100">
					<div class="col-md-12 align-self-center text-center">
													  <div class="row  justify-content-center">
													  	<div class="col-md-8">
<ul class="nav nav-pills mb-3 text-center" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#admin_login" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Admin Login</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#author_login" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">User Login</button>
  </li>

</ul>
							     </div>	
							     </div>	
							<div class="row justify-content-center">
							<div class="col-md-4">
								<div class="form bg-w registration-area inputfield">
							        <div class="form-group text-left">
							        	<div class="row">
							        		
										<h3 class="color-primary text-uppercase border-buttom-primary">Login Now</h2>
							        	</div>		
							        	<!-- row -->
	
							        		<div class="row position-relative">
								        		<div class="col-md-12 tab-pane fade show active" id="admin_login"  role="tabpanel" aria-labelledby="pills-home-tab">

												<form id="loginForm">

								        			
								        			<div class="row">
								        				 <!-- Email or Username -->
											        <div class="form-group">
											            <label for="text">Email Address or Username</label>
											            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" required>
											            <span id="emailError" class="text-danger"></span> <!-- Error message -->
											        </div>
								        			</div><!-- /col-md-4 -->
								        			
								        			<div class="row">
								        				<!-- Password -->
											        <div class="form-group">
											            <label for="password">Password</label>
											            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
											            <span id="passwordError" class="text-danger"></span> <!-- Error message -->
											        </div>
								        			</div><!-- /col-md-4 -->
								        			

								        			
								        			<div class="row">
								        				<!-- Phone Number -->
													  <div class="form-group">
														 <!-- Terms & Conditions -->
														  <div class="form-group form-check">
														    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
														    <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
														  </div>
													  </div>
								        			</div><!-- /col-md-4 -->
								        			
								        			<div class="row">
								        				<!-- Phone Number -->
													   <!-- Submit Button -->
											        <div class="form-group">
											            <button type="submit" class="primary-theme-bg btn btn text-uppercase color-secondary">Login</button>
											        </div>
								        			</div><!-- /col-md-4 -->

							      				</form>
								        		</div> <!-- col-md-12 -->





								        		<div class="col-md-12 tab-pane fade user_form_area" role="tabpanel" aria-labelledby="pills-profile-tab" id="author_login">
								        			
								        			<form id="user_login">
								        			<div class="row">
								        				 <!-- Email or Username -->
											        <div class="form-group">
											            <label for="text">Email Address</label>
											            <input type="email" class="form-control" id="uemail" name="uemail" placeholder="Enter your email or username" required>
											            <span id="user_loginErrorEmail" class="text-danger"></span> <!-- Error message -->
											        </div>
								        			</div><!-- /col-md-4 -->
								        			
								        			<div class="row">
								        				<!-- Password -->
											        <div class="form-group">
											            <label for="password">Password</label>
											            <input type="password" class="form-control" id="upassword" name="password" placeholder="Enter your password" required>
											            <span id="user_loginErrorPassword" class="text-danger"></span> <!-- Error message -->
											        </div>
								        			</div><!-- /col-md-4 -->
								        			

								        			
								        			<div class="row">
								        				<!-- Phone Number -->
													  <div class="form-group">
														 <!-- Terms & Conditions -->
														  <div class="form-group form-check">
														    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
														    <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
														  </div>
													  </div>
								        			</div><!-- /col-md-4 -->
								        			
								        			<div class="row">
								        				<!-- Phone Number -->
													   <!-- Submit Button -->
											        <div class="form-group">
											            <button type="submit" class="third-theme-bg btn btn text-uppercase color-secondary">Login</button>
											        </div>
								        			</div><!-- /col-md-4 -->
								        			</form>
								        		</div>







							        		</div>
							        	<!-- row -->
							        </div>
							        

								</div>	
							</div> <!--col-md-4 -->
						</div> <!--row -->
					</div>

					
				</div>
			</div>
		</div>
		<!-- /Slider -->
	</header>
	<!-- /header -->
	<!-- /Header area -->


	<!-- Main content -->
	]

	<!-- /Main content -->



 

<!-- Start Footer -->
<?php get_footer(); ?>