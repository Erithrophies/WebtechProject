 <?php

 include_once("../Model/userModel.php");
 $employees = [];

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'manager') {
    header('location: UserAuth.php');
    exit();
}
else{

    $result = getAllEmployees();
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
}


 