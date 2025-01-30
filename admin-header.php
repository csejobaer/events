<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}


// Get the current file name
$filename = basename($_SERVER['SCRIPT_FILENAME']);

// Check the session role and the current file name
if ($_SESSION['role'] != 'admin' && ($filename == 'manage_events.php' || $filename == 'event_list.php' || $filename == 'manage_user.php')) {
    header('Location: access_denied.php'); // Redirect to access_denied.php
    exit(); // Make sure the script stops after the redirect
}

?>















<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theme Title Here</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Header area -->

    <section id="deshboard_area">
        <div class="outer_container">
        <div class="content_area">
            <div class="row">
                <?php 
                    if(file_exists('sidebar-menu.php')){
                     require_once('sidebar-menu.php');
                    }
                 ?>
                <!-- Deshboard content -->
                    <div class="col-md-10">
                        <div class="deshboard_content">
                            <!-- Header top -->
                                <div class="header_top_area">
                                    <div class="row header_top">
                                        <div class="col-md-6"><h2><?php echo "Welcome to your dashboard, " . $_SESSION['username']; ?></h2></div>
                                        <div class="col-md-6 align-right">



                                            <div class="admin_top_right"><i class="icon far fa-bell" style="margin-right: 10px;"></i><a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a></div></div>
                                    </div>
                                    <!-- Deshboard Content -->
                                    <div class="deshbaord-content-area">
