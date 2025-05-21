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
                    header('location: ../view/manager_dashboard.php');
                }
                // else if(isset($_COOKIE['emp_doc'])){
                //     header('location: ../view/emp_document.php');
                // }
                // else if(isset($_COOKIE['emp_emp'])){
                //     header('location: ../view/Emp_employee.php');
                // }
                // else if(isset($_COOKIE['emp_leave'])){
                //     header('location: ../view/employee_leave.php');
                // }
                // else if(isset($_COOKIE['hr_d'])){
                //     header('location: ../view/HR_Document.php');
                // }
                // else if(isset($_COOKIE['hr_emp'])){
                //     header('location: ../view/HR_Employee.php');
                // }
                // else if(isset($_COOKIE['hr_leave'])){
                //     header('location: ../view/HR_leave.php');
                // }
                // else if(isset($_COOKIE['hr_perfomance'])){
                //     header('location: ../view/HR_perfomance.php');
                // }
                // else if(isset($_COOKIE['mng_leave'])){
                //     header('location: ../view/Leave_manager.php');
                // }
                // else if(isset($_COOKIE['mng_doc'])){
                //     header('location: ../view/mng_document.php');
                // }
                // else if(isset($_COOKIE['mng_emp'])){
                //     header('location: ../view/mng_employee.php');
                // }
                else if(isset($_COOKIE['hr'])){
                    header('location: ../view/HR_Dashboard.php');
                }
                // else
                // {
                //     header('location: ../view/HR_Dashboard.php');
                // }
                

            }else{
                echo "<script>alert('Please give right credentials'); window.location.href='../view/UserAuth.html';</script>";
            }
        }
    } else {
        header('location: ../View/UserAuth.html');
    }
?>