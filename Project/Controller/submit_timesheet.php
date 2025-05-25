<?php
require_once('../../Model/db.php');
$con = getConnection();


session_start();
$employee_id = isset($_SESSION['employee_id']) ? $_SESSION['employee_id'] : 1; 

$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    for ($i = 0; $i < 7; $i++) {
        $date = isset($_POST['date'][$i]) ? $_POST['date'][$i] : null;
        $clock_in = isset($_POST['clock_in'][$i]) ? $_POST['clock_in'][$i] : null;
        $clock_out = isset($_POST['clock_out'][$i]) ? $_POST['clock_out'][$i] : null;
        $project = isset($_POST['project'][$i]) ? $_POST['project'][$i] : null;
        $notes = isset($_POST['notes'][$i]) ? $_POST['notes'][$i] : null;

       
        $total_hours = null;
        if ($clock_in && $clock_out) {
            $in = strtotime($clock_in);
            $out = strtotime($clock_out);
            if ($out > $in) {
                $total_hours = round(($out - $in) / 3600, 2);
            }
        }

        
        if ($date && $clock_in && $clock_out) {
            $sql = "INSERT INTO timesheet (employee_id, day, date, clock_in, clock_out, total_hours, project, notes) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param(
                "issssdss",
                $employee_id,
                $days[$i],
                $date,
                $clock_in,
                $clock_out,
                $total_hours,
                $project,
                $notes
            );
            $stmt->execute();
        }
    }
    echo "<script>alert('Timesheet submitted successfully!');window.location.href='timesheet.html';</script>";
    exit();
} else {
    echo "Invalid request.";
}
?>