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

// Check if the department is set, otherwise use the default 'HR'
if (isset($_REQUEST['department'])) {
    $department = $_REQUEST['department'];
} else {
    $department = 'HR';
}

// Prepare and execute the SQL query to fetch employees of a specific department
$sql = "SELECT * FROM employee_department WHERE department = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();

// Store the fetched results in an array
$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
?>

<div class="me-5" style="width:50%">
    <select class="form-select mb-3" style="width: 100px;" id="zero" aria-label="Department List" multiple size="5">
        <?php
        // Loop through employees with target = 0 and display them
        foreach ($employees as $row) {
            if ($row["target"] == 0) {
                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
        }
        ?>
    </select>
</div>

<div>
    <!-- Button to move employees from target = 0 to target = 1 -->
    <button class="btn btn-primary" onclick="changeEmployee(document.getElementById('zero'), '1');">
        <i class="fa-solid fa-chevron-right"></i>
    </button>
    <br><br>
    <!-- Button to move employees from target = 1 to target = 0 -->
    <button class="btn btn-primary" onclick="changeEmployee(document.getElementById('one'), '0');">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
</div>

<div class="ms-5" style="width:50%">
    <select class="form-select mb-3" style="width: 100px;" id="one" aria-label="Department List" multiple size="5">
        <?php
        // Loop through employees with target = 1 and display them
        foreach ($employees as $row) {
            if ($row["target"] == 1) {
                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
        }
        ?>
    </select>
</div>
