<?php
$errors = [];
include_once('../Model/db.php');

$success = false;
$days = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
$timesheet = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($days as $day) {
        $date = isset($_POST["date_$day"]) ? trim($_POST["date_$day"]) : "";
        $clockin = isset($_POST["clockin_$day"]) ? trim($_POST["clockin_$day"]) : "";
        $clockout = isset($_POST["clockout_$day"]) ? trim($_POST["clockout_$day"]) : "";
        $project = isset($_POST["project_$day"]) ? trim($_POST["project_$day"]) : "";

        if ($date === "" && ($clockin !== "" || $clockout !== "" || $project !== "")) {
            $errors[$day] = "$day: Date is required if you fill other fields.";
        }
        if (($clockin !== "" && $clockout === "") || ($clockin === "" && $clockout !== "")) {
            $errors[$day] = "$day: Both clock in and clock out are required if one is filled.";
        }
        $timesheet[$day] = [
            "date" => $date,
            "clockin" => $clockin,
            "clockout" => $clockout,
            "project" => $project,
            "notes" => isset($_POST["notes_$day"]) ? $_POST["notes_$day"] : ""
        ];
    }
    if (empty($errors)) {
      $employee_id = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

    foreach ($days as $day) {
       $con = getConnection();
        $entry = $timesheet[$day];
        $date = $entry['date'];
        $clockin = $entry['clockin'];
        $clockout = $entry['clockout'];
        $project = $entry['project'];
        $notes = $entry['notes'];

        
        if ($date && $clockin && $clockout && $project) {
            
            $in = strtotime($clockin);
            $out = strtotime($clockout);
            $total_hours = ($in && $out && $out > $in) ? round(($out - $in) / 3600, 2) : 0;

            $stmt = $con->prepare("INSERT INTO timesheets (employee_id, day, date, clock_in, clock_out, total_hours, project_task, notes, status) VALUES (?, ?, ?, ?, ?, ?, ?, ? ,'Pending')");
            $stmt->bind_param(
                "issssdss",
                $employee_id,
                $day,
                $date,
                $clockin,
                $clockout,
                $total_hours,
                $project,
                $notes
            );
            $stmt->execute();
            $stmt->close();
        }
    }
    $con->close();
        $success = true;
       
    }
    $pending_timesheets = [];
$con = getConnection();
$sql = "SELECT t.id, t.day, t.status, t.date, username AS employee_name
        FROM timesheets t
        JOIN employee e ON t.employee_id = e.id
        WHERE t.status = 'Pending'";
$result = $con->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pending_timesheets[] = $row;
    }
}
$con->close();
if (isset($_POST['action']) && isset($_POST['timesheet_id'])) {
    $action = $_POST['action'];
    $timesheet_id = intval($_POST['timesheet_id']);
    $status = ($action === 'approve') ? 'Approved' : 'Rejected';

    $con = getConnection();
    $stmt = $con->prepare("UPDATE timesheets SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $timesheet_id);
    $stmt->execute();
    $stmt->close();
    $con->close();

    
    header("Location: timesheet.php");
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Timesheets - Employee Management System</title>
  <link rel="stylesheet" href="../Asset/timesheet.css" />
</head>
<body>
  <div class="header">
    <h1>Timesheets</h1>
    <p>Record working hours efficiently and accurately</p>
  </div>
  <section class="section">
    <div class="card-grid">
      <div class="card timesheet-card">
        <?php if (!empty($errors)): ?>
          <div class="error" style="color:red;margin-bottom:10px;">
            <?php foreach ($errors as $err) echo $err . "<br>"; ?>
          </div>
        <?php endif; ?>
        <?php if ($success): ?>
          <div style="color:#27ae60;font-weight:bold;margin-bottom:10px;">Timesheet submitted successfully!</div>
        <?php endif; ?>
        <form action="" method="post" autocomplete="off" novalidate>
        <h3>🗓️ Weekly Timesheet</h3>
        <table class="timesheet-table">
          <thead>
            <tr>
              <th>Day</th>
              <th>Date</th>
              <th>Clock In</th>
              <th>Clock Out</th>
              <th>Total Hours</th>
              <th>Project/Task</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($days as $day): ?>
            <tr>
              <td><?php echo $day; ?></td>
              <td><input type="date" name="date_<?php echo $day; ?>" value="<?php echo isset($timesheet[$day]['date']) ? $timesheet[$day]['date'] : ""; ?>" /></td>
              <td><input type="time" name="clockin_<?php echo $day; ?>" value="<?php echo isset($timesheet[$day]['clockin']) ? $timesheet[$day]['clockin'] : ""; ?>" /></td>
              <td><input type="time" name="clockout_<?php echo $day; ?>" value="<?php echo isset($timesheet[$day]['clockout']) ? $timesheet[$day]['clockout'] : ""; ?>" /></td>
              <td><input type="text" readonly /></td>
              <td>
                <select name="project_<?php echo $day; ?>">
                  <option value="">Select Project/Task</option>
                  <option value="Minecraft" <?php if(isset($timesheet[$day]['project']) && $timesheet[$day]['project']=="Minecraft") echo "selected"; ?>>Minecraft</option>
                  <option value="COD" <?php if(isset($timesheet[$day]['project']) && $timesheet[$day]['project']=="COD") echo "selected"; ?>>COD</option>
                  <option value="Bug Fix" <?php if(isset($timesheet[$day]['project']) && $timesheet[$day]['project']=="Bug Fix") echo "selected"; ?>>Bug Fix Task</option>
                  <option value="Concept Art" <?php if(isset($timesheet[$day]['project']) && $timesheet[$day]['project']=="Concept Art") echo "selected"; ?>>Concept Art Task</option>
                </select>
              </td>
              <td>
                <input type="text" name="notes_<?php echo $day; ?>" placeholder="Notes" value="<?php echo isset($timesheet[$day]['notes']) ? $timesheet[$day]['notes'] : ""; ?>" />
                <?php if(isset($errors[$day])): ?>
                  <div class="error" style="color:red;"><?php echo $errors[$day]; ?></div>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <button class="submit-timesheet">Submit Timesheet</button>
        </form>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="card-grid">
      <div class="card">
        <h3>✅ Approval Queue</h3>
        <table class="approval-table">
          <thead>
            <tr>
              <th>Employee</th>
              <th>Day</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <tbody>
          <?php if (empty($pending_timesheets)): ?>
    <tr><td colspan="4">No pending timesheets.</td></tr>
    <?php else: ?>
    <?php foreach ($pending_timesheets as $row): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['employee_name']); ?></td>
        <td><?php echo htmlspecialchars($row['day']) . " (" . htmlspecialchars($row['date']) . ")"; ?></td>
        <td><?php echo htmlspecialchars($row['status']); ?></td>
        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="timesheet_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="action" value="approve" class="approve-btn">Approve</button>
            </form>
            <form method="post" style="display:inline;">
                <input type="hidden" name="timesheet_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="action" value="reject" class="reject-btn">Reject</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
</tbody>
        </table>
      </div>
    </div>
  </section>
  <script src="../Asset/timesheet.js"></script>
</body>
</html>
