<?php
    error_reporting(E_ALL);

    require_once('../model/userModel.php');
    session_start();


    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $gender = trim($_POST['gender']);
        $dob = trim($_POST['dob']);
        $password = trim($_POST['password']);

        if($username == "" || $email == "" || $phone == "" || $address == "" || $gender == "" || $dob == "" || $password == ""){
            echo "null username/email/phone/address/gender/dob/password!";
        }else{
            $employee = ['username'=> $username,'email'=> $email, 'phone'=>$phone , 'address'=> $address, 'gender'=> $gender, 'dob'=> $dob, 'password'=> $password];
            $status = register($employee);
            if($status){
                echo "Registration Successful";
                header('location: ../view/UserAuth.html');
            }else{
                echo "Registration Failed";
                header('location: ../view/RegistrationPage.html');
            }
        }
    }else{
        header('location: ../view/UserAuth.html?error=notsubmit');
    }
?>