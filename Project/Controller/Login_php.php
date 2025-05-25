<?php
error_reporting(E_ALL);
require_once('../model/userModel.php');
session_start();

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if($username == "" || $password == ""){
        echo "<p style='color:red;'>Null username/password!</p>";
    } else {
        $employee = ['username'=> $username, 'password'=>$password];
        $status = login($employee); 

        if($status){ 
            setcookie('status', 'true', time()+3000, '/');

           
            $_SESSION['id'] = $status['id'];
            $_SESSION['username'] = $status['username'];
            $_SESSION['type'] = $status['type'];

           
            setcookie($status['type'], 'true', time()+3000, '/');

            
            if($status['type'] == 'employee'){
                header('location: ../view/Employee_dashboard.php');
            } else if($status['type'] == 'manager'){
                header('location: ../view/manager_dashboard.php');
            } else if($status['type'] == 'hr'){
                header('location: ../view/HR_Dashboard.php');
            } else if($status['type'] == 'admin'){
                header('location: ../view/admin_dashboard.php');
            } else {
                echo "<script>alert('Unknown role!'); window.location.href='../view/UserAuth.html';</script>";
            }

        } else {
            echo "<script>alert('Please give right credentials'); window.location.href='../view/UserAuth.html';</script>";
        }
    }
} else {
    header('location: ../View/UserAuth.html');
}
?>
