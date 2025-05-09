// Function to change the department and update the employee list accordingly
function changeDepartment(department) {
  if (department != "") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // Update employee list container with new department employees
        document.getElementById("emplyoeeDiv").innerHTML = xhttp.responseText;
      }
    };

    // Send the selected department value to employees.php to fetch corresponding employees
    var params = "department=" + encodeURIComponent(department);
    xhttp.open("POST", "employees.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
  }
}

// Function to move selected employees from one list to another based on the target value (0 or 1)
function changeEmployee(selectElement, target) {
  var selectedOptions = selectElement.selectedOptions;
  var selectedIds = [];

  // Collect the selected employee IDs
  for (var i = 0; i < selectedOptions.length; i++) {
    selectedIds.push(selectedOptions[i].value);
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // After successfully updating, refresh the department employee list
      let department = document.getElementById("department").value;
      changeDepartment(department);
    }
  };

  // Prepare the data to be sent to changeEmployee.php
  var params =
    "selectedIds=" +
    encodeURIComponent(JSON.stringify(selectedIds)) +
    "&target=" +
    target;

  xhttp.open("POST", "changeEmployee.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
}

// Function to open the modal to add a new employee to the selected department
function openAddEmployeeDiv(department) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Display the modal and insert the returned HTML for adding an employee
      document.getElementById("addEmployeeDiv").style.display = "block";
      document.getElementById("addEmployeeDiv").innerHTML = xhttp.responseText;

      // Set the department dropdown to the selected department
      var select = document.getElementById("input-department");
      for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value == department) {
          select.selectedIndex = i;
          break;
        }
      }

      // Focus on the employee name input field
      document.getElementById("name").focus();
    } else {
      document.getElementById("addEmployeeDiv").style.display = "none";
    }
  };
  
  // Send department info to addEmployee.php for rendering the form
  var params = "department=" + encodeURIComponent(department);
  xhttp.open("POST", "addEmployee.php", true);
  xhttp.send(params);
}

// Function to add a new employee after validating input
function addEmployee() {
  let department = document.getElementById("input-department").value;
  let name = document.getElementById("name").value;
  let id = document.getElementById("id").value;

  // Validate if name and department are entered
  if (name == '') {
    alert('Please Enter Name');
    document.getElementById("name").focus();
    return;
  }
  if (department == '') {
    alert('Please Select Department');
    document.getElementById("input-department").focus();
    return;
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // After adding the employee, close the modal and refresh employee list for the department
      document.getElementById("addEmployeeDiv").style.display = "none";
      document.getElementById("addEmployeeDiv").innerHTML = "";

      // Reset the department dropdown to the newly added department
      var select = document.getElementById("department");
      for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value == department) {
          select.selectedIndex = i;
          break;
        }
      }

      // Reload the department employee list
      changeDepartment(department);
    }
  };

  // Send the form data to addEmployee.php for processing
  var params = "department=" + encodeURIComponent(department)  + "&name=" + name + "&id=" + id;
  xhttp.open("POST", "addEmployee.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
}

// Function to open the employee list modal with DataTable for viewing and managing employees
function openEmployeeList() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Display the employee list in a modal and initialize DataTable
      document.getElementById("addEmployeeDiv").style.display = "block";
      document.getElementById("addEmployeeDiv").innerHTML = xhttp.responseText;
      $('#example').DataTable({
        "pageLength": 5,
        "lengthChange": false
      });
    }
  };
  
  // Send GET request to fetch employee list from employeesList.php
  xhttp.open("GET", "employeesList.php", true);
  xhttp.send();
}

// Function to perform actions on individual employees (Edit or Delete)
function employeeAction(id, action) {
  if(confirm('Do You Really Want To '+ action + " This Employee!")) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // After action, either open the edit form or reload employee list
        if (action == 'Edit') {
          document.getElementById("addEmployeeDiv").style.display = "block";
          document.getElementById("addEmployeeDiv").innerHTML = xhttp.responseText;
          changeDepartment('HR'); // Refresh HR department's employee list
        } else {
          openEmployeeList(); // Refresh the employee list after deletion
        }
      }
    };

    // Send the action and employee ID to addEmployee.php for processing
    var params = "id=" + encodeURIComponent(id) + "&action=" + action ;
    xhttp.open("POST", "addEmployee.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
  }
}
