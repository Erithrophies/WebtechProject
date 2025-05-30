    <?php
    session_start();
     include_once("../Controller/departmentAccess.php");
     include_once("../Controller/Hr_perfomanceC.php");
     include_once("../Controller/Hr_goal.php");

    if (isset($_SESSION['type']) && $_SESSION['type'] === 'hr'){
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Performance</title>
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: Arial, sans-serif;
      background-color: rgb(249, 249, 249);
      color: #1c1f1c;
    }

    .sidebar {
      width: 250px;
      background: #85876a;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100vh;
      position: fixed;
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
      color: white;
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
      color: white;
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

    .container {
      margin-left: 250px;
      padding: 30px;
      width: calc(100% - 250px);
    }

    .tabs {
      display: flex;
      margin-bottom: 20px;
    }

    .tabs button {
      margin-right: 10px;
      padding: 10px 20px;
      background-color: #cacea1;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      font-size: 12px;
    }

    .tabs button.active {
      background-color: #85876a;
      color: white;
      font-size: 12px;
    }

    .tab-content {
      display: none;
      background-color: rgba(202, 206, 161, 0.432);
      padding: 70px;
      border-radius: 0px;
      margin-bottom: 20px;
      font-size: 15px;
    }

    .tab-content.active {
      display: block;
    }

    input, textarea, select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }

    button.submit-btn {
      background-color: #85876a;
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      font-size: 15px;
      border-radius: 0px;
    }

    ul {
      padding: 0;
      list-style-type: none;
    }

    ul li {
      
      padding: 10px;
      margin-bottom: 5px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
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
        <button>+</button>
      </div>
      <ul id="departmentList" class="department-list" style="display: block;">
        <?php if ($departmentName == "art & design"): ?>
          <li>
            <div class="circle art"></div><a href="art&design.html">art & design</a>
          </li>
        <?php elseif ($departmentName == "development"): ?>
          <li>
            <div class="circle dev"></div><a href="development.html">development</a>
          </li>
        <?php else: ?>
          <li><em>No department assigned</em></li>
        <?php endif; ?>
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

  <div class="container">

    <h1><i>Performance Management</i></h1>
    <div class="tabs">
      <button class="active" id="btn-review" onclick="showTab('review')">Review Templates</button>
      <button id="btn-feedback" onclick="showTab('feedback')">360° Feedback</button>
      <button id="btn-goals" onclick="showTab('goals')">Goal Tracking</button>
    </div>

    <<div id="review" class="tab-content active">
  <h3>Schedule a Review</h3>
  <form method="post" action="../Controller/Hr_perfomanceC.php" onsubmit="return addReview()">
    <input type="text" name="review_title" id="review_title"  placeholder="Review Title">
    <input type="date" name="review_date" id="review_date">
    <button type="submit" class="submit-btn">Schedule</button>
  </form>

  <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
      <tr style="background-color: #cacea1;">
        <th style="padding: 10px; border: 1px solid #ccc;">Review Title</th>
        <th style="padding: 10px; border: 1px solid #ccc;">Review Date</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($reviews)): ?>
        <?php foreach ($reviews as $review): ?>
          <tr>
            <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $review['review_title']; ?></td>
            <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $review['review_date']; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" style="padding: 10px; text-align: center;">No scheduled reviews yet.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>


    <div id="feedback" class="tab-content">
      <h3>Self Assessment</h3>
      <textarea id="selfFeedback" rows="4" placeholder="Write your self-assessment..."></textarea>

      <h3>Manager Evaluation</h3>
      <textarea id="managerFeedback" rows="4" placeholder="Manager's evaluation..."></textarea>

      <button class="submit-btn" onclick="submitFeedback()">Submit Feedback</button>
      <p id="feedbackMsg" style="color: green;"></p>
    </div>

    <div id="goals" class="tab-content">
      <h3>Track Goals</h3>
       <form method="post" action="../Controller/HR_goal.php" onsubmit="return addGoal()">
    <input type="text" name="goal_title" id = "goal_title" placeholder="Enter new goal">
    <button type="submit">Add Goal</button>
  </form>

  <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
      <tr style="background-color: #cacea1;">
        <th style="padding: 10px; border: 1px solid #ccc;">Goal</th>
        <th style="padding: 10px; border: 1px solid #ccc;">Status</th>
        <th style="padding: 10px; border: 1px solid #ccc;">Change Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($goals)): ?>
        <?php foreach ($goals as $goal): ?>
          <tr>
            <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $goal['goal_title']; ?></td>
            <td style="padding: 10px; border: 1px solid #ccc;"><?php echo $goal['status']; ?></td>
            <td style="padding: 10px; border: 1px solid #ccc;">
              <form method="post" action="../Controller/HR_goal .php" style="margin:0;">
                <input type="hidden" name="goal_id" value="<?php echo $goal['goal_id']; ?>">
                <?php if ($goal['status'] === 'Pending'): ?>
                  <button type="submit" name="status" value="Completed">Mark Completed</button>
                <?php else: ?>
                  <button type="submit" name="status" value="Pending">Mark Pending</button>
                <?php endif; ?>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" style="padding: 10px; text-align: center;">No goals added yet.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
    </div>
  </div>

  <script>
    function showTab(tabId) {
      const contents = document.getElementsByClassName('tab-content');
      for (let i = 0; i < contents.length; i++) {
        contents[i].classList.remove('active');
      }
      document.getElementById(tabId).classList.add('active');

      document.querySelectorAll('.tabs button').forEach(btn => btn.classList.remove('active'));
      document.getElementById('btn-' + tabId).classList.add('active');
    }

    function addReview() {
      const title = document.getElementById('review_title').value.trim();
      const date = document.getElementById('review_date').value;
      if (title == "" || date == "") {
        alert("Please fill out both title and date.");
      }
    }

    function submitFeedback() {
      const self = document.getElementById('selfFeedback').value.trim();
      const manager = document.getElementById('managerFeedback').value.trim();
      if (self && manager) {
        document.getElementById('feedbackMsg').textContent = "Feedback submitted successfully!";
        document.getElementById('selfFeedback').value = '';
        document.getElementById('managerFeedback').value = '';
      } else {
        alert("Please fill both feedback fields.");
      }
    }

    function addGoal() {
      const goal = document.getElementById('goal_title').value.trim();
      if (goal == "") {
        alert("Please enter a goal.");
      }
    }

  </script>
</body>
</html>
<?php
      
  }else{
        header('location: UserAuth.html');
    }

?>