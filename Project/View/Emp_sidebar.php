 <?php 

 include_once("../Controller/departmentAccess.php"); 
 ?>

 <style>
  
    .sidebar {
      width: 250px;
      background: #85876a;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: fixed;
      height: 100vh;
    }
    .sidebar .top-section {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .sidebar h2 {
      margin-bottom: 30px;
      font-size: 24px;
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
      margin: 10px 0;
    }
    .sidebar ul li a {
      color: white;
      text-decoration: none;
      padding: 8px 0;
      display: block;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .sidebar ul li a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }
    .department-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;  
      width: 100%;
      margin: 20px 0 10px;
      font-size: 16px;
      border-bottom: 1px solid rgba(255,255,255,0.3);
      padding-bottom: 5px;
    }
    .department-header button {
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }
    .department-list {
      list-style: none;
      padding: 0;
      margin: 0;
      width: 10px;
    }
    .department-list li {
      display: flex;
      align-items: center;
      gap: 10px;
      padding-left: 0px;
      margin: 20px 0;
    }
    .circle {
      width: 10px;
      height: 10px;
      border-radius: 50%;
    }
    .art { background-color: #f78fb3; }
    .dev { background-color: #70a1ff; }
    .bottom-section {
      margin-top: auto;
    }
  </style>



  <div class="sidebar">
    <div class="top-section">
      <h2>Workos</h2>
      <ul>
        <h3>Menu</h3>
        <li><a href="Employee_dashboard.php">Dashboard</a></li>
        <li><a href="Emp_employee.php">Employee</a></li>
        <li><a href="employee_leave.php">Leave Request</a></li>
        <li><a href="emp_document.php">Documents</a></li>
      </ul>

      <div class="department-header">
        <span>Department</span>
        <button>+</button>
      </div>
      <ul id="departmentList" class="department-list" style="display: block;">
        <?php if ($departmentName == "art & design"): ?>
          <li>
            <div class="circle art"></div><a href="art&design.html">art & design</a>
          </li>
        <?php elseif ($departmentName == "development"): ?>
          <li>
            <div class="circle dev"></div><a href="development.html">development</a>
          </li>
        <?php else: ?>
          <li><em>No department assigned</em></li>
        <?php endif; ?>
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

  