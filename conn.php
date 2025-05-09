<?php

// Include the database connection file
require_once 'conn.php';

// Establish a database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "employee";

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check for a connection error and handle it gracefully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Bulk update employee targets based on selected IDs and target value
if (isset($_POST['selectedIds']) && isset($_POST['target'])) {
    // Decode the selected IDs from JSON format
    $selectedIds = json_decode($_POST['selectedIds']);
    $target = $_POST['target']; 

    // Iterate through each ID to update the target
    foreach ($selectedIds as $id) {
        // Use a prepared statement to prevent SQL injection
        $sql = "UPDATE employee_department SET target = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $target, $id);
        $stmt->execute();
    }
}
?>
