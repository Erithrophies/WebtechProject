<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Department Structure</title>
<style>
  /* --- Sidebar styles (copied from your sidebar.html) --- */
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
    color: #1c1f1c; /* changed to dark for readability */
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
    color: white;
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
    width: 100%;
  }
  .department-list li {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-left: 10px;
    margin: 10px 0;
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

  /* --- Page content styles --- */
  .content {
    margin-left: 270px; /* space for sidebar */
    padding: 30px;
    flex: 1;
    color: #1c1f1c;
  }

  h1 {
    font-style: italic;
  }

  .drop-zone {
    min-height: 200px;
    border: 2px dashed #85876a;
    padding: 15px;
    margin-bottom: 30px;
    border-radius: 5px;
    background-color: white;
  }

  .drop-zone.over {
    background-color: rgba(133, 135, 106, 0.3);
  }

  /* Departments matching your sidebar colors */
  .department {
    width: 150px;
    padding: 15px;
    margin: 10px;
    cursor: grab;
    user-select: none;
    border-radius: 5px;
    color: white;
    font-weight: bold;
  }
  .department.art {
    background-color: #f78fb3;
  }
  .department.dev {
    background-color: #70a1ff;
  }
  .department.hr {
    background-color: #85876a; /* same as sidebar bg */
  }
</style>
</head>
<body>

<!-- Sidebar copied from your sidebar.html -->
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

<!-- Page main content -->
<div class="content">
  <h1>Department Structure</h1>
  <p>Description: Organizational hierarchy</p>

  <h3>Department Editor</h3>
  <div id="departments" class="drop-zone" ondragover="allowDrop(event)" ondrop="drop(event)">
    <div id="dept1" draggable="true" class="department art" ondragstart="drag(event)">Art & Design</div>
    <div id="dept2" draggable="true" class="department dev" ondragstart="drag(event)">Development</div>
    <div id="dept3" draggable="true" class="department hr" ondragstart="drag(event)">HR</div>
  </div>

  <h3>Reporting Lines (Drag departments here to reorganize)</h3>
  <div id="reporting" class="drop-zone" ondragover="allowDrop(event)" ondrop="drop(event)">
    <p>Drop departments here to reorganize teams</p>
  </div>
</div>

<script>
  function toggleDepartments() {
    const departmentList = document.getElementById('departmentList');
    departmentList.style.display = departmentList.style.display === 'block' ? 'none' : 'block';
  }

  function allowDrop(event) {
    event.preventDefault();
  }

  function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
  }

  function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("text");
    var draggedElement = document.getElementById(data);

    // Drop only if dropping on drop zone or department container, not on department itself
    if(event.target.classList.contains('drop-zone')){
      event.target.appendChild(draggedElement);
    } else if(event.target.classList.contains('department')){
      event.target.parentNode.appendChild(draggedElement);
    }
  }
</script>

</body>
</html>
