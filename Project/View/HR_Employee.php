     <?php
    session_start();
    include('../Controller/hr_emp_dir.php');

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

    .container {
      display: flex;
      width: 100%;
      min-height: 100vh;
    }

    .main {
      flex: 1;
      padding: 30px;
      margin-left: 250px; 
    }

    .department-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
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

    .card {
      background: rgba(177, 178, 167, 0.639);
      margin-bottom: 60px;
      padding: 20px;
      border-radius: 10px;
      font-size: 10px;
      color: #454d42c1;
    }

    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .highlight {
      font-weight: bold;
      color: #2749bc;
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

    .table-container {
      overflow-x: auto;
    }

    .employee-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
    }

    .employee-table th {
      padding: 15px;
      text-align: left;
      background: #85876a;
      color: white;
    }

    .employee-table td {
      padding: 15px;
      border-bottom: 1px solid #eee;
    }

    .status-badge {
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 12px;
      color: white;
    }

    .status-active {
      background: #70a1ff;
    }

    .status-leave {
      background: #000000;
    }

    .action-btn {
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      color: white;
    }

    .edit-btn {
      background: #85876a;
      margin-right: 5px;
    }

    .delete-btn {
      background: #e03f3f;
    }

    .card h2 {
      color: #454d42;
      margin-bottom: 20px;
    }
    
  </style>
</head>
<body>
  <form>
    <div class="container">
      <?php include 'sidebar.php'; ?>
      
      <div class="main">
        <div class="topbar">
          <input
            type="text"
            id="searchInput"
            placeholder="Search employees..."
            style="padding: 8px 12px; font-size: 14px; border-radius: 6px; border: 1px solid #ccc; width: 250px; color: black;"
          />
        </div>

        <div style="margin-bottom: 20px">
          <a href="AddEmployee.php" class="action-btn edit-btn" style="font-size: 14px; padding: 10px 20px; text-decoration: none; display: inline-block;">
            + Add Employee
          </a>
        </div>

        <div class="card">
  <h2>Employee List</h2>
  <div class="table-container">
    <table class="employee-table">
      <thead>
        <tr>
          <th>Employee ID</th>
          <th>Name</th>
          <th>Department</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($employees as $emp): ?>
          <tr>
            <td><?= $emp['id'] ?></td>
            <td><?= $emp['username'] ?></td>
            <td>
              <div style="display: flex; align-items: center; gap: 10px;">
                <div class="circle" style="background-color: <?= $emp['color_code'] ?>;"></div>
          <?= $emp['department'] ?>
              </div>
            </td>
            <td>
              <a class="action-btn edit-btn" href="EditEmployee.php?id=<?= $emp['id'] ?>">Edit</a>
              <form method="POST" action="../Controller/deleteUserHr.php" style="display:inline;" onsubmit="return confirm('Delete this employee?');">
                <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                <button type="submit" name = "submit" class="action-btn delete-btn">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

      </div>
    </div>
     </form>

    <script>
         var searchInput = document.getElementById("searchInput");
  var rows = document.querySelectorAll(".employee-table tbody tr");

  searchInput.onkeyup = function () {
    var filter = searchInput.value.toLowerCase();

    for (var i = 0; i < rows.length; i++) {
      var rowText = rows[i].innerText.toLowerCase();
      if (rowText.includes(filter)) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  };
      </script>
     
</body>
</html>

<?php
      }
  else{
        header('location: UserAuth.html');
    }

?>

