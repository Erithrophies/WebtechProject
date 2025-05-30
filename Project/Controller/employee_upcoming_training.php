<?php
//session_start();
include_once( '../Model/userModel.php');


if (isset($_SESSION['id']) && $_SESSION['type'] === 'employee') {
    $employeeId = $_SESSION['id']; 
    $upcomingTrainingsCount = getEmployeeUpcomingTrainingsCount($employeeId);
}



?>
