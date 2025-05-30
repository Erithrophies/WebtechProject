<?php
session_start();
include("../Model/userModel.php"); 

if ( isset($_POST['submit']) && $_SESSION['type'] === 'hr') {

    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) &&
        !empty($_POST['department']) && !empty($_POST['password'])) {

        $username = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dept = $_POST['department'];
        $password = $_POST['password'];

        if (addUserHr($username, $email, $phone ,$dept, $password)) {
            header("Location: ../View/HR_Employee.php?success=1");
            exit();
        } else {
            header("Location: ../View/AddEmployee.php?error=insert_failed");
            exit();
        }

    } else {
        header("Location: ../View/AddEmployee.php?error=missing_fields");
        exit();
    }

} else {
    
    header("Location: ../View/AddEmployee.php?error=unauthorized");
    exit();
}
