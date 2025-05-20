<?php
    session_start();
    if (isset($_COOKIE['status'])){
      //$role = $_COOKIE['emp'];
      if (isset($_COOKIE['emp'])){
       
        header('Location: Employee_dashboard.php');}
       if (isset($_COOKIE['hr'])){
       
        header('Location: HR_Dashboard.php');}  
      if (isset($_COOKIE['mng'])){
       
       // header('Location: HR_dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manager Dashboard</title>
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

    .sidebar {
      width: 250px;
      background: #85876a;
      padding: 40px 24px 30px 24px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: fixed;
      height: 100vh;
      color: white;
      box-shadow: 2px 0 12px rgba(133, 135, 106, 0.12);

    }
    .sidebar .top-section {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .sidebar h2 {
      margin-bottom: 32px;
      font-size: 26px;
      letter-spacing: 1px;
      font-weight: 700;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
      width: 100%;
    }
    .sidebar ul h3 {
      margin: 20px 0 10px;
      font-size: 16px;
      border-bottom: 1px solid rgba(255,255,255,0.3);
      padding-bottom: 5px;
    }
    .sidebar ul li {
      margin: 12px 0;
    }
    .sidebar ul li a {
      color: white;
      text-decoration: none;
      padding: 10px 16px;
      display: block;
      border-radius: 8px;
      transition: background 0.2s, transform 0.2s;
      font-size: 15px;
      font-weight: 500;
    }
    .sidebar ul li a:hover {
      background-color: rgba(255, 255, 255, 0.18);
      transform: translateX(6px);
    }

    .main {
      margin-left: 250px;
      padding: 40px 40px 30px 40px;
      flex-grow: 1;
      color: #1c1f1c;
      min-height: 100vh;
    }

    .topbar {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-bottom: 36px;
      gap: 24px;
      color: black;
    }
    .topbar .notification {
      font-size: 22px;
      cursor: pointer;
      background-color: rgba(0, 0, 0, 0.08);
      padding: 12px;
      border-radius: 50%;
      transition: background 0.2s, box-shadow 0.2s;
      color: #1c1f1c;
      box-shadow: 0 2px 6px rgba(133, 135, 106, 0.08);
    }
    .topbar .notification:hover {
      background-color: rgba(0, 0, 0, 0.18);
      box-shadow: 0 4px 12px rgba(133, 135, 106, 0.13);
    }
    .topbar .profile-btn img {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      cursor: pointer;
      object-fit: cover;
      border: 2px solid #1c1f1c;
      box-shadow: 0 2px 6px rgba(133, 135, 106, 0.10);
      transition: border 0.2s;
    }
    .topbar .profile-btn img:hover {
      border: 2px solid #85876a;
    }

    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 28px;
      margin-bottom: 36px;
    }

    .card {
      background: rgba(177, 178, 167, 0.72);
      margin-bottom: 20px;
      padding: 32px 28px;
      border-radius: 18px;
      font-size: 15px;
      color: #454d42;
      transition: all 0.2s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(133, 135, 106, 0.13);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 90px;
    }

    .card:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 8px 24px rgba(133, 135, 106, 0.18);
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background: #85876a;
      border-top-left-radius: 18px;
      border-bottom-left-radius: 18px;
    }

    .highlight {
      font-weight: bold;
      color: #2749bc;
      display: inline-block;
      margin: 5px;
      position: relative;
      letter-spacing: 0.5px;
    }

    .highlight::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background: #2749bc;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .card:hover .highlight::after {
      transform: scaleX(1);
    }

    .card span:first-child {
      font-size: 22px;
      margin-right: 12px;
      vertical-align: middle;
    }

    .card span:last-child {
      font-size: 16px;
      font-weight: 500;
      color: #454d42;
      float: right;
    }

    form {
      all: unset;
      display: contents;
    }

    #searchBar {
      width: 100%;
      padding: 12px 18px;
      margin-bottom: 6px;
      border-radius: 22px;
      border: none;
      font-size: 14px;
      background-color: #ddd;
      color: black;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.08);
      transition: box-shadow 0.2s;
    }
    #searchBar:focus {
      outline: 2px solid #85876a;
      box-shadow: 0 4px 16px rgba(133, 135, 106, 0.15);
    }

    /* Team Assign Section */
    #assignTeamForm {
      display: flex;
      gap: 14px;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 24px;
    }
    #assignTeamForm select, #assignTeamForm button {
      flex: 1;
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 15px;
      transition: border 0.2s, box-shadow 0.2s;
    }
    #assignTeamForm select:focus {
      border: 1.5px solid #85876a;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.10);
      outline: none;
    }
    #assignTeamForm button {
      background-color: #85876a;
      color: white;
      border: none;
      cursor: pointer;
      flex: unset;
      min-width: 110px;
      transition: background-color 0.2s, box-shadow 0.2s;
      font-weight: 600;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.10);
    }
    #assignTeamForm button:hover {
      background-color: #6f735a;
      box-shadow: 0 4px 16px rgba(133, 135, 106, 0.15);
    }

    #teamAssignments {
      list-style: none;
      padding-left: 0;
      max-height: 160px;
      overflow-y: auto;
      font-size: 15px;
      color: #454d42;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 12px;
      background: #f5f5f5;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.08);
      margin-bottom: 24px;
    }

    /* Employee Directory */
    #employeeSearch {
      width: 100%;
      padding: 12px 18px;
      border-radius: 18px;
      border: 1px solid #ccc;
      margin-bottom: 18px;
      max-width: 600px;
      font-size: 15px;
      color: black;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.08);
      transition: border 0.2s, box-shadow 0.2s;
    }
    #employeeSearch:focus {
      border: 1.5px solid #85876a;
      box-shadow: 0 4px 16px rgba(133, 135, 106, 0.13);
      outline: none;
    }

    #employeeList {
      list-style: none;
      padding-left: 0;
      max-width: 600px;
      font-size: 15px;
      color: #454d42;
      border: 1px solid #ccc;
      border-radius: 10px;
      max-height: 220px;
      overflow-y: auto;
      background: #f5f5f5;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.08);
      margin-bottom: 24px;
    }

    #employeeList li {
      padding: 10px 16px;
      border-bottom: 1px solid #ddd;
      cursor: default;
      transition: background 0.2s;
      border-radius: 6px;
    }
    #employeeList li:last-child {
      border-bottom: none;
    }
    #employeeList li:hover {
      background: #e5e5e5;
    }

    /* Table Styling */
    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 600px;
      margin-top: 18px;
      color: #454d42;
      background: #f5f5f5;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.08);
      overflow: hidden;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px 14px;
      text-align: left;
    }
    th {
      background: #e5e5e5;
      font-weight: 700;
      font-size: 15px;
    }
    tr {
      transition: background 0.2s;
    }
    tr:hover {
      background: #e5e5e5;
    }

    .directory-summary-row {
      display: flex;
      gap: 32px;
      margin-top: 18px;
      flex-wrap: wrap;
      align-items: flex-start;
    }
    .employee-directory-col {
      flex: 1 1 320px;
      min-width: 260px;
      max-width: 600px;
    }
    .summary-table-col {
      flex: 1 1 320px;
      min-width: 260px;
      max-width: 600px;
    }
    @media (max-width: 1100px) {
      .directory-summary-row {
        flex-direction: column;
        gap: 18px;
      }
      .employee-directory-col, .summary-table-col {
        max-width: 100%;
      }
    }
    
    /* Style for error messages */
    .error-message {
      color: red;
      font-size: 12px;
      display: block;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <?php include 'mng_sidebar.html'; ?>

  <div class="main">
    
    <div class="topbar">
      <input type="text" id="searchBar" placeholder="Search employees...">
      <div class="notification" title="Notifications">🔔</div>
      <div class="profile-btn" title="Profile">
        <img src="manager-profile.jpg" alt="Profile" />
      </div>
    </div>
    
    <h1>Overview</h1>

    <div class="dashboard-grid">
      <div class="card">👥 <span class="highlight">Total Employees:</span> 120</div>
      <div class="card">🌿 <span class="highlight">Active Leaves:</span> 8</div>
      <div class="card">📝 <span class="highlight">Documents Expiring Soon:</span> 3</div>
    </div>
    
    <section id="training-program" style="margin-top:20px;">
      <h3>Training Program Assignment</h3>
      <form id="trainingForm">
        <label for="empNameTrain">Employee:</label>
        <input type="text" id="empNameTrain" placeholder="Enter employee name">
        
        <label for="trainingTitle">Training Title:</label>
        <input type="text" id="trainingTitle" placeholder="Enter training program">
        
        <label for="trainingStatus">Status:</label>
        <select id="trainingStatus">
          <option>Not started</option>
          <option>In progress</option>
          <option>Completed</option>
        </select>
        
        <button type="submit">Assign Training</button>
      </form>
      
      <div id="trainingList" style="margin-top:10px;">
        <!-- Assigned trainings will show here -->
      </div>
    </section>
    
    <h2>Assign Teams</h2>
    <form id="assignTeamForm" autocomplete="off" aria-label="Assign team to employee">
      <select id="employeeSelect" aria-label="Select employee">
        <option value="" disabled selected>Select Employee</option>
        <option value="John Doe">John Doe</option>
        <option value="Jane Smith">Jane Smith</option>
        <option value="Mike Johnson">Mike Johnson</option>
      </select>

      <select id="teamSelect" aria-label="Select team">
        <option value="" disabled selected>Select Team</option>
        <option value="Sales">Sales</option>
        <option value="Marketing">Marketing</option>
        <option value="Development">Development</option>
      </select>

      <button type="submit">Assign</button>
    </form>

    <ul id="teamAssignments" aria-live="polite" aria-label="Team assignments list"></ul>

    <h2>Employee Directory</h2>
    <div class="directory-summary-row">
      <div class="employee-directory-col">
        <input type="text" id="employeeSearch" placeholder="Search employees by name..." aria-label="Search employee directory">
        <ul id="employeeList" aria-label="Employee list">
          <li>John Doe</li>
          <li>Jane Smith</li>
          <li>Mike Johnson</li>
          <li>Emma Brown</li>
          <li>Chris Lee</li>
          <li>Alice Green</li>
        </ul>
      </div>
      <div class="summary-table-col">
        <h2>Summary Table</h2>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Team</th>
              <th>Role</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John Doe</td>
              <td>Sales</td>
              <td>Sales Manager</td>
              <td>Active</td>
            </tr>
            <tr>
              <td>Jane Smith</td>
              <td>Marketing</td>
              <td>Content Strategist</td>
              <td>On Leave</td>
            </tr>
            <tr>
              <td>Mike Johnson</td>
              <td>Development</td>
              <td>Software Engineer</td>
              <td>Active</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div> 
  
  <script>
    // Sample employee data
    const employees = [
      "Alice Johnson",
      "Bob Smith",
      "Charlie Davis",
      "Diana Evans",
      "Ethan Brown",
      "Fiona Clark",
      "George Miller",
      "Hannah Wilson",
      "Ian Taylor",
      "Jessica Lee"
    ];

    // Populate employee select dropdown
    const employeeSelect = document.getElementById('employeeSelect');
    employees.forEach(emp => {
      const option = document.createElement('option');
      option.value = emp;
      option.textContent = emp;
      employeeSelect.appendChild(option);
    });

    // Team assignments storage
    const assignments = [];
    
    // Function to show error message
    function showError(element, message) {
      // Remove any existing error message
      const existingError = element.parentElement.querySelector('.error-message');
      if (existingError) {
        existingError.remove();
      }
      
      // Create error message
      const errorSpan = document.createElement('span');
      errorSpan.className = 'error-message';
      errorSpan.textContent = message;
      
      // Insert error after the element
      element.insertAdjacentElement('afterend', errorSpan);
      
      // Highlight the input
      element.style.border = '1px solid red';
    }

    // Function to clear error
    function clearError(element) {
      const existingError = element.parentElement.querySelector('.error-message');
      if (existingError) {
        existingError.remove();
      }
      element.style.border = '1px solid #ccc';
    }

    // Handle assign team form submit with manual validation
    document.getElementById('assignTeamForm').addEventListener('submit', function(e) {
      e.preventDefault();
      let isValid = true;
      
      // Validate employee selection
      if (employeeSelect.value === "" || employeeSelect.selectedIndex === 0) {
        showError(employeeSelect, 'Please select an employee');
        isValid = false;
      } else {
        clearError(employeeSelect);
      }
      
      // Validate team selection
      const teamSelect = document.getElementById('teamSelect');
      if (teamSelect.value === "" || teamSelect.selectedIndex === 0) {
        showError(teamSelect, 'Please select a team');
        isValid = false;
      } else {
        clearError(teamSelect);
      }
      
      // If form is valid, process it
      if (isValid) {
        const employee = employeeSelect.value;
        const team = teamSelect.value;

        // Check if already assigned
        const exists = assignments.find(a => a.employee === employee && a.team === team);
        if (exists) {
          alert(employee + " is already assigned to " + team + " team.");
          return;
        }

        assignments.push({ employee, team });
        updateAssignmentsList();

        // Reset selects
        employeeSelect.value = "";
        teamSelect.value = "";
      }
    });

    // Update the team assignments list UI
    function updateAssignmentsList() {
      const ul = document.getElementById('teamAssignments');
      ul.innerHTML = '';
      assignments.forEach(a => {
        const li = document.createElement('li');
        li.textContent = a.employee + " → " + a.team;
        ul.appendChild(li);
      });
    }

    // Add event listeners to clear errors on input change
    employeeSelect.addEventListener('change', function() {
      clearError(this);
    });
    
    document.getElementById('teamSelect').addEventListener('change', function() {
      clearError(this);
    });

    // Populate employee list for filtering
    const employeeList = document.getElementById('employeeList');
    function updateEmployeeList(filter = '') {
      employeeList.innerHTML = '';
      employees
        .filter(emp => emp.toLowerCase().includes(filter.toLowerCase()))
        .forEach(emp => {
          const li = document.createElement('li');
          li.textContent = emp;
          employeeList.appendChild(li);
        });
    }
    updateEmployeeList();

    // Filter employee list on search input
    document.getElementById('employeeSearch').addEventListener('input', e => {
      updateEmployeeList(e.target.value);
    });

    // Array to hold assigned training objects
    const assignedTrainings = [];

    // Get references to form and list container
    const trainingForm = document.getElementById('trainingForm');
    const trainingList = document.getElementById('trainingList');

    // Function to render the assigned trainings list
    function renderTrainings() {
      // Clear current list
      trainingList.innerHTML = '';

      if (assignedTrainings.length === 0) {
        trainingList.innerHTML = '<p>No trainings assigned yet.</p>';
        return;
      }

      // Create a simple list
      assignedTrainings.forEach((training, index) => {
        const div = document.createElement('div');
        div.style.border = '1px solid #ccc';
        div.style.padding = '8px';
        div.style.marginBottom = '5px';
        div.style.borderRadius = '4px';
        
        div.innerHTML = `
          <strong>Employee:</strong> ${training.employee} <br>
          <strong>Training:</strong> ${training.title} <br>
          <strong>Status:</strong> ${training.status}
        `;
        trainingList.appendChild(div);
      });
    }

    // Handle training form submit with manual validation
    trainingForm.addEventListener('submit', function(e) {
      e.preventDefault();
      let isValid = true;
      
      // Get form fields
      const empNameTrain = document.getElementById('empNameTrain');
      const trainingTitle = document.getElementById('trainingTitle');
      const trainingStatus = document.getElementById('trainingStatus');
      
      // Validate employee name
      if (empNameTrain.value.trim() === "") {
        showError(empNameTrain, 'Please enter employee name');
        isValid = false;
      } else {
        clearError(empNameTrain);
      }
      
      // Validate training title
      if (trainingTitle.value.trim() === "") {
        showError(trainingTitle, 'Please enter training title');
        isValid = false;
      } else {
        clearError(trainingTitle);
      }
      
      // If form is valid, process it
      if (isValid) {
        // Add to assigned trainings array
        assignedTrainings.push({
          employee: empNameTrain.value.trim(),
          title: trainingTitle.value.trim(),
          status: trainingStatus.value
        });

        // Render the updated list
        renderTrainings();

        // Reset form
        trainingForm.reset();
      }
    });
    
    // Add event listeners to clear errors on input
    document.getElementById('empNameTrain').addEventListener('input', function() {
      clearError(this);
    });
    
    document.getElementById('trainingTitle').addEventListener('input', function() {
      clearError(this);
    });

    // Initial render
    renderTrainings();
  </script>
</body> 
</html>
<?php
      }  
  }else{
        header('location: UserAuth.html');
    }
?>