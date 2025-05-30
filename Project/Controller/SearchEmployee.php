<?php
//require_once("../Model/userModel.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode($_POST['json'], true);
    $keyword = trim($data['keyword']);

    if ($keyword === '') {
    
    echo "";  
    exit;
}

    include_once("../Model/userModel.php");

    $result = searchEmployees($keyword); 

    $employees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    if (!empty($employees)) {
    foreach ($employees as $emp) {
        echo "<div style='padding:5px; color:green;'>{$emp['username']} is in the employee directory (Dept: {$emp['dept_name']})</div>";
    }
} else {
    echo "<div style='padding:5px; color:red;'>No employee found by that name</div>";
}
}
?>
