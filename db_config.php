<?php
$host = 'localhost';      // Your database host
$dbname = 'event_management';  // Your database name
$username = 'root';       // Your database username
$password = '';           // Your database password (empty for localhost)

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
