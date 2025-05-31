<?php
session_start();

include_once("../Controller/pendingApprovalEmp.php");
include_once("../Controller/employee_upcoming_training.php");
include_once("../Controller/empCard.php");


if (isset($_SESSION['type']) && $_SESSION['type'] === 'employee') {
  
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
      background-color: rgba(177, 178, 167, 0.639);
    }
    .topbar .profile-btn {
      font-size: 16px;
      padding: 10px;
      border-radius: 10px;
      
    }

   .main {
    position: absolute;
    left: 300px;
    width: 1200px;
    display: block;
   padding: 30px;
   flex: 1;
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

    
    form {
      all: unset;
      display: contents;
    }

    table, th, td {
      color:rgb(102, 143, 199);
      font-size: 13px;
      
      
    }

    #searchBar {
      width: 100%;
      padding: 10px;
      margin-bottom: 6px;
      border-radius: 20px;
      border: none;
      font-size: 13px;
      background-color:#ddd;
    }

  

    
  </style>
</head>
<body>

    <?php include 'Emp_sidebar.php';  ?>

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
        <a href="Emp_employee.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="Totalemployee" style="cursor:pointer;">
          🤵🏻 <span class="highlight">Total Employees:</span> <?php echo $emps; ?>
        </div>
        </a>
        <div class="card">📅 <span class="highlight">Tasks Due </span> 3</div>
        <div class="card">🏢 <span class="highlight">Your Teams</span> 2</div>
       <div class="card" id="pendingApprovalsCard" style="cursor:pointer;">
    🕓 <span class="highlight">Pending Approvals:</span> <?php echo $pendingApprovals; ?>
        </div>
      

        <div class="card">🎉 <span class="highlight">New Messages:</span> 5</div>
        <a href="trainingEmployee.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="upcomingTrainingCard" style="cursor:pointer;">
          ⚠️ <span class="highlight">Upcoming Trainings:</span> <?php echo $upcomingTrainingsCount; ?>
        </div>
        </a>

        <div class="card">📊 <span class="highlight">Your Performance:</span> 88%</div>
        <div class="card">📚 <span class="highlight">Completed Projects:</span> 4</div>
      </div>

      <div style="margin-right: 90px;">

       
        <div style="align-items: center;">
          <h2 style="color:#454d42; margin-left:540px"><i>Your Performance Summary</i></h2>
          <hr>
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
                <td style="padding: 8px; border: 0px solid #ddd; ">8.8 / 10</td>
              </tr>
            </tbody>
          </table><hr><br><br>
        
          <h3 style="color:#454d42; margin-left:560px; margin-top:10px; font-size:18px"><i>Recent Task Completion Rates</i></h3>
          
          
          <div style="margin-bottom: 5px;">
            <div style="color:#333;">Project Alpha</div>
            <div style="background:#ddd; border-radius:15px; overflow:hidden; margin-top:10px">
              <div style="width:90%; background:darkslategray; padding:5px 0; color:white; text-align:center;">90%</div>
            </div>
          </div>
          <div style="margin-bottom: 15px;">
            <div style="color:#333; margin-top:10px">Project Beta</div>
            <div style="background:#ddd; border-radius:10px; overflow:hidden; margin-top:10px">
              <div style="width:85%; background:#fcd34d; padding:5px 0; color:black; text-align:center;">85%</div>
            </div>
          </div>
          <div style="margin-bottom: 15px;">
            <div style="color:#333; margin-top:10px">Project Gamma</div>
            <div style="background:#ddd; border-radius:10px; overflow:hidden; margin-top:10px">
              <div style="width:78%; background:#ef4444; padding:5px 0; color:white; text-align:center;">78%</div>
            </div>
          </div><br>  
        </div>

      </div>

    </div>


  <script>

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