<?php
include("../Model/userModel.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['leave_id'], $_POST['manager_comment'], $_POST['action'])) {
    $leave_id = $_POST['leave_id'];
    $comment = $_POST['manager_comment'];
    $status = $_POST['action']; 

    updateLeaveStatus($leave_id, $status, $comment);
    header("Location: ../View/Leave_manager.php");
    exit();
}

   $leaveRequests = [];

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'manager') {
    header('location: UserAuth.php');
    exit();
}
else{

 

    $result = getAllLeaveRequests();
    while ($row = mysqli_fetch_assoc($result)) {
    $leaveRequests[] = $row;
}

}



