 <?php

 include("../Model/userModel.php");
 $employees = [];

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'hr') {
    header('location: UserAuth.php');
    exit();
}
else{

    $result = getAllEmployeesHr();
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
}
