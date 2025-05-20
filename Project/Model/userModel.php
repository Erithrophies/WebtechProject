<?php
    error_reporting(E_ALL);
    //include('db.php');
    include_once('db.php');
    //require('db.php');
    require_once('db.php');

    function login($employee){
        $con = getConnection();
        $sql = "select * from employee where username='{$employee['username']}' and password='{$employee['password']}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count == 1){
            return true;
        }else{
            return false;
        }
    }

    function register($employee){
        $con = getConnection();
        
        $sql = "insert into employee values(null ,'{$employee['username']}','{$employee['email']}', '{$employee['phone']}', '{$employee['address']}', '{$employee['gender']}', '{$employee['dob']}', '{$employee['password']}')";
        //echo $sql;
        
        if (mysqli_query($con, $sql)) {
            return true;
        }else{
            return false;
        }        
    }

    

    // function getUserById($id){

    // }

    // function addUser($user){

    // }

    // function deleteUser($id){

    // }

?> 