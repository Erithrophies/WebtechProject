<?php
error_reporting(E_ALL);
//require_once('../Model/db.php');
require_once('../Model/userModel.php');
session_start(); 

if(isset($_POST['submit']) && isset($_SESSION['id']) && $_SESSION['type'] === 'manager'){
        $employee_username = trim($_POST['username']);
        $training_name = trim($_POST['training_name']);
       // $training_status = trim($_POST['training_status']);

        if($employee_username == "" || $training_name == ""){
            echo "null !";
        }else{

            $employee_id = getEmployeeIdByUsername($employee_username);

            if (!$employee_id) {
                echo "<p style='color:red;'>Employee not found.</p>";
                header('location: ../view/manager_dashboard.php');
            } else {
                $training_id = getTrainingIdByName($training_name);
                if (!$training_id) {
                    $training_id = createTraining($training_name);
                }

                $success = assignTraining($employee_id, $training_id, $_SESSION['id']);

                if ($success) {
                    echo "<div style='border:1px solid #ccc;padding:0px;margin-bottom:10px;border-radius:8px;background:#f9f9f9;box-shadow:0 2px 4px rgba(0,0,0,0.1);'>
                                <p><strong>Employee Name:</strong> $employee_username</p>
                                <p><strong>Training Title:</strong> $training_name</p>
                                <p><strong>Status:</strong> Training assigned successfully.</p>
                            </div>";
                    
                   // header('location: ../view/manager_dashboard.php');
                            
                } else {
                    echo "<p style='color:red;'>Failed to assign training.</p>";
                    
                    header('location: ../view/manager_dashboard.php');
                }

            }
        }
    }else{
         header('location: ../view/manager_dashboar.php?error=notsubmit');
    }





// if (!empty($assignedTrainings)) {
//     foreach ($assignedTrainings as $training) {
//         $output .= "<div style='border:1px solid #ccc;padding:10px;margin-bottom:10px;border-radius:8px;background:white;'>
//                         <p><strong>Employee:</strong> {$training['employee_name']}</p>
//                         <p><strong>Training:</strong> {$training['training_name']}</p>
//                         <p><strong>Assigned By:</strong> {$training['manager_name']}</p>
//                     </div>";
//     }
// }

//echo $output;
?>
