<?php
session_start();

if (isset($_SESSION['type']) && $_SESSION['type'] === 'employee') {
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Leave</title>
  
  <style>
     * { box-sizing: border-box; }
    html, body {
      height: 100%; 
      margin: 0;
      padding: 0;
    }
 body {
      min-height: 100vh;
      display: flex;
      font-family: Arial, sans-serif;
      background-color: rgb(249, 249, 249);
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      color: white;
    }

.container {
  display: flex;
  width: 100%;
  min-height: 100vh;
}

.main-content {
  flex: 1;
  padding: 30px;
  margin-left: 250px; 
  color: #1c1f1c;
}


  form {
    display: flex;
    flex-direction: column;
    max-width: 400px;
  }

  label, input, select, button {
    margin-bottom: 0px;
  }
</style>

</head>
<body>
  <div class="container">
  <?php include 'Emp_sidebar.php'; ?>

  <div class="main-content">
    <h2>Apply for Leave</h2>
    <form action="../Controller/leaveEmp.php" method="POST" onsubmit="return validateEmployeeForm()">
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

      <button type="submit" name = "submit" style="margin-top: 20px; height: 30px;width:90px; background-color:#85876a; color:white; border:0px; font-size:13px">Submit</button>
    </form>
  </div>
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
} else {
  
  header("Location: UserAuth.html");
  exit();
}
?>