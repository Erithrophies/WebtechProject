<?php
include("../Model/userModel.php");
//session_start();

   $assignedTrainings = [];
   $employeeId = $_SESSION['id'];

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'employee') {
    header('location: UserAuth.php');
    exit();
}
else{
    $result = getAssignedTrainingsForEmployee($employeeId);
    while ($row = mysqli_fetch_assoc($result)) {
    $assignedTrainings[] = $row;
}

}



