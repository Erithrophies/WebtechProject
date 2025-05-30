<?php
//session_start();
include_once( '../Model/userModel.php');


if (isset($_SESSION['id']) && $_SESSION['type'] === 'hr') {
//$employeeId = $_SESSION['id'];  
$emps = getTotalEmployee();
}
?>