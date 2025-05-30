<?php
include("../Model/userModel.php");
//session_start();

   $assignedTrainings = [];

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'manager') {
    header('location: UserAuth.php');
    exit();
}
else{

 

    $result = getAllAssignedTrainings();
    while ($row = mysqli_fetch_assoc($result)) {
    $assignedTrainings[] = $row;
}

}



