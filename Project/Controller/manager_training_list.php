<?php
session_start();
require_once('../Model/db.php');
require_once('../Model/userModel.php');


if (isset($_SESSION['id']) && $_SESSION['type'] === 'manager') {
   // $trainings = getManagerAssignedTrainings($_SESSION['id']);
    echo "<h2>Assigned Trainings</h2>";
    echo "<table border='1'><tr><th>Employee</th><th>Training</th><th>Date</th></tr>";
    foreach ($trainings as $t) {
        echo "<tr>
                <td>{$t['employee_name']}</td>
                <td>{$t['training_name']}</td>
                <td>{$t['training_date']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Unauthorized access.";
}
?>
