<?php
include("../Model/userModel.php"); 


if (isset($_POST['username'], $_POST['role'], $_POST['department'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $dept = $_POST['department'];
    $password = $_POST['password'];

    
    if (addUser($username, $role, $dept, $password)) {
        header("Location: ../View/RBA.php?success=1");
    } else {
        header("Location: ../View/RBA.php?error=insert_failed");
    }
} else {
    header("Location: ../View/RBA.php?error=missing_fields");
}
