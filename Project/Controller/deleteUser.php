<?php
include("../Model/userModel.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    deleteUserById($id);
}

header("Location: ../View/RBA.php");
exit;
