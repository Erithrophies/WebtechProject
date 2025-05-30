<?php
include("../Model/userModel.php");
//session_start();

   $assignedTrainings = [];

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'employee') {
    header('location: UserAuth.php');
    exit();
}
else{

    $employeeId = $_SESSION['id'];
    
    $result = getAssignedTrainingsForEmployee($employeeId);
    while ($row = mysqli_fetch_assoc($result)) {
    $assignedTrainings[] = $row;
}

}



