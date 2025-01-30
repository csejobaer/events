
<?php 


if(file_exists('functions.php')){
 require_once('functions.php');
}

get_header('logged_in');

require_once 'database.php'; // Include your database connection





// Define number of rows per page
define('ROWS_PER_PAGE', 30);

// Get current page number and search term
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Calculate the offset for pagination
$offset = ($page - 1) * ROWS_PER_PAGE;

// Create an instance of the Database class
$db = new Database();
$pdo = $db->getConnection();

// Prepare the SQL query with optional search condition
$query = "SELECT * FROM user WHERE name LIKE :search OR email LIKE :search OR phone LIKE :search LIMIT :offset, :limit";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', ROWS_PER_PAGE, PDO::PARAM_INT);
$stmt->execute();

// Fetch the results
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total number of rows for pagination
$countQuery = "SELECT COUNT(*) FROM user WHERE name LIKE :search OR email LIKE :search OR phone LIKE :search";
$countStmt = $pdo->prepare($countQuery);
$countStmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$countStmt->execute();
$totalRows = $countStmt->fetchColumn();

// Calculate total pages
$totalPages = ceil($totalRows / ROWS_PER_PAGE);








 ?>


<h2 class="my-4 text-center">Manage Users - Event Management</h2>

       





  
     <!-- Search Bar -->
    <div class="row search-bar">
        <div class="col-md-6 offset-md-3">
            <form method="GET" action="index.php">
                <input type="text" name="search" class="form-control" placeholder="Search users by name, email, or phone" value="<?php echo htmlspecialchars($search); ?>">
            </form>
        </div>
    </div>

    <!-- Table for User List -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="userTable">
            <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Updated At</th>
                    <th>Account Approval</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the users and display them in the table
                foreach ($users as $user) {
                    echo "<tr id='user-row-{$user['user_id']}'>
                            <td>{$user['user_id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['email']}</td>
                            <td>{$user['phone']}</td>
                            <td>{$user['role']}</td>
                            <td>{$user['updated_at']}</td>
                            <td>
                                <span class='status-{$user['user_id']}'>
                                    " . ($user['admin_approval'] == 1 ? "<i class='fas fa-check-circle approved-icon'></i>" : "<i class='fas fa-times-circle rejected-icon'></i>") . "
                                </span>
                            </td>
                            <td>
                                " . ($user['admin_approval'] == 0 ? "<button class='btn btn-approve btn-sm' onclick='approveUser({$user['user_id']})'>Approve</button>" : "") . "
                                <button class='btn btn-reject btn-sm' onclick='rejectUser({$user['user_id']})'>Reject</button>
                            </td>
                        </tr>";
                }
                ?>
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