<?php 
require_once 'conn.php';
//
if (isset($_REQUEST['name'])) {
$department = $_REQUEST['department'];
$name = $_REQUEST['name'];
$target = '0';
//
echo $query = "INSERT INTO employee_department (name, department, target) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $name, $department, $target);
$stmt->execute();
//
} else { ?>
<div class="row" style="display: flex; flex-direction: column; align-items: center;">
    <h5 class="text-center">Add Employee Form</h5>
    <div class="col-md-6" style="width: 100%; display: flex; justify-content: center;">
        <div class="form-group" style="width: 100%; max-width: 400px;">
            <label id="name-label" for="name" style="padding-bottom: 5px;">Employee Firstname</label>
            <input type="text" name="name" id="name" placeholder="Enter Employee's Firstname" class="form-control" required>
        </div>
    </div>
    <div class="col-md-6" style="width: 100%; display: flex; justify-content: center; margin-top: 20px;">
        <div class="form-group" style="width: 100%; max-width: 400px;">
            <select id="input-department" class="form-select mb-3" aria-label="Default select example" required>
                <option value="" selected>Select Department</option>
                <option value="HR">HR</option>
                <option value="Development">Development</option>
                <option value="DM">Digital Marketing</option>
                <option value="CRM">CRM</option>
                <option value="Support">Support</option>
            </select>
        </div>
    </div>
    <div class="text-center">
        <button class="btn btn-success" onclick="addEmployee();">
            ADD
        </button>
        <button class="btn btn-secondary" onclick="document.getElementById('addEmployeeDiv').style.display='none';document.getElementById('addEmployeeDiv').innerHTML = '';">
            Close
        </button>
    </div>
</div>
<?php 
}
?>