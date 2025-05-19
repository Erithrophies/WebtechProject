<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>HR Leave Page</title>
<style>
  /* Sidebar styles: same as you gave */
  * { box-sizing: border-box; }
  html, body { height: 100%; margin: 0; padding: 0; font-family: Arial, sans-serif; background: rgb(249, 249, 249); color: white; }
  body { display: flex; min-height: 100vh; }
  .sidebar {
    width: 250px; background: #85876a; padding: 30px 20px; display: flex; flex-direction: column; justify-content: space-between;
    position: fixed; height: 100vh;
  }
  .sidebar .top-section { display: flex; flex-direction: column; align-items: center; }
  .sidebar h2 { margin-bottom: 30px; font-size: 24px; }
  .sidebar ul { list-style: none; padding: 0; width: 100%; }
  .sidebar ul h3 { margin: 20px 0 10px; font-size: 16px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 5px; }
  .sidebar ul li { margin: 10px 0; }
  .sidebar ul li a { color: white; text-decoration: none; padding: 8px 0; display: block; border-radius: 5px; transition: background 0.3s; }
  .sidebar ul li a:hover { background-color: rgba(255, 255, 255, 0.2); }
  .department-header {
    display: flex; justify-content: space-between; align-items: center; cursor: pointer; width: 100%; margin: 20px 0 10px;
    font-size: 16px; border-bottom: 1px solid rgba(255,255,255,0.3); padding-bottom: 5px;
  }
  .department-header button {
    background: none; border: none; color: white; font-size: 18px; cursor: pointer;
  }
  .department-list { list-style: none; padding: 0; margin: 0; width: 100%; }
  .department-list li { display: flex; align-items: center; gap: 10px; padding-left: 10px; margin: 10px 0; }
  .circle { width: 10px; height: 10px; border-radius: 50%; }
  .art { background-color: #f78fb3; }
  .dev { background-color: #70a1ff; }
  .bottom-section { margin-top: auto; }

  /* Page content styles */
  .content {
    margin-left: 270px; /* To avoid overlap with sidebar */
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
    width: 100%; border-collapse: collapse; margin-top: 10px;
  }
  th, td {
    border: 1px solid #ccc; padding: 8px; text-align: center;
  }
  th {
    background-color: #eee;
  }
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
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
      <button onclick="toggleDepartments()">+</button>
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

<!-- Main Content -->
<div class="content">
  <h1>HR Leave Management</h1>

  <!-- Leave Calendar placeholder -->
  <div class="section">
    <h2>Leave Calendar</h2>
    <p>(Calendar UI goes here — For demo, static example below)</p>
    <table>
      <thead>
        <tr><th>Employee</th><th>Leave Dates</th><th>Type</th></tr>
      </thead>
      <tbody>
        <tr><td>John Doe</td><td>May 15-17</td><td>Annual</td></tr>
        <tr><td>Jane Smith</td><td>May 20</td><td>Sick</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Leave Balance Tracker -->
  <div class="section">
    <h2>Leave Balance Tracker</h2>
    <table>
      <thead>
        <tr><th>Employee</th><th>Annual Leave</th><th>Sick Leave</th><th>Remaining Leave</th></tr>
      </thead>
      <tbody>
        <tr><td>John Doe</td><td>15</td><td>8</td><td>20</td></tr>
        <tr><td>Jane Smith</td><td>10</td><td>12</td><td>18</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Approval Status (filter/search with validation) -->
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
function toggleDepartments() {
  var deptList = document.getElementById('departmentList');
  if(deptList.style.display === 'block'){
    deptList.style.display = 'none';
  } else {
    deptList.style.display = 'block';
  }
}

function validateSearch() {
  var input = document.getElementById('empName').value;
  var error = document.getElementById('searchError');
  error.innerHTML = '';

  // Manual check for empty or spaces only input (no built-in trim)
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

  // For demo: display a simple message
  var result = document.getElementById('searchResult');
  result.innerHTML = 'Search executed for "' + input + '". (No real search functionality here)';
  return false; // prevent actual submission for demo
}
</script>

</body>
</html>
