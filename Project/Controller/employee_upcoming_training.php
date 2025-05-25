<?php
session_start();
require_once('../Model/db.php');
require_once('../Model/userModel.php');

// Employee dashboard: show upcoming trainings
if (isset($_SESSION['id']) && $_SESSION['type'] === 'employee') {
    $trainings = getEmployeeUpcomingTrainings($_SESSION['id']);

    echo "<h2>Upcoming Trainings</h2>";
    echo "<p>Total: " . count($trainings) . "</p>";
    echo "<table border='1'><tr><th>Training Name</th><th>Date</th><th>Assigned By (Manager)</th></tr>";

    foreach ($trainings as $t) {
        echo "<tr>
                <td>{$t['training_name']}</td>
                <td>{$t['training_date']}</td>
                <td>{$t['manager_name']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Unauthorized access.";
}
?>
