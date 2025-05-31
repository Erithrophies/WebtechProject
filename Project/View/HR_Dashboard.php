
<?php
session_start();

include("../Controller/HRempCard.php");

if (isset($_SESSION['type']) && $_SESSION['type'] === 'hr') {
  
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
    .topbar .profile-btn {
      font-size: 16px;
      padding: 10px;
      border-radius: 10px;
      
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

    #employeeResults {
  margin-top: 10px;
  padding: 10px;
  background: #f1f1f1;
  color: #333;
  border-radius: 10px;
}


    
  </style>
</head>
<body>
  <form>

    <?php include 'sidebar.php'; ?>

    <div class="main">
      <div class="topbar">
        <input type="text" id="searchBar" placeholder="Search employees..." oninput="searchEmployee()" />
<div id="employeeResults"></div>

        <div class="notification">🔔</div>
          <div class="profile-btn" style="color:#85876a; font-weight: bold; margin-right:20px">
          <?php echo $_SESSION['username']; ?>
        </div>
      </div>
      

      <h1 style="color: #1c1f1c;">Overview</h1>

      <div class="dashboard-grid">
        <a href="HR_employee.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="Totalemployees" style="cursor:pointer;">
          ⚠️ <span class="highlight">Total Employees:</span> <?php echo $emps; ?>
        </div>
        </a>
        <a href="HR_leave.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="leave" style="cursor:pointer;">
           📅<span class="highlight">On leave</span>
        </div>
        </a>
        <div class="card">🏢 <span class="highlight">Departments:</span> 5 Active</div>
        <a href="HR_performance.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="" style="cursor:pointer; ">
          📝<span class="highlight">Pending Reviews</span> 
        </div>
        </a>
        <div class="card">🎉 <span class="highlight">New Joiners This Month:</span> 6</div>
        <div class="card">⚠️ <span class="highlight">Documents Expiring Soon:</span> 4</div>
        <div class="card">📊 <span class="highlight">Attrition Rate:</span> 3.2%</div>
        <div class="card">📚 <span class="highlight">Ongoing Trainings:</span> 9 Programs</div>
      </div>

      
<div style="display: flex; gap: 40px; align-items: flex-start;">

  <div class="chart-section" >
    <canvas id="orgHealthChart" width="300" height="300"></canvas>
  </div>

  
  <div style="flex: 1;">
    <h2 style="color:#454d42;">Employee Performance</h2>
    <table border="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; text-align:center" >
      
      <tbody style="font-weight: bold;">
        <tr>
          <td style="padding: 8px; border: 0px solid #ddd;">Top Performer</td>
          <td style="padding: 8px; border: 0px solid #ddd;">Jeba Shajida (95%)</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
          <td style="padding: 8px; border: 0px solid #ddd;">Avg Task Completion</td>
          <td style="padding: 8px; border: 0px solid #ddd;">87%</td>
        </tr>
        <tr>
          <td style="padding: 8px; border: 0px solid #ddd;">Attendance Rate</td>
          <td style="padding: 8px; border: 0px solid #ddd;">96%</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
          <td style="padding: 8px; border: 0px solid #ddd;">Performance Index</td>
          <td style="padding: 8px; border: px solid #ddd;">8.7 / 10</td>
        </tr>
      </tbody>
    </table>
  
    <h3 style="color:#454d42; margin-top: 20px;">Top 3 Employee Scores</h3>
    
    <div style="margin-bottom: 15px;">
      <div style="color:#333;">Jeba Shajida</div>
      <div style="background:#ddd; border-radius:10px; overflow:hidden;">
        <div style="width:95%; background:#60a5fa; padding:5px 0; color:white; text-align:center;">95%</div>
      </div>
    </div>
    <div style="margin-bottom: 15px;">
      <div style="color:#333;">Niloy Gomes</div>
      <div style="background:#ddd; border-radius:10px; overflow:hidden;">
        <div style="width:90%; background:#fcd34d; padding:5px 0; color:black; text-align:center;">90%</div>
      </div>
    </div>
    <div style="margin-bottom: 15px;">
      <div style="color:#333;">Sabiha Eitu</div>
      <div style="background:#ddd; border-radius:10px; overflow:hidden;">
        <div style="width:88%; background:#ef4444; padding:5px 0; color:white; text-align:center;">88%</div>
      </div>
    </div>
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

  function searchEmployee() {
const search = document.getElementById('searchBar');
  console.log("Typed:", search.value);  

  let keyword = search.value;
  let json = { "keyword": keyword };
  let data = JSON.stringify(json);

  let xhttp = new XMLHttpRequest();
  xhttp.open('POST', '../Controller/SearchEmployee.php', true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send('json=' + data);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('employeeResults').innerHTML = this.responseText;
    }
  };
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