
<?php 


if(file_exists('functions.php')){
 require_once('functions.php');
}

get_header('logged_in');



 ?>




									<p class="color-primary">Manage Events </p>
										<div class="row">
											<!-- single-deshboard-menu -->
											<div class="col-md-3">
												<!-- Button trigger modal -->
												<a class="desh-button" href="" id="createEvent"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEventForm">
													<div class="desh-item">
														<div class="desh-icon">
															<i class="icon flaticon-diamond-1"></i>
														</div>
														<h4>+</h4>
														<p>Create New Event.</p>
													</div>
												</a>
												<!-- /Button trigger modal -->
											</div>
											<!-- /single-deshboard-menu -->

											<!-- single-deshboard-menu -->
											<div class="col-md-3">
												<a class="desh-button" href="event_list.php">
													<div class="desh-item">
														<div class="desh-icon">
															<i class="fa fa-calendar"></i>
														</div>
														<h4>View</h4>
														<p>All Events.</p>
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






















<!-- Event Create form -->
<div class="modal fade" id="createEventForm" tabindex="-1" aria-labelledby="createEventFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createEventFormLabel">Event Management</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Start form area -->




					<div class="col-md-12 align-self-center text-center">
					
								<div class="form bg-w registration-area inputfield">
									<form id="eventRegister" enctype="multipart/form-data">
							        <div class="form-group text-left">
							        	<div class="row">
							        		
										<h3 class="color-primary text-uppercase border-buttom-primary">Post new event</h2>
							        	</div>		
							        	<!-- row -->
							        		<div class="row">
							        			<div class="col-md-12">
							        				<!-- single field -->
													<div class="form-group">
														<label for="title">Event Title*</label>
														<input type="text" class="form-control" id="title" name="fname" placeholder="Event Title" required>
													</div>
							        				<!-- /single field -->
							        			</div><!-- /col-md-6 -->
							        			
							        			
							        			
							        			<div class="col-md-12">
							        				<!-- Price -->
												    <div class="form-group">
														<label for="date">Number of Seats*</label>
														<input type="number" class="form-control" id="seats_no" name="seats_no">
									  				</div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-12">
							        				<!-- Price -->
												    <div class="form-group">
														<label for="date">Ticket Price*</label>
														<input type="number" class="form-control" id="price" name="price">
									  				</div>
							        			</div><!-- /col-md-4 -->
							        			
							        			
							        			<div class="col-md-12">
							        				<!-- Phone Number -->
												    <div class="form-group">
														<label for="date">Event Date*</label>
														<input type="date" class="form-control" id="date" name="date">
									  				</div>
							        			</div><!-- /col-md-4 -->
							        			
							        			
							        			<div class="col-md-12">
							        				<!-- Phone Number -->
												    <div class="form-group">
														<label for="stime">Start Time*</label>
														<input type="time" class="form-control" id="stime" name="stime">
									  				</div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-12">
							        				<!-- Phone Number -->
												    <div class="form-group">
														<label for="etime">End Time*</label>
														<input type="time" class="form-control" id="etime" name="etime">
									  				</div>
							        			</div><!-- /col-md-4 -->

							        			
							        			<div class="col-md-12">
							        				<!-- Email -->
													<div class="form-group">
														<label for="location">Address*</label>
														<input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
													</div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-12">
							        				<!-- Email -->
													<div class="form-group">
														<label for="des">Description*</label>
														<textarea class="form-control" id="des" name="email" placeholder="Enter Location" required></textarea> 
													</div>
							        			</div><!-- /col-md-4 -->
							        			
							        			<div class="col-md-12">
							        				<!-- Phone Number -->
												  <div class="form-group">
												    <label for="image">Upload post thumbnail*</label>
												    <input type="file" name="image" id="image" accept="image/*" required class="form-control" >
												  </div>
							        			</div><!-- /col-md-4 -->
							        			
							        			

							        			
							        			<div class="col-md-4">
							        				<!-- Phone Number -->
												  <div class="form-group">
													 <button type="submit" id="eventRegister" class="primary-theme-bg btn btn text-uppercase color-secondary">Post</button>
												  </div>
							        			</div><!-- /col-md-4 -->

							        		</div>
							        	<!-- row -->
							        </div>
							        

							      </form>
								</div>	
					</div>






        <!-- End form area -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>


<!-- Modal for Success Message -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                Your event has been successfully posted.
            </div>

        </div>
    </div>
</div>











<?php get_footer(); ?>