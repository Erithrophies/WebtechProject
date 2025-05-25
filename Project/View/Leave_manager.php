<?php
session_start();

if (isset($_SESSION['type']) && $_SESSION['type'] === 'manager') {
  // Manager is allowed to view this page
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Manager Leave Page</title>
<style>
  
  * { box-sizing: border-box; }
  html, body { height: 100%;
     margin: 0;
      padding: 0;
       font-family: Arial, sans-serif;
        background: rgb(249, 249, 249);
         color: white; }
  body { display: flex; min-height: 100vh; }

 
  
  .content {
    margin-left: 270px;
    padding: 20px;
    width: 100%;
    color: #333;
  }
  h1 { color: #444; }
  .section {
    background: white;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    color: black;
  }
  table {
    width: 100%; border-collapse: collapse; margin-top: 10px;
  }
  th, td {
    border: 1px solid #ccc; padding: 8px; text-align: center;
  }
  th {
    background-color: #eee;
  }
  textarea {
    width: 90%; height: 40px; resize: none; font-size: 14px;
  }
  button {
    margin: 5px 5px 5px 0;
    padding: 5px 10px;
    cursor: pointer;
  }
  .error {
    color: red;
    margin-top: 5px;
    font-size: 14px;
  }
</style>
</head>
<body>


<?php include 'mng_sidebar.php'; ?>

<div class="content">
  <h1>Manager Leave Approval</h1>

  <div class="section">
    <h2>Team Leave Requests</h2>
    <table id="leaveTable">
      <thead>
        <tr>
          <th>Employee</th>
          <th>Leave Dates</th>
          <th>Type</th>
          <th>Comment</th>
          <th>Action</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John Doe</td>
          <td>May 15-17</td>
          <td>Annual</td>
          <td><textarea placeholder="Add comment" id="comment1"></textarea><div class="error" id="error1"></div></td>
          <td>
            <button onclick="approveLeave(1)">Approve</button>
            <button onclick="rejectLeave(1)">Reject</button>
          </td>
          <td id="status1">Pending</td>
        </tr>
        <tr>
          <td>Jane Smith</td>
          <td>May 20</td>
          <td>Sick</td>
          <td><textarea placeholder="Add comment" id="comment2"></textarea><div class="error" id="error2"></div></td>
          <td>
            <button onclick="approveLeave(2)">Approve</button>
            <button onclick="rejectLeave(2)">Reject</button>
          </td>
          <td id="status2">Pending</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script>
 
  function toggleDepartments() {
    var deptList = document.getElementById('departmentList');
    if (deptList.style.display === 'block') {
      deptList.style.display = 'none';
    } else {
      deptList.style.display = 'block';
    }
  }

  
  function approveLeave(row) {
    var commentBox = document.getElementById('comment' + row);
    var errorBox = document.getElementById('error' + row);
    var statusCell = document.getElementById('status' + row);

    var comment = commentBox.value.trim();
    if (comment === '') {
      errorBox.textContent = "Please add a comment before approving.";
    } else {
      errorBox.textContent = "";
      statusCell.textContent = "Approved";
      statusCell.style.color = "green";
    }
  }

 
  function rejectLeave(row) {
    var commentBox = document.getElementById('comment' + row);
    var errorBox = document.getElementById('error' + row);
    var statusCell = document.getElementById('status' + row);

    var comment = commentBox.value.trim();
    if (comment === '') {
      errorBox.textContent = "Please add a comment before rejecting.";
    } else {
      errorBox.textContent = "";
      statusCell.textContent = "Rejected";
      statusCell.style.color = "red";
    }
  }
</script>
</body>
</html>
<?php
} else {
  // Redirect non-manager users
  header("Location: UserAuth.html");
  exit();
}
?>