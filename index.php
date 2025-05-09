<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Swap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        option {
            color: black;
        }
        select {
            outline: 1px solid black;
            -webkit-appearance: none;
            scrollbar-width: none;
        }
        select::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">

        <select id="department" class="form-select w-50 mb-3" aria-label="Default select example" onchange="changeDepartment(this.value);">
            <option value="HR" selected>HR</option>
            <option value="Development">Development</option>
            <option value="DM">Digital Marketing</option>
            <option value="CRM">CRM</option>
            <option value="Support">Support</option>
        </select>

        <div id="emplyoeeDiv" class="d-flex justify-content-center">
            <?php
            // Include the database connection file
            require_once 'conn.php';

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

            <div class="ms-5" style="width:50%">
                <select class="form-select mb-3" style="width: 100px;" id="one" aria-label="Department List" multiple size="5">
                    <?php
                    foreach ($employees as $row) {
                        if ($row["target"] == 1) {
                            echo '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div>
            <button class="btn btn-secondary" onclick="openAddEmployeeDiv(document.getElementById('department').value);">ADD</button>
            <button class="btn btn-info" onclick="openEmployeeList();">List</button>
        </div>
    </div>
    <div id="addEmployeeDiv" style="position: fixed; top: 35%; left: 50%; transform: translateX(-50%); border: 1px solid black; height: auto; width: 40%; background-color: white; padding: 20px; display: none;"></div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
