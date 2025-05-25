<?php
session_start();
require_once('...Model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $newRole = $_POST['role'];

    if (updateUserRole($id, $newRole)) {
        header('Location: ../View/RBA.php');
        exit();
    } else {
        echo "Failed to update role.";
    }
}
?>
