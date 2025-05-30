<?php
//session_start();
include_once( '../Model/userModel.php');


if (isset($_SESSION['id']) && $_SESSION['type'] === 'employee' || $_SESSION['type'] === 'manager') {
//$employeeId = $_SESSION['id'];  
$emps = getTotalEmployeeOther();
}
?>