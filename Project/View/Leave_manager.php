<?php
//session_start();
 include '../Controller/manager_leaveC.php';

if (isset($_SESSION['type']) && $_SESSION['type'] === 'manager') {
 
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
  <?php foreach ($leaveRequests as $index => $leave): ?>
  <tr>
  <form method="post" action="../Controller/manager_leaveC.php" onsubmit="return check()">
    <input type="hidden" name="leave_id" value="<?php echo $leave['id']; ?>">
    <td><?php echo $leave['employee_name']; ?></td>
    <td><?php echo $leave['from_date']; ?> to <?php echo $leave['to_date']; ?></td>
    <td><?php echo $leave['leave_type']; ?></td>
    <td>
      <textarea placeholder="Add comment" id="comment" name="manager_comment"><?php echo isset($leave['manager_comment']) ? $leave['manager_comment'] : ''; ?></textarea>
      <i><p id="msg" class="msg"></p></i>
    </td>
    <td>
      <button type="submit" name="action" value="Approved" >Approve</button>
      <button type="submit" name="action" value="Rejected">Reject</button>
    </td>
    <td id="status"><?php echo $leave['status']; ?></td>
  </form>
</tr>

  <?php endforeach; ?>
</tbody>


    </table>
  </div>
</div>

<script>
  
           document.getElementById("comment").oninput = function () {
            document.getElementById("msg").innerHTML = "";
        };


        function check() {
            let commment = document.getElementById('comment').value;
            let msg = document.getElementById('msg');

            if (comment === "") {
                msg.innerHTML = "Please add a comment ";
                return false;
            }

            return true;
        }
</script>

  
</script>
</body>
</html>
<?php
} else {
 
  header("Location: UserAuth.html");
  exit();
}
?>