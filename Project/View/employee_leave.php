
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Leave</title>
  <link rel="stylesheet" href="sidebar.css">
  <style>
    .main-content {
      margin-left: 270px;
      padding: 30px;
      color: black;
    }
    form {
      display: flex;
      flex-direction: column;
      max-width: 400px;
    }
    label, input, select, button {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <!-- Sidebar Include -->
  <?php include 'Emp_sidebar.html'; ?>

  <div class="main-content">
    <h2>Apply for Leave</h2>
    <form onsubmit="return validateEmployeeForm()">
      <label for="fromDate">From Date:</label>
      <input type="date" id="fromDate" name="fromDate">

      <label for="toDate">To Date:</label>
      <input type="date" id="toDate" name="toDate">

      <label for="leaveType">Leave Type:</label>
      <select id="leaveType" name="leaveType">
        <option value="">--Select--</option>
        <option value="Casual">Casual</option>
        <option value="Sick">Sick</option>
        <option value="Earned">Earned</option>
      </select>

      <button type="submit">Submit</button>
    </form>
  </div>

  <script>
    function validateEmployeeForm() {
      var from = document.getElementById('fromDate').value;
      var to = document.getElementById('toDate').value;
      var type = document.getElementById('leaveType').value;

      if (from === '' || to === '' || type === '') {
        alert('Please fill out all fields.');
        return false;
      }

      if (from > to) {
        alert('From date cannot be after To date.');
        return false;
      }

      return true;
    }
  </script>
</body>
</html>

