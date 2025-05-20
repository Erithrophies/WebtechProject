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
                setcookie('mng', 'true', time()+3000, '/');
                if(isset($_COOKIE['emp'])){
                    header('location: ../view/Employee_dashboard.php');
                }
                else if(isset($_COOKIE['mng'])){
                    header('location: ../view/mng_dashboard.php');
                }else
                {
                    header('location: ../view/HR_Dashboard.php');
                }
                

            }else{
                echo "<script>alert('Please give right credentials'); window.location.href='../view/UserAuth.html';</script>";
            }
        }
    } else {
        header('location: ../View/UserAuth.html');
    }
?>