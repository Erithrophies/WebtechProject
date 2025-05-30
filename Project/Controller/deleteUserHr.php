<?php
session_start();
include("../Model/userModel.php");

if ( isset($_POST['submit']) && $_SESSION['type'] === 'hr') {

        $id = $_POST['id'];
        if (deleteUserById($id)) {
            header("Location: ../View/HR_Employee.php");
            exit();
        } else {
            header("Location: ../View/HR_Employee.php");
            exit();
        }

    } else {
        header("Location: ../View/HR_Employee.php");
        exit();
    }





