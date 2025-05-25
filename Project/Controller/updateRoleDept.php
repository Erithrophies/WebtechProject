<?php
include("../Model/usermodel.php"); 

$id = $_POST['id'];
$role = $_POST['role'];
$deptId = $_POST['department'];

updateUserRoleAndDepartment($id, $role, $deptId); 

header("Location: ../View/RBA.php");
exit;
