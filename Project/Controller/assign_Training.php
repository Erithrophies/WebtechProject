<?php

// session_start(); // Uncomment if session not already started
require_once('../Model/db.php');
require_once('../Model/userModel.php');

$output = "";


$assignedTrainings = getAllAssignedTrainings($_SESSION['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id']) && $_SESSION['type'] === 'manager') {
    $employee_username = $_POST['username'];
    $training_name = $_POST['training_name'];

    $employee_id = getEmployeeIdByUsername($employee_username);
    
    if (!$employee_id) {
        $output .= "<p style='color:red;'>Employee not found.</p>";
    } else {
        $training_id = getTrainingIdByName($training_name);
        if (!$training_id) {
            $training_id = createTraining($training_name);
        }

        $success = assignTraining($employee_id, $training_id, $_SESSION['id']);

        if ($success) {
            $output .= "<div style='border:1px solid #ccc;padding:0px;margin-bottom:10px;border-radius:8px;background:#f9f9f9;box-shadow:0 2px 4px rgba(0,0,0,0.1);'>
                        <p><strong>Employee Name:</strong> $employee_username</p>
                        <p><strong>Training Title:</strong> $training_name</p>
                        <p><strong>Status:</strong> Training assigned successfully.</p>
                      </div>";
        } else {
            $output .= "<p style='color:red;'>Failed to assign training.</p>";
        }
    }
}


if (!empty($assignedTrainings)) {
    foreach ($assignedTrainings as $training) {
        $output .= "<div style='border:1px solid #ccc;padding:10px;margin-bottom:10px;border-radius:8px;background:white;'>
                        <p><strong>Employee:</strong> {$training['employee_name']}</p>
                        <p><strong>Training:</strong> {$training['training_name']}</p>
                        <p><strong>Assigned By:</strong> {$training['manager_name']}</p>
                    </div>";
    }
}

//echo $output;
?>
