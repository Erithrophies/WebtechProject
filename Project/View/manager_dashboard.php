<?php
session_start();
//include '../Model/db.php'; 
//include '../Controller/assign_training.php';

include_once("../Controller/empCard.php");
include_once('../Controller/mngDir_mng.php');



if (isset($_SESSION['type']) && $_SESSION['type'] === 'manager') {
  
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
    .topbar .profile-btn {
      font-size: 16px;
      padding: 10px;
      border-radius: 10px;
      
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

    #assignTeamForm {
      display: flex;
      gap: 14px;
      align-items: center;
      flex-wrap: wrap;
      margin-bottom: 24px;
    }
    #assignTeamForm select, #assignTeamForm button {
      
      padding: 10px 14px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 15px;
      transition: border 0.2s, box-shadow 0.2s;
    }
    #assignTeamForm select:focus {
      border: 1.5px solid #85876a;
      box-shadow: 0 2px 8px rgba(133, 135, 106, 0.10);

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
    
   
    .error-message {
  color: red;
  font-size: 0.9em;
  margin-left: 10px;
}

  </style>
</head>
<body>
  <?php include 'mng_sidebar.php'; ?>

  <div class="main">
    
    <div class="topbar">
       <input type="text" id="searchBar" placeholder="Search employees..." oninput="searchEmployee()" />
<div id="employeeResults"></div>
      <div class="notification" title="Notifications">🔔</div>
      <div class="profile-btn" style="color:#85876a; font-weight: bold; margin-right:20px">
          <?php echo $_SESSION['username']; ?>
        </div>
    </div>
    
    <h1>Overview</h1>

    <div class="dashboard-grid">
      <<a href="mng_employee.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="Totalemployee" style="cursor:pointer;">
          🤵🏻 <span class="highlight">Total Employees:</span> <?php echo $emps; ?>
        </div>
        </a>
      <<a href="Leave_manager.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="leaves" style="cursor:pointer;">
          📜 <span class="highlight">Leaves</span> 
        </div>
        </a>
      <<a href="mng_document.php" style="text-decoration: none; color: inherit;">
        <div class="card" id="doc" style="cursor:pointer;">
          📝 <span class="highlight">Documents</span> 
        </div>
        </a>
    </div>
    
    <section id="training-program" style="margin-top:30px;">
      <h1><i>Training Program Assignment</i></h1>
       <form id="trainingForm" method="POST" action="../Controller/assign_Training.php" onsubmit="return validateTrainingForm()">
        <label for="empNameTrain" style="font-size:15px; margin-left:5px">Employee:</label>
        <input type="text" id="empNameTrain" name = "username" placeholder=" Enter employee name" style="margin-left:30px; height:25px;">
         <span id="msg-train-name" class="error-message" ></span><br><br> 
        
        <label for="trainingTitle" style="font-size:15px">Training Title:</label>
        <input type="text" id="trainingTitle" name = "training_name" placeholder="Enter training program" style="margin-left:10px; height:25px;">
         <span id="msg-train-title" class="error-message"></span> <br><br>

        <label for="trainingStatus" style="font-size:15px">Status:</label>
        <select id="trainingStatus"  name="training_status" style="margin-left:52px; height:25px;">
          <option>Not started</option>
          <option>In progress</option>
          <option>Completed</option>
        </select><br><br><br>
        
        <button type="submit" name = "submit" style=" height:20px; width:250px">Assign Training</button>
        <a href="trainingManager.php">See the training datas</a>
      </form>
      <div id="trainingOutput" style="margin-top: 20px;">
        
      </div>

      

    </section>
    
    <h2>Assign Teams</h2>
    <form id="assignTeamForm">
      <select id="employeeSelect" aria-label="Select employee">
        <option value="" disabled selected>Select Employee</option>
        <option value="Niloy Gomes">Niloy Gomes</option>
        <option value="Jeba Shajida">Jeba Shajida</option>
        <option value="Sabiha Eitu">Sabiha Eitu</option>
      </select>
        <span id="msg-employee" class="error-message"></span>

      <select id="teamSelect">
        <option value="" disabled selected>Select Team</option>
        <option value="Art & Design">Art & Design</option>
        <option value="UI">UI</option>
        <option value="Development">Development</option>
      </select>
       <span id="msg-team" class="error-message"></span> 

      <button type="submit">Assign</button>
    </form>

    <ul id="teamAssignments"></ul>

    <h2>Employee Directory</h2>
    <div class="directory-summary-row">
      <div class="employee-directory-col">
        <input type="text" id="employeeSearch" placeholder="Search employees by name...">
        <ul id="employeeList">
            <?php foreach ($employees as $employee) { ?>
             <li><?= $employee['username'] ?></li>
              <?php } ?>
        </ul>

      </div>
      <div class="summary-table-col">
        <h2>Summary Table</h2>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Team</th>
            </tr>
          </thead>
          <tbody>
        <?php foreach ($employees as $emp): ?>
          <tr>
            <td><?= $emp['username'] ?></td>
            <td>
              <div style="display: flex; align-items: center; gap: 10px;">
                <div class="circle" style="background-color: <?= $emp['color_code'] ?>;"></div>
          <?= $emp['department'] ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
        </table>
      </div>
    </div>
  </div> 
  
 <script>

  document.getElementById("assignTeamForm").onsubmit = function (e) {
    var employee = document.getElementById("employeeSelect").value;
    var team = document.getElementById("teamSelect").value;

    var employeeMsg = document.getElementById("msg-employee");
    var teamMsg = document.getElementById("msg-team");

    
    employeeMsg.innerHTML = "";
    teamMsg.innerHTML = "";

    var valid = true;

    if (employee === "") {
      employeeMsg.innerHTML = "Please select an employee.";
      valid = false;
    }

    if (team === "") {
      teamMsg.innerHTML = "Please select a team.";
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  };

 function validateTrainingForm() {
    let name = document.getElementById("empNameTrain").value.trim();
    let title = document.getElementById("trainingTitle").value.trim();

    let nameMsg = document.getElementById("msg-train-name");
    let titleMsg = document.getElementById("msg-train-title");

    nameMsg.textContent = "";
    titleMsg.textContent = "";

    let valid = true;

    if (name === "") {
        nameMsg.textContent = "Employee name is required.";
        valid = false;
    }

    if (title === "") {
        titleMsg.textContent = "Training title is required.";
        valid = false;
    }


    // if (valid) {
    //                 window.location.href = "../Controller/assign_Training.php";
    //             }
    return valid; 
}

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

  var searchInput = document.getElementById("employeeSearch");
  var listItems = document.querySelectorAll("#employeeList li");

  searchInput.onkeyup = function () {
    var filter = searchInput.value.toLowerCase();

    for (var i = 0; i < listItems.length; i++) {
      var text = listItems[i].textContent.toLowerCase();
      if (text.includes(filter)) {
        listItems[i].style.display = "";
      } else {
        listItems[i].style.display = "none";
      }
    }
  };

</script>

</body> 
</html>
<?php
} else {
  
  header("Location: UserAuth.html");
  //exit();
}
?>