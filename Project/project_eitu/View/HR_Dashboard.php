<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>HR Dashboard</title>
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
    }
    .department-header button {
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }
    .department-list li {
      display: flex;
      align-items: center;
      gap: 10px;
      padding-left: 10px;
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

    .topbar {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-bottom: 30px;
      gap: 20px;
    }
    .topbar .notification {
      font-size: 20px;
      cursor: pointer;
      background-color: rgba(255, 255, 255, 0.1);
      padding: 10px;
      border-radius: 50%;
      transition: background 0.3s;
    }
    .topbar .notification:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }
    .topbar .profile-btn img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      cursor: pointer;
      object-fit: cover;
      border: 2px solid white;
    }

    .main {
      margin-left: 250px;
      padding: 30px;
      flex-grow: 1;
    }

    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .card {
      background: rgba(177, 178, 167, 0.639);
      margin-bottom: 20px;
      padding: 25px;
      border-radius: 15px;
      font-size: 14px;
      color: #454d42;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background: #85876a;
    }

    .highlight {
      font-weight: bold;
      color: #2749bc;
      display: inline-block;
      margin: 5px;
      position: relative;
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
      font-size: 20px;
      margin-right: 10px;
      vertical-align: middle;
    }

    .card span:last-child {
      font-size: 16px;
      font-weight: 500;
      color: #454d42;
      float: right;
    }

    .chart-section {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
    }

    canvas {
      background: white;
      border-radius: 10px;
    }
    form {
      all: unset;
      display: contents;
    }
  </style>
</head>
<body>
  <form>
    <div class="sidebar">
      <div class="top-section">
        <h2>Workos</h2>
        <ul>
          <h3>Menu</h3>
          <li><a href="HR_Dashboard.php">Dashboard</a></li>
          <li><a href="employee.html">Employee</a></li>
          <li><a href="recruitment.html">Recruitment</a></li>
          <li><a href="documents.html">Documents</a></li>
          <div class="department-header" onclick="toggleDepartments()">
            <h3>Department</h3>
            <button onclick="toggleDepartments()">+</button>
          </div>
          <ul id="departmentList" class="department-list" style="display: block;">
            <li><div class="circle art"></div><a href="art&design.html">Art & Design</a></li>
            <li><div class="circle dev"></div><a href="development.html">Development</a></li>
          </ul>
        </ul>
      </div>
      <div class="bottom-section">
        <ul>
          <h3>Others</h3>
          <li><a href="settings.html">Settings</a></li>
          <li><a href="feedback.html">Feedbacks</a></li>
          <li><a href="logout.html">Logout</a></li>
        </ul>
      </div>
    </div>

    <div class="main">
      <div class="topbar">
        <div class="notification">🔔</div>
        <div class="profile-btn">
          <img src="profile.jpg" alt="Profile" />
        </div>
      </div>

      <h1 style="color: #1c1f1c;">HR Dashboard</h1>

      <div class="dashboard-grid">
        <div class="card">👥 <span class="highlight">Total Employees:</span> 142</div>
        <div class="card">📅 <span class="highlight">On Leave Today:</span> 8</div>
        <div class="card">🏢 <span class="highlight">Departments:</span> 5 Active</div>
        <div class="card">📝 <span class="highlight">Pending Reviews:</span> 12</div>
        <div class="card">🎉 <span class="highlight">New Joiners This Month:</span> 6</div>
        <div class="card">⚠️ <span class="highlight">Documents Expiring Soon:</span> 4</div>
        <div class="card">📊 <span class="highlight">Attrition Rate:</span> 3.2%</div>
        <div class="card">📚 <span class="highlight">Ongoing Trainings:</span> 9 Programs</div>
      </div>

      <h2 style="color:#454d42;">Organizational Charts</h2>
      <div class="chart-section">
        <canvas id="orgHealthChart" width="300" height="300"></canvas>
      </div>
    </div>
  </form>

  <script>
    window.onload = function () {
      const ctx = document.getElementById("orgHealthChart").getContext("2d");

      const data = [60, 25, 15];
      const colors = ["#60a5fa", "#fcd34d", "#ef4444"];
      const total = data.reduce((a, b) => a + b, 0);

      let startAngle = 0;
      for (let i = 0; i < data.length; i++) {
        const sliceAngle = (data[i] / total) * 2 * Math.PI;
        ctx.beginPath();
        ctx.moveTo(150, 150);
        ctx.arc(150, 150, 100, startAngle, startAngle + sliceAngle);
        ctx.closePath();
        ctx.fillStyle = colors[i];
        ctx.fill();
        startAngle += sliceAngle;
      }

      ctx.fillStyle = "#333";
      ctx.font = "16px Arial";
      ctx.fillText("Org Health", 100, 280);
    };

    function toggleDepartments() {
      const deptList = document.getElementById("departmentList");
      if (deptList.style.display === "none") {
        deptList.style.display = "block";
      } else {
        deptList.style.display = "none"; 
      }
    }

  
  </script> 
</body>
</html>

<?php
    }else{
        header('location: UserAuth.html');
    }

?>
