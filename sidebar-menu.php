<!-- Sidebar Menu -->
                    <div class="col-md-2">
                        <div class="logo">
                            <img src="images/logo.png" alt="logo">
                        </div>
                        <!-- admin menu -->
                        <div class="admin-menu">
                            <div class="admin-nav">
                                <ul class="nav">
                                    <li><a  href="dashboard.php" title="Dashboard"><i class="icon fa fa-home"></i> Dashboard</a></li>
                                    <?php if ($_SESSION['role'] == 'admin') {?>
                                      
                                    <li><a href="manage_events.php" title="Manage Events"><i class="icon icon_ribbon_alt"></i> Manage Events</a></li>
                                    <li><a href="manage_user.php" title="Manage Users"><i class="icon fa fa-user"></i> Manage Users</a></li>
                                    <?php } ?>

                                    <li><a href="tickets_management.php" title="Tickets Management"><i class="icon icon_book_alt"></i> Tickets Management</a></li>
                                    <li><a href="reports.php" title="Reports"><i class="icon flaticon-worldwide"></i> Reports</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /admin menu -->
                    </div>
                <!-- /Sidebar Menu -->