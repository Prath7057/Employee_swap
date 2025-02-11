<?php
require_once 'conn.php';

if (isset($_POST['selectedIds']) && isset($_POST['target'])) {
    $selectedIds = json_decode($_POST['selectedIds']);
    $target = $_POST['target']; 

    foreach ($selectedIds as $id) {
        $sql = "UPDATE employee_department SET target = '$target' WHERE id = '$id'";
        $conn->query($sql);
    }

}

?>
