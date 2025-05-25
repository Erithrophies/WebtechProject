<?php
include("../Model/db.php"); 

$deptResult = mysqli_query($con, "SELECT dept_id, dept_name FROM departments");
$departments = [];
while ($row = mysqli_fetch_assoc($deptResult)) {
    $departments[] = $row;
}


$sql = "
  SELECT e.id, e.username, e.type, d.dept_id, d.dept_name
  FROM employee e
  LEFT JOIN employee_department ed ON e.id = ed.employee_id
  LEFT JOIN departments d ON ed.dept_id = d.dept_id
";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Role-Based Access</title>
  <style>
    
    body {
  margin: 0;
  padding: 30px;
  background-color: #0d0d0d;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #d3d3d3;
}

h1, h3 {
  text-align: center;
  color: #8dc6ff;
  margin-bottom: 20px;
}

table {
  width: 95%;
  margin: 0 auto 40px auto;
  border-collapse: collapse;
  background-color: #1a1a1a;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
}

th, td {
  padding: 14px;
  text-align: center;
  border-bottom: 1px solid #333;
}

th {
  background-color: #222;
  color: #aaa;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 13px;
}

td {
  color: #bbb;
}

tr:hover {
  background-color: #2b2b2b;
}

select, input[type="text"], input[type="password"] {
  padding: 8px 12px;
  border-radius: 5px;
  background: #222;
  color: #eee;
  border: 1px solid #444;
  font-size: 11px;
  outline: none;
}

select:focus, input:focus {
  border-color: #6aa0ff;
}

button {
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
  font-size: 13px;
  transition: background 0.3s ease;
}

button[type="submit"] {
  background-color: #6aa0ff;
  color: white;
}

button[type="submit"]:hover {
  background-color: #508ae0;
}

.add-btn-container {
  background-color: #161616;
  padding: 20px;
  width: 90%;
  margin: 40px auto;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(255, 255, 255, 0.05);
}

.add-btn-container form {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
}

.add-btn-container button {
  background-color: #88d498;
  color: white;
  border-radius: 30px;
}

.add-btn-container button:hover {
  background-color: #6dbb7b;
}

form.delete-form {
  text-align: center;
  
}

form.delete-form button {
  background-color: #e74c3c;
}

form.delete-form button:hover {
  background-color: #c0392b;
}

button, select, input {
  transition: all 0.2s ease;
}



  </style>
</head>
<body>
  <div id="message" style="text-align:center; font-weight:bold;"></div>


<h3>Assign Roles</h3>
<table>
  <thead>
    <tr>
      <th>User ID</th>
      <th>Name</th>
      <th>Current Role</th>
      <th>New Role</th>
      <th>Department</th>
      <th colspan="2">Action</th>
      

    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
  <td><?= $row['id'] ?></td>
  <td><?= $row['username'] ?></td>
  <td id="role-<?= $row['id'] ?>"><?= $row['type'] ?></td>
  <td>
    <form action="../Controller/updateRoleDept.php" method="POST">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <select name="role" id="select-<?= $row['id'] ?>" onchange="updateRole(<?= $row['id'] ?>)">
        <option value="admin" <?= $row['type'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="manager" <?= $row['type'] == 'manager' ? 'selected' : '' ?>>Manager</option>
        <option value="hr" <?= $row['type'] == 'hr' ? 'selected' : '' ?>>HR</option>
        <option value="employee" <?= $row['type'] == 'employee' ? 'selected' : '' ?>>Employee</option>
      </select>
  </td>
  <td>
    <select name="department">
      <?php foreach ($departments as $dept): ?>
        <option value="<?= $dept['dept_id'] ?>" <?= $dept['dept_id'] == $row['dept_id'] ? 'selected' : '' ?>>
          <?= $dept['dept_name'] ?>
        </option>
      <?php endforeach; ?>
    </select>
  </td>
  <td>
      <button type="submit" onclick="return confirmUpdate(<?= $row['id'] ?>, '<?= $row['username'] ?>')">Update</button>
    </form>
  </td>
  <td>
    <form class="delete-form" action="../Controller/deleteUser.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <button type="submit">Delete</button>
    </form>
  </td>
</tr>

    <?php } ?>
  </tbody>
</table>

<div class="add-btn-container">
  <form id="addUserForm" action="../Controller/addUser.php" method="POST">
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">

    <select name="role" id="role">
      <option value="" disabled selected>Select Role</option>
      <option value="admin">Admin</option>
      <option value="manager">Manager</option>
      <option value="hr">HR</option>
      <option value="employee">Employee</option>
    </select>

    <select name="department" id="department">
      <option value="" disabled selected>Select Department</option>
      <?php foreach ($departments as $dept): ?>
        <option value="<?= $dept['dept_id'] ?>"><?= $dept['dept_name'] ?></option>
      <?php endforeach; ?>
    </select>

    <button type="submit">Add User</button>
  </form>
</div>





<script>
function updateRole(userId) {
  const newRole = document.getElementById("select-" + userId).value;
  document.getElementById("role-" + userId).innerText = newRole;
}

function confirmUpdate(userId, name) {
  const role = document.getElementById("select-" + userId).value;
  return confirm(name + "'s role will be updated to " + role + ". Proceed?");
}





document.getElementById("addUserForm").addEventListener("submit", function (e) {
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();
  const role = document.getElementById("role").value;
  const department = document.getElementById("department").value;

  if (!username || !password || !role || !department) {
    alert("Please fill out all fields before submitting.");
    e.preventDefault(); 
  }
  else{
    alert("User added successfully");
  }
});
</script>

</body>
</html>
