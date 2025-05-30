     <?php
    session_start();
    if (isset($_SESSION['type']) && $_SESSION['type'] === 'hr') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>HR Leave Page</title>
<style>
 
  *{ box-sizing: border-box; }
  
  html, body {
     height: 100%; 
     margin: 0; 
     padding: 0; 
     font-family: Arial, sans-serif; 
     background: rgb(249, 249, 249); 
     color: white; 
    }
  body { 
    display: flex; 
    min-height: 100vh; 
  }
 
  .content {
    margin-left: 270px; 
    padding: 20px;
    width: 100%;
    color: #333;
  }
  h1 { color: #444; }
  .section {
    background: white;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    color: black;
  }
  label, select, input, button {
    display: block;
    margin-top: 10px;
    font-size: 16px;
  }
  button {
    margin-top: 15px;
    padding: 8px 15px;
    cursor: pointer;
  }
  table {
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 10px;
  }
  th, td {
    border: 1px solid #ccc; 
    padding: 8px; 
    text-align: center;
  }
  th {
    background-color: #eee;
  }
</style>
</head>
<body>


<div class="sidebar.php">
  <div class="top-section">
    <h2>Workos</h2>
    <ul>
      <h3>Menu</h3>
      <li><a href="HR_Dashboard.php">Dashboard</a></li>
      <li><a href="HR_Employee.php">Employee</a></li>
      <li><a href="HR_performance.php">Reviews</a></li>
      <li><a href="HR_Document.php">Documents</a></li>
    </ul>

    <div class="department-header">
      <span>Department</span>
      <button>+</button>
    </div>
    <ul id="departmentList" class="department-list" style="display: block;">
      <li><div class="circle art"></div><a href="art&design.html">Art & Design</a></li>
      <li><div class="circle dev"></div><a href="development.html">Development</a></li>
    </ul>
  </div>

  <div class="bottom-section">
    <ul>
      <h3>Others</h3>
      <li><a href="settings.html">Settings</a></li>
      <li><a href="feedback.html">Feedbacks</a></li>
      <li><a href="../Controller/logout.php">Logout</a></li>
    </ul>
  </div>
</div>


<div class="content">
  <h1>HR Leave Management</h1>

  
  <div class="section">
    <h2>Leave Calendar</h2>
    <p>()</p>
    <table>
      <thead>
        <tr><th>Employee</th><th>Leave Dates</th><th>Type</th></tr>
      </thead>
      <tbody>
        <tr><td>Niloy Gomes</td><td>May 15-17</td><td>Annual</td></tr>
        <tr><td>Jeba Shajida</td><td>May 20</td><td>Sick</td></tr>
      </tbody>
    </table>
  </div>

  
  <div class="section">
    <h2>Leave Balance Tracker</h2>
    <table>
      <thead>
        <tr><th>Employee</th><th>Annual Leave</th><th>Sick Leave</th><th>Remaining Leave</th></tr>
      </thead>
      <tbody>
        <tr><td>Niloy Gomes</td><td>15</td><td>8</td><td>20</td></tr>
        <tr><td>Jeba Shajida</td><td>10</td><td>12</td><td>18</td></tr>
      </tbody>
    </table>
  </div>

  
  <div class="section">
    <h2>Leave Approval Status</h2>
    <form id="searchForm" onsubmit="return validateSearch()">
      <label for="empName">Search by Employee Name:</label>
      <input type="text" id="empName" name="empName" />
      <button type="submit">Search</button>
    </form>
    <p id="searchError" style="color: red;"></p>
    <div id="searchResult"></div>
  </div>
</div>

<script>
function validateSearch() {
  var input = document.getElementById('empName').value;
  var error = document.getElementById('searchError');
  error.innerHTML = '';

 
  var allSpaces = true;
  for(var i=0; i < input.length; i++) {
    if(input.charAt(i) !== ' ') {
      allSpaces = false;
      break;
    }
  }
  if(input === '' || allSpaces) {
    error.innerHTML = 'Please enter a valid employee name.';
    return false;
  }

 
  var result = document.getElementById('searchResult');
  result.innerHTML = 'Search executed for "' + input + '". (No real search functionality here)';
  return false; 
}
</script>

</body>
</html>
<?php
      }
  else{
        header('location: UserAuth.html');
    }

?>
