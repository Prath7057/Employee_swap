<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments and Names</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <style>
        option {
            /* font-weight: 500; */
            color: black;

        }

        select {
            border: 1px solid black;
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
            include 'employees.php';
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        function changeDepartment(department) {
            if (department != '') {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
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
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let department = document.getElementById('department').value;
                    changeDepartment(department);
                }
            };

            var params = "selectedIds=" + encodeURIComponent(JSON.stringify(selectedIds)) + "&target=" + target;

            xhttp.open("POST", "changeEmployee.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(params);
        }
    </script>
</body>

</html>