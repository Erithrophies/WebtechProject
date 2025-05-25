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
            return mysqli_fetch_assoc($result);
        }else{
            return false;
        }
    }

   function register($employee){
    $con = getConnection();
    
    $sql = "INSERT INTO employee (username, email, phone, address, gender, dob, password)
            VALUES ('{$employee['username']}', '{$employee['email']}', '{$employee['phone']}', '{$employee['address']}', '{$employee['gender']}', '{$employee['dob']}', '{$employee['password']}')";
    
     if (mysqli_query($con, $sql)) {
            return true;
        }else{
            return false;
        }        
}

function updateUserRole($id, $newRole) {
    $con = getConnection();

    $sql = "UPDATE employee SET type = '$newRole' WHERE id = $id";

    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}

function updateUserRoleAndDepartment($id, $role, $deptId) {
    $con = getConnection();

    
    $roleUpdate = "UPDATE employee SET type = '$role' WHERE id = $id";
    mysqli_query($con, $roleUpdate);

    
    $checkQuery = "SELECT * FROM employee_department WHERE employee_id = $id";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        
        $updateDept = "UPDATE employee_department SET dept_id = $deptId WHERE employee_id = $id";
        mysqli_query($con, $updateDept);
    } else {
        
        $joinDate = date("Y-m-d");
        $insertDept = "INSERT INTO employee_department (employee_id, dept_id, join_date) VALUES ($id, $deptId, '$joinDate')";
        mysqli_query($con, $insertDept);
    }
}


function getUserDepartmentById($id) {
    $con = getConnection();

    $sql = "
        SELECT d.dept_name 
        FROM employee e
        JOIN employee_department ed ON e.id = ed.employee_id
        JOIN departments d ON ed.dept_id = d.dept_id
        WHERE e.id = $id
        LIMIT 1
    ";

    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['dept_name'];
    }

    return null;
}



function addUser($username, $role, $dept ,$password) {
   
    $con = getConnection();
    
    $insertEmp = "INSERT INTO employee (username, type, password) VALUES ('$username','$role', $password)";
    $empResult = mysqli_query($con, $insertEmp);

    if ($empResult) {
        $emp_id = mysqli_insert_id($con);

       
        $insertDept = "INSERT INTO employee_department (employee_id, dept_id) VALUES ($emp_id, $dept)";
        mysqli_query($con, $insertDept);

        return true;
    }

    return false;
}


function deleteUserById($id) {

    $con = getConnection();

    if (!$id){
     return false;
    }

    
    $deleteFromDept = "DELETE FROM employee_department WHERE employee_id = $id";
    $deleteFromEmp = "DELETE FROM employee WHERE id = $id";

   
    $res1 = mysqli_query($con, $deleteFromDept);
    $res2 = mysqli_query($con, $deleteFromEmp);

    return $res1 && $res2;
}

function getEmployeeIdByUsername($username) {
    $con = getConnection();
    $username = mysqli_real_escape_string($con, $username); // prevent SQL injection

    $sql = "SELECT id FROM employee WHERE username = '$username' AND type = 'employee'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['id'];
    } else {    
        return false;
    }
}


function getTrainingIdByName($training_name) {
    $con = getConnection();
    $sql = "SELECT training_id FROM training_programs WHERE training_name = '$training_name'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 0) return null;
    $row = mysqli_fetch_assoc($result);
    return $row['training_id'];
}


function createTraining($training_name) {
    $con = getConnection();
    $sql = "INSERT INTO training_programs (training_name) VALUES ('$training_name')";
    if (mysqli_query($con, $sql)) {
        return mysqli_insert_id($con);
    } else {
        return null;
    }
}


function assignTraining($employee_id, $training_id, $manager_id) {
    $con = getConnection();
    $sql = "INSERT INTO employee_training (employee_id, training_id, assigned_by)
            VALUES ($employee_id, $training_id, $manager_id)";
    if (mysqli_query($con, $sql)) {
        return true;
    } else {
        return false;
    }
}


function getManagerAssignedTrainings($manager_id) {
    $con = getConnection();
    $sql = "
        SELECT et.*, e.username AS employee_name, tp.training_name 
        FROM employee_training et
        JOIN employee e ON et.employee_id = e.id
        JOIN training_programs tp ON et.training_id = tp.training_id
        WHERE et.assigned_by = $manager_id
        ORDER BY et.training_date ASC
    ";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


function getEmployeeUpcomingTrainings($employee_id) {
    $con = getConnection();
    $today = date("Y-m-d");

    $sql = "
        SELECT et.training_date, tp.training_name, m.username AS manager_name
        FROM employee_training et
        JOIN training_programs tp ON et.training_id = tp.training_id
        JOIN employee m ON et.assigned_by = m.id
        WHERE et.employee_id = $employee_id AND et.training_date >= '$today'
        ORDER BY et.training_date ASC
    ";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getAllAssignedTrainings($manager_id) {
    $con = getConnection();
    $manager_id = intval($manager_id);

    $sql = "SELECT e.username AS employee_name, tp.training_name AS training_name, m.username AS manager_name
            FROM employee_training et
            JOIN employee e ON et.employee_id = e.id
            JOIN training_programs tp ON et.training_id = tp.training_id
            JOIN employee m ON et.assigned_by = m.id
            WHERE et.assigned_by = $manager_id
            ORDER BY et.training_date DESC";

    $result = mysqli_query($con, $sql);
    //$row = [];

    if ($result && mysqli_num_rows($result) > 0) {
        $row[] = mysqli_fetch_assoc($result);  
    }

    return $row;
}

function getEmployeeUpcomingTrainingsCount($employee_id) {
    $con = getConnection();
    $today = date("Y-m-d");
    $sql = "SELECT COUNT(*) AS total FROM employee_training et
            JOIN training_programs tp ON et.training_id = tp.training_id
            WHERE et.employee_id = $employee_id ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];  
    } else {
        return 0; 
    }
}














    

    // function getUserById($id){

    // }

    // function addUser($user){

    // }

    // function deleteUser($id){

    // }

?> 