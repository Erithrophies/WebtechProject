<?php
    session_start();
    if (isset($_COOKIE['status'])){
      //$role = $_COOKIE['emp'];
      if (isset($_COOKIE['hr'])){
        header('Location: HR_dashboard.php');}
        if (isset($_COOKIE['mng'])){
        header('Location: manager_dashboard.php');}
       if (isset($_COOKIE['emp'])){
       
        //header('Location: Employee_dashboard.php');
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Employee Dashboard</title>
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
      margin-top: 40px;
    }

    canvas {
      background:rgba(179, 170, 170, 0.18);
      border-radius: 70px;
    }
    form {
      all: unset;
      display: contents;
    }

    table, th, td {
      color: #333;
    }

    #searchBar {
      width: 100%;
      padding: 10px;
      margin-bottom: 6px;
      border-radius: 20px;
      border: none;
      font-size: 13px;
      background-color: #ddd;
    }

    #tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    #tabs button {
      padding: 10px 20px;
      border-radius: 8px;
      border: none;
      background: #555;
      color: white;
      cursor: pointer;
    }

    #tabs button.active {
      background: #333;
    }

    
  </style>
</head>
<body>
  <form>

    <?php include 'Emp_sidebar.html'; // Employee version of sidebar ?>

    <div class="main">
      
      <div class="topbar">
        <input type="text" id="searchBar" placeholder="Search teammates...">
        <div class="notification">🔔</div>
        <div class="profile-btn">
          <img src="profile.jpg" alt="Profile" />
        </div>
      </div>
      
      <h1 style="color: #1c1f1c;">Overview</h1>

      <div class="dashboard-grid">
        <div class="card">👥 <span class="highlight">Team Members:</span> 25</div>
        <div class="card">📅 <span class="highlight">Tasks Due Today:</span> 3</div>
        <div class="card">🏢 <span class="highlight">Your Teams:</span> 2</div>
        <div class="card">📝 <span class="highlight">Pending Approvals:</span> 1</div>
        <div class="card">🎉 <span class="highlight">New Messages:</span> 5</div>
        <div class="card">⚠️ <span class="highlight">Upcoming Trainings:</span> 2</div>
        <div class="card">📊 <span class="highlight">Your Performance:</span> 88%</div>
        <div class="card">📚 <span class="highlight">Completed Projects:</span> 4</div>
      </div>

      <div style="display: flex; gap: 40px; align-items: flex-start;">

        <!-- Pie Chart -->
       

        <!-- Personal Performance Table -->
        <div style="flex: 1;">
          <h2 style="color:#454d42;">Your Performance Summary</h2>
          <table border="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; text-align:center" >
            <tbody style="font-weight: bold;">
              <tr>
                <td style="padding: 8px; border: 0px solid #ddd;">Tasks Completed</td>
                <td style="padding: 8px; border: 0px solid #ddd;">45</td>
              </tr>
              <tr style="background-color: #f9f9f9;">
                <td style="padding: 8px; border: 0px solid #ddd;">Attendance Rate</td>
                <td style="padding: 8px; border: 0px solid #ddd;">96%</td>
              </tr>
              <tr>
                <td style="padding: 8px; border: 0px solid #ddd;">Projects Involved</td>
                <td style="padding: 8px; border: 0px solid #ddd;">3</td>
              </tr>
              <tr style="background-color: #f9f9f9;">
                <td style="padding: 8px; border: 0px solid #ddd;">Performance Score</td>
                <td style="padding: 8px; border: 0px solid #ddd;">8.8 / 10</td>
              </tr>
            </tbody>
          </table>
        
          <h3 style="color:#454d42; margin-top: 20px;">Recent Task Completion Rates</h3>
          
          <div style="margin-bottom: 15px;">
            <div style="color:#333;">Project Alpha</div>
            <div style="background:#ddd; border-radius:10px; overflow:hidden;">
              <div style="width:90%; background:#60a5fa; padding:5px 0; color:white; text-align:center;">90%</div>
            </div>
          </div>
          <div style="margin-bottom: 15px;">
            <div style="color:#333;">Project Beta</div>
            <div style="background:#ddd; border-radius:10px; overflow:hidden;">
              <div style="width:85%; background:#fcd34d; padding:5px 0; color:black; text-align:center;">85%</div>
            </div>
          </div>
          <div style="margin-bottom: 15px;">
            <div style="color:#333;">Project Gamma</div>
            <div style="background:#ddd; border-radius:10px; overflow:hidden;">
              <div style="width:78%; background:#ef4444; padding:5px 0; color:white; text-align:center;">78%</div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </form>

  <script>
    

     
  
  </script>
</body>
</html>


<?php
     
  }
    }else{
        header('location: UserAuth.html');
    }
  

?>