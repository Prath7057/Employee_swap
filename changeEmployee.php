<?php

// Include the database connection file
require_once 'conn.php';

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
