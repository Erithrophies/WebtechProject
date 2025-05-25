<?php

include_once("../Model/usermodel.php");

$departmentName = "";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $departmentName = getUserDepartmentById($id);
}
?>
