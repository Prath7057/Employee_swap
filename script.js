function changeDepartment(department) {
  if (department != "") {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("emplyoeeDiv").innerHTML = xhttp.responseText;
      }
    };

    var params = "department=" + encodeURIComponent(department);
    xhttp.open("POST", "employees.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(params);
  }
}

function changeEmployee(selectElement, target) {
  var selectedOptions = selectElement.selectedOptions;
  var selectedIds = [];
  for (var i = 0; i < selectedOptions.length; i++) {
    selectedIds.push(selectedOptions[i].value);
  }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let department = document.getElementById("department").value;
      changeDepartment(department);
    }
  };

  var params =
    "selectedIds=" +
    encodeURIComponent(JSON.stringify(selectedIds)) +
    "&target=" +
    target;

  xhttp.open("POST", "changeEmployee.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
}

function openAddEmployeeDiv(department) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("addEmployeeDiv").style.display = "block";
      document.getElementById("addEmployeeDiv").innerHTML = xhttp.responseText;
      var select = document.getElementById("input-department");
      for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value == department) {
          select.selectedIndex = i;
          break;
        }
      }
      document.getElementById("name").focus();
    } else {
      document.getElementById("addEmployeeDiv").style.display = "none";
    }
  };
  var params = "department=" + encodeURIComponent(department);
  xhttp.open("POST", "addEmployee.php", true);
  xhttp.send(params);
}

function addEmployee() {
  let department = document.getElementById("input-department").value;
  let name = document.getElementById("name").value;
  let id = document.getElementById("id").value;
  if(name == '') {
    alert('Please Enter Name');
    document.getElementById("name").focus();
    return;
  }
  if(department == '') {
    alert('Please Select Department');
    document.getElementById("input-department").focus();
    return;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("addEmployeeDiv").style.display = "none";
      document.getElementById("addEmployeeDiv").innerHTML = "";
      var select = document.getElementById("department");
      for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value == department) {
          select.selectedIndex = i;
          break;
        }
      }
      changeDepartment(department);
    }
  };

  var params = "department=" + encodeURIComponent(department)  + "&name=" + name + "&id=" + id;
  xhttp.open("POST", "addEmployee.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
}

function openEmployeeList() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("addEmployeeDiv").style.display = "block";
          document.getElementById("addEmployeeDiv").innerHTML = xhttp.responseText;
          $('#example').DataTable({
            "pageLength": 5,
            "lengthChange": false
        });
      }
    };
  
    xhttp.open("GET", "employeesList.php", true);
    xhttp.send();
  }

  function employeeAction(id, action) {
    if(confirm('Do You Really Want To '+ action + " This Employee!")) {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (action == 'Edit') {
                    document.getElementById("addEmployeeDiv").style.display = "block";
                    document.getElementById("addEmployeeDiv").innerHTML = xhttp.responseText;
                    changeDepartment('HR');         

                } else {
                    openEmployeeList();
                }
            }
        };
        
        var params = "id=" + encodeURIComponent(id) + "&action=" + action ;
        xhttp.open("POST", "addEmployee.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(params);
    }
  }
