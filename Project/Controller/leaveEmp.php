<?php
session_start();
require_once('../Model/userModel.php');


if (isset($_POST['submit']) && isset($_SESSION['id']) && $_SESSION['type'] === 'employee') {
    // if (!isset($_SESSION['id'])) {
    //     echo "Unauthorized access.";
    // }

    $employee_id = $_SESSION['id'];
    $from_date = $_POST['fromDate'];
    $to_date = $_POST['toDate'];
    $leave_type = $_POST['leaveType'];


   
    if (empty($from_date) || empty($to_date) || empty($leave_type)) {
        echo "All fields are required.";
    }

    else if ($from_date > $to_date) {
        echo "From date cannot be after To date.";
    }

    else{
    $success = insertLeaveRequest($employee_id, $from_date, $to_date, $leave_type);

    if ($success) {
        header("Location: ../View/employee_leave.php?status=success");
    } else {
        header("Location: ../View/employee_leave.php?status=error");
    }
}
}else{
        header('location: ../view/UserAuth.html?error=notsubmit');
    }
