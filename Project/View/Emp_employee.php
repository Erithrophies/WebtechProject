<?php
session_start();

include('../Controller/empDir_emp.php');

if (isset($_SESSION['type']) && $_SESSION['type'] === 'employee') {
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  
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

    .card {
      background: rgb(255, 255, 255);
      margin-bottom: 60px;
      padding: 20px;
      border-radius: 10px;
      font-size: 10px;
      color: #454d42c1;
    }

    form {
      all: unset;
      display: contents;
    }

    .employee-table {
      width: 100%;
      border-collapse: collapse;
      background: #ccc;
      border-radius: 8px;
    }

    .employee-table th {
      padding: 15px;
      text-align: left;
      background:rgb(133, 135, 106);
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
    
    .card h2 {
      color: #454d42;
      margin-bottom: 20px;
    }

    .circle {
      width: 10px;
      height: 10px;
      border-radius: 50%;
    }
    
  </style>
</head>
<body>
  <form>
    <div class="container">
      <?php include 'Emp_sidebar.php'; ?>
      
      <div class="main">
        <div class="topbar">
          <input
            type="text"
            id="searchInput"
            placeholder=" Search employees..."
            style="padding: 8px 12px; font-size: 14px; border-radius: 610px; border: 1px solid #ccc; width: 250px; color: black;"
          />
        </div>

        

        <div class="card">
          <h1>Employee List</h1>
          <?php if (!empty($employees)): ?>
  <div class="table-container">
    <table class="employee-table">
      <thead>
        <tr>
          <th>Employee ID</th>
          <th>Name</th>
          <th>Department</th>
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
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <p>No employee records found.</p>
<?php endif; ?>
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
} else {
  
  header("Location: UserAuth.html");
  exit();
}
?>

