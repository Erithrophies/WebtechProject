<?php
include("../Model/userModel.php");

$departments = [];
$employees = [];


$deptResult = getDepartments();
while ($row = mysqli_fetch_assoc($deptResult)) {
    $departments[] = $row;
}


$empResult = getAllEmployeesWithDepartments();
while ($row = mysqli_fetch_assoc($empResult)) {
    $employees[] = $row;
}


?>
