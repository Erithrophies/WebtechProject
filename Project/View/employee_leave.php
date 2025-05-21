<?php
    session_start();
    if (isset($_COOKIE['status'])){
      //$role = $_COOKIE['emp'];
      if (isset($_COOKIE['hr'])){
        header('Location: HR_dashboard.php');}
        if (isset($_COOKIE['mng'])){
        header('Location: manager_dashboard.php');}
        if (isset($_COOKIE['hr_d'])){
        header('Location: HR_document.php');}
        if (isset($_COOKIE['hr_emp'])){
        header('Location: HR_Employee.php');}
        if (isset($_COOKIE['hr_leave'])){
        header('Location: HR_leave.php');}
        if (isset($_COOKIE['hr_perfomance'])){
        header('Location: HR_perfomance.php');}
        if (isset($_COOKIE['mng_leave'])){
        header('Location: Leave_manager.php');}
        if (isset($_COOKIE['mng_doc'])){
        header('Location: mng_document');}
        if (isset($_COOKIE['mng_emp'])){
        header('Location: mng_employee.php');}
       if (isset($_COOKIE['emp'])){
       
        //header('Location: Employee_dashboard.php');
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Leave</title>
  <link rel="stylesheet" href="sidebar.css">
  <style>
    .main-content {
      margin-left: 270px;
      padding: 30px;
      color: black;
    }
    form {
      display: flex;
      flex-direction: column;
      max-width: 400px;
    }
    label, input, select, button {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  
  <?php include 'Emp_sidebar.html'; ?>

  <div class="main-content">
    <h2>Apply for Leave</h2>
    <form onsubmit="return validateEmployeeForm()">
      <label for="fromDate">From Date:</label>
      <input type="date" id="fromDate" name="fromDate" style="width: 300px;">

      <label for="toDate" style="margin-top: 20px;">To Date:</label>
      <input type="date" id="toDate" name="toDate"  style="width: 300px;">

      <label for="leaveType" style="margin-top: 20px;">Leave Type:</label>
      <select id="leaveType" name="leaveType"  style="width: 300px;">
        <option value="">--Select--</option>
        <option value="Casual">Casual</option>
        <option value="Sick">Sick</option>
        <option value="Earned">Earned</option>
      </select>

      <button type="submit" style="margin-top: 20px; height: 25px; background-color:#85876a; color:black">Submit</button>
    </form>
  </div>

  <script>
    function validateEmployeeForm() {
      var from = document.getElementById('fromDate').value;
      var to = document.getElementById('toDate').value;
      var type = document.getElementById('leaveType').value;

      if (from === '' || to === '' || type === '') {
        alert('Please fill out all fields.');
        return false;
      }

      if (from > to) {
        alert('From date cannot be after To date.');
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
<?php
     
  }
    }else{
        header('location: UserAuth.html');
    }
  

?>
