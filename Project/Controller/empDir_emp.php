 <?php

 include("../Model/userModel.php");
 $employees = [];

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'employee') {
    header('location: UserAuth.php');
    exit();
}
else{

    $result = getAllEmployees();
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
}


 