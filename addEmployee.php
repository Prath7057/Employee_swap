<?php
require_once 'conn.php';
//
if (isset($_REQUEST['name'])) {  
    //  
    $department = $_REQUEST['department'];
    $name = $_REQUEST['name'];
    //
    if (isset($_REQUEST['id']) &&  $_REQUEST['id'] != '') {
        //
        $id = $_REQUEST['id'];
        //
        $query = "UPDATE employee_department SET name = ?, department = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $department, $id);
        $stmt->execute();
        return;
        //
    } else {
        $target = '0';
        //
        $query = "INSERT INTO employee_department (name, department, target) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $department, $target);
        $stmt->execute();
    }
    
    //
} else {
    $id = '';
    $name = '';
    $department = '';
    if (isset($_REQUEST['id'])) {
        if ($_REQUEST['action'] == 'Edit') {
            //
            $sql = "SELECT * FROM employee_department WHERE id = '$_REQUEST[id]';";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            //
            $id = $row['id'];
            $name = $row['name'];
            $department = $row['department'];
        } else if ($_REQUEST['action'] == 'Delete') {
            $sql = "DELETE FROM employee_department WHERE id = '$_REQUEST[id]';";
            $result = $conn->query($sql);
            return;
        }
    }
?>
    <div class="row" style="display: flex; flex-direction: column; align-items: center;">
        <h5 class="text-center">Add Employee Form</h5>
        <div class="col-md-6" style="width: 100%; display: flex; justify-content: center;">
            <div class="form-group" style="width: 100%; max-width: 400px;">
                <label id="name-label" for="name" style="padding-bottom: 5px;">Employee Firstname</label>
                <input type="text" name="name" id="name" placeholder="Enter Employee's Firstname" class="form-control" value="<?php echo $name;?>" required>
            </div>
        </div>
        <div class="col-md-6" style="width: 100%; display: flex; justify-content: center; margin-top: 20px;">
            <div class="form-group" style="width: 100%; max-width: 400px;">
                <select id="input-department" class="form-select mb-3" aria-label="Default select example" required>
                    <option value="" <?php if ($id == '') {echo 'selected';}?>>Select Department</option>
                    <option value="HR" <?php echo $department == 'HR' ? 'Selected' : ''; ?>>HR</option>
                    <option value="Development" <?php echo $department == 'Development' ? 'Selected' : ''; ?>>Development</option>
                    <option value="DM" <?php echo $department == 'DM' ? 'Selected' : ''; ?>>Digital Marketing</option>
                    <option value="CRM" <?php echo $department == 'CRM' ? 'Selected' : ''; ?>>CRM</option>
                    <option value="Support" <?php echo $department == 'Support' ? 'Selected' : ''; ?>>Support</option>
                </select>
            </div>
        </div>
        <input type="hidden" id='id' name="id" value="<?php echo $id;?>" />
        <div class="text-center">
            <button class="btn btn-success" onclick="addEmployee();">
            <?php echo $id != '' ? 'Update' : 'Add'; ?>
            </button>
            <button class="btn btn-secondary" onclick="document.getElementById('addEmployeeDiv').style.display='none';document.getElementById('addEmployeeDiv').innerHTML = '';">
                Close
            </button>
        </div>
    </div>
<?php
}
?>
