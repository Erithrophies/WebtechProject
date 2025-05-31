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
        
        $sql = "UPDATE employee_department SET dept_id = $deptId WHERE employee_id = $id";
        mysqli_query($con, $sql);
    } else {
        
        $joinDate = date("Y-m-d");
        $sql = "INSERT INTO employee_department (employee_id, dept_id, join_date) VALUES ($id, $deptId, '$joinDate')";
        mysqli_query($con, $sql);
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

function addUserHr($username, $email, $phone ,$dept, $password) {
   
    $con = getConnection();
    
    $insertEmp = "INSERT INTO employee (username, email, phone, password) VALUES ('$username','$email', '$phone' ,'$password')";
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
    $username = mysqli_real_escape_string($con, $username); 

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

function getAllAssignedTrainings() {
    $con = getConnection();
    $sql = "SELECT e.username AS employee_name, 
            tp.training_name AS training_name
            FROM employee_training et
            JOIN employee e ON et.employee_id = e.id
            JOIN training_programs tp ON et.training_id = tp.training_id;";
     //mysqli_query($con, $sql);

     return mysqli_query($con, $sql);
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

function getPendingApprovals($employeeId) {
    $con = getConnection();
    $sql = "SELECT COUNT(*) as total FROM employee_leave WHERE employee_id = $employeeId AND status = 'Pending'";
    $result = mysqli_query($con, $sql);

     if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];  
    } else {
        return 0; 
    }
}

function getTotalEmployee() {
    $con = getConnection();
    $sql = "SELECT COUNT(*) as total FROM employee";
    $result = mysqli_query($con, $sql);
    
     if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];  
    } else {
        return 0; 
    }
}

function getTotalEmployeeOther() {
    $con = getConnection();
    $sql = "SELECT COUNT(*) AS total 
            FROM employee 
            WHERE type = 'employee';
  ";
    $result = mysqli_query($con, $sql);
    
     if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];  
    } else {
        return 0; 
    }
}


function getAssignedTrainingsForEmployee($employeeId) {
    $con = getConnection(); 

    $sql = "SELECT tp.training_name, m.username AS manager_name
            FROM employee_training et
            JOIN training_programs tp ON et.training_id = tp.training_id
            JOIN employee m ON et.assigned_by = m.id
            WHERE et.employee_id = $employeeId";

    return mysqli_query($con, $sql);

    
}


function getDepartments() {
    global $con;
    $query = "SELECT dept_id, dept_name FROM departments";
    return mysqli_query($con, $query);
}


function getAllEmployeesWithDepartments() {
    global $con;
    $query = "
        SELECT e.id, e.username, e.type, d.dept_id, d.dept_name
        FROM employee e
        LEFT JOIN employee_department ed ON e.id = ed.employee_id
        LEFT JOIN departments d ON ed.dept_id = d.dept_id
    ";
    return mysqli_query($con, $query);
}

function insertLeaveRequest($employee_id, $from_date, $to_date, $leave_type) {
    $con = getConnection();

    $sql = "INSERT INTO employee_leave (employee_id, from_date, to_date, leave_type) 
            VALUES ('$employee_id', '$from_date', '$to_date', '$leave_type')";

    if (mysqli_query($con, $sql)) {
            return true;
        }else{
            return false;
        }    
}

    function getAllLeaveRequests() {
    $con = getConnection();

    $sql = "SELECT el.id, e.username AS employee_name, el.from_date, el.to_date, el.leave_type, el.status, el.manager_comment
            FROM employee_leave el
            JOIN employee e ON el.employee_id = e.id";

    return mysqli_query($con, $sql);
}

    function updateLeaveStatus($leave_id, $status, $comment) {
    $con = getConnection();
    $sql = "UPDATE employee_leave 
            SET status = '$status', manager_comment = '$comment' 
            WHERE id = $leave_id";

    return mysqli_query($con, $sql);
}

function getAllEmployees() {
        $con = getConnection();
        $sql = "SELECT e.id, e.username, d.dept_name AS department, d.color_code
                FROM employee e
                LEFT JOIN employee_department ed ON ed.employee_id = e.id
                LEFT JOIN departments d ON d.dept_id = ed.dept_id
                WHERE e.type = 'employee'
                ";
        return mysqli_query($con, $sql);

    }


  function getAllEmployeesHr() {
        $con = getConnection();
        $sql = "SELECT e.id, e.username, d.dept_name AS department, d.color_code
                FROM employee e
                LEFT JOIN employee_department ed ON ed.employee_id = e.id
                LEFT JOIN departments d ON d.dept_id = ed.dept_id
                ";
        return mysqli_query($con, $sql);

    }  


    function addPerformanceReview($title, $date, $created_by) {
    $con = getConnection();
    $sql = "INSERT INTO performance_reviews (review_title, review_date, created_by) VALUES ('$title', '$date', $created_by)";
    return mysqli_query($con, $sql);
}

function getAllPerformanceReviews() {
    $con = getConnection();
    $sql = "SELECT pr.review_title, pr.review_date, e.username AS created_by 
            FROM performance_reviews pr
            JOIN employee e ON pr.created_by = e.id
            ORDER BY pr.review_date ASC";
    return mysqli_query($con, $sql);
}

function getAllHRGoals() {
    $con = getConnection();
    $sql = "SELECT goal_id, goal_title, status FROM hr_goals ORDER BY created_at DESC";
    return mysqli_query($con, $sql);
}

function addHRGoal($goal_title) {
    $con = getConnection();
    $sql = "INSERT INTO hr_goals (goal_title) VALUES ('$goal_title')";
    return mysqli_query($con, $sql);
}

function updateHRGoalStatus($goal_id, $status) {
    $con = getConnection();
    $status = ($status === 'Completed') ? 'Completed' : 'Pending';
    $sql = "UPDATE hr_goals SET status='$status' WHERE goal_id=$goal_id";
    return mysqli_query($con, $sql);
}

function searchEmployees($keyword)
{
    $con = getConnection();

    $sql = "SELECT e.username, e.email, d.dept_name
        FROM employee e
        JOIN employee_department ed ON e.id = ed.employee_id
        JOIN departments d ON ed.dept_id = d.dept_id
        WHERE e.username LIKE '%$keyword%' OR d.dept_name LIKE '%$keyword%'";
    return mysqli_query($con, $sql);
}


    












    

    // function getUserById($id){

    // }

    // function addUser($user){

    // }

    // function deleteUser($id){

    // }

?> 