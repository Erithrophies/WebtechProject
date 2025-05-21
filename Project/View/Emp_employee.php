<?php
    session_start();
    if (isset($_COOKIE['status'])){
      //$role = $_COOKIE['emp'];
      if (isset($_COOKIE['hr'])){
        header('Location: HR_dashboard.php');}
        if (isset($_COOKIE['mng'])){
        header('Location: manager_dashboard.php');}
        if (isset($_COOKIE['hr_d'])){
        header('Location: HR_document.php');}
        if (isset($_COOKIE['hr_emp'])){
        header('Location: HR_Employee.php');}
        if (isset($_COOKIE['hr_leave'])){
        header('Location: HR_leave.php');}
        if (isset($_COOKIE['hr_perfomance'])){
        header('Location: HR_perfomance.php');}
        if (isset($_COOKIE['mng_leave'])){
        header('Location: Leave_manager.php');}
        if (isset($_COOKIE['mng_doc'])){
        header('Location: mng_document');}
        if (isset($_COOKIE['mng_emp'])){
        header('Location: mng_employee.php');}
       if (isset($_COOKIE['emp'])){
       
        //header('Location: Employee_dashboard.php');
       
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
    
  </style>
</head>
<body>
  <form>
    <div class="container">
      <?php include 'Emp_sidebar.html'; ?>
      
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
          <div class="table-container">
            <table class="employee-table">
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Department</th>
                  <th>Position</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>EMP001</td>
                  <td>Jeba Sahjida</td>
                  <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                      <div class="circle dev"></div>Development
                    </div>
                  </td>

                  <td>Senior Developer</td>
                  <td><span class="status-badge status-active">Active</span></td>
                </tr>
                <tr>
                  <td>EMP002</td>
                  <td>Ashraful Moon</td>
                  <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                      <div class="circle art"></div>Art & Design
                    </div>
                  </td>

                  <td>UI Designer</td>
                  <td><span class="status-badge status-active">Active</span></td>
                </tr>
                <tr>
                  <td>EMP003</td>
                  <td>Owsi shafi</td>
                  <td>
                    <div style="display: flex; align-items: center; gap: 10px;">
                      <div class="circle dev"></div>Development
                    </div>
                  </td>

                  <td>Project Manager</td>
                  <td><span class="status-badge status-leave">On Leave</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script>
        function toggleDepartments() {
          const deptList = document.getElementById("departmentList");
          if (deptList.style.display === "none") {
            deptList.style.display = "block";
          } else {
            deptList.style.display = "none"; 
          }    
        }

         document.getElementById("searchInput").addEventListener("keyup", function () {
          const filter = this.value.toLowerCase();
          const rows = document.querySelectorAll(".employee-table tbody tr");

          rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
          });
        });
      </script>
      </form>
</body>
</html>

<?php
     
  }
    }else{
        header('location: UserAuth.html');
    }
  

?>

