<?php
// Include necessary files
include('database.php');

// Check if the action and user_id are set
if (isset($_POST['action']) && isset($_POST['user_id'])) {
    $action = $_POST['action'];
    $user_id = (int)$_POST['user_id'];

    // Create an instance of the Database class
    $db = new Database();
    $pdo = $db->getConnection();

    // Process the action
    if ($action == 'approve') {
        // Update the admin_approval column to 1
        $stmt = $pdo->prepare("UPDATE user SET admin_approval = 1 WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    } elseif ($action == 'reject') {
        // Delete the user from the database
        $stmt = $pdo->prepare("DELETE FROM user WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
?>
