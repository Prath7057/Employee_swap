<?php
require_once 'conn.php';

if (isset($_REQUEST['department'])) {
    $department = $_REQUEST['department'];
} else {
    $department = 'HR';
}

$sql = "SELECT * FROM employee_department WHERE department = '$department'";
$result = $conn->query($sql);

// Store the fetched results in an array
$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
?>

<div class="me-5" style="width:30%">
    <select class="form-select mb-3" id="zero" aria-label="Department List" multiple size="5">
        <?php
        foreach ($employees as $row) {
            if ($row["target"] == 0) {
                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
        }
        ?>
    </select>
</div>

<div>
    <button class="btn btn-primary" onclick="changeEmployee(document.getElementById('zero'), '1');">
        <i class="fa-solid fa-chevron-right"></i>
    </button>
    <br><br>
    <button class="btn btn-primary" onclick="changeEmployee(document.getElementById('one'), '0');">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
</div>

<div class="ms-5" style="width:30%">
    <select class="form-select mb-3" id="one"  aria-label="Department List" multiple size="5">
        <?php
        // Loop through the stored employees array and display target = 1
        foreach ($employees as $row) {
            if ($row["target"] == 1) {
                echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
        }
        ?>
    </select>
</div>
