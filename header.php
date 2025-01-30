<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Redirect to login page if not logged in
    exit();
}

// Show the dashboard content

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Theme Title Here</title>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- style="background-image: url('images/slider.jpg');" -->
	<!-- Header area -->
	<header id="header" class="header_menu" >
		<div class="container position-relative">
			<div class="mainmenu">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-8">
						<ul class="align-right">
							<li><a class="menuLink color-primary" href="index.php">Home</a></li>
							<li><a class="menuLink color-primary" href="login.php">Login</a></li>
							<li><a class="menuLink color-primary" href="registration.php">Registration</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>