<?php

session_start();
include('User.php'); // Include the User class for authentication

// Check if form data is submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instantiate User class and authenticate the user
    $user = new User();

    // Validate password format
    if (!$user->validatePassword($password)) {
        echo "Password must be at least 8 characters long, with 1 uppercase letter, 1 number, and 1 special character.";
        exit;
    }

    // Authenticate the user
    if ($user->authenticate($email, $password)) {
        // If authenticated, return success
        echo 'success';
    } else {
        // If authentication fails, return an error message
        echo 'Invalid credentials. Please try again.';
    }
} else {
    // If missing required data, return an error
    echo 'Please provide both email and password.';
}