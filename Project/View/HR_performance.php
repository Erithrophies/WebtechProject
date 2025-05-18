<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Performance</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: rgb(249, 249, 249);
      color: #1c1f1c;
      margin: 0;
      padding: 0;
    }

    .container {
      margin-left: 10px;
      padding: 30px;
    }

    h1, h3 {
      color: #1c1f1c;
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
      background-color: white;
      padding: 10px;
      margin-bottom: 5px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1><i>Performance Management</i></h1>
    <div class="tabs">
      <button class="active" id="btn-review" onclick="showTab('review')">Review Templates</button>
      <button id="btn-feedback" onclick="showTab('feedback')">360° Feedback</button>
      <button id="btn-goals" onclick="showTab('goals')">Goal Tracking</button>
    </div>

    <div id="review" class="tab-content active">
      <h3>Schedule a Review</h3>
      <input type="text" id="reviewTitle" placeholder="Review Title">
      <input type="date" id="reviewDate" >
      <button class="submit-btn" onclick="addReview()">Schedule</button>
      <ul id="reviewList"></ul>
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
      <input type="text" id="goalText" placeholder="Enter goal...">
      <select id="goalStatus" style="width: 150px;">
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
      </select><br/>
      <button class="submit-btn" onclick="addGoal()">Add Goal</button>
      <ul id="goalList"></ul>
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
      const title = document.getElementById('reviewTitle').value.trim();
      const date = document.getElementById('reviewDate').value;
      if (title && date) {
        const item = document.createElement('li');
        item.textContent = `📅 ${title} — Due by ${date}`;
        document.getElementById('reviewList').appendChild(item);
        document.getElementById('reviewTitle').value = '';
        document.getElementById('reviewDate').value = '';
      } else {
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
      const goal = document.getElementById('goalText').value.trim();
      const status = document.getElementById('goalStatus').value;
      if (goal) {
        const item = document.createElement('li');
        item.textContent = `🎯 ${goal} [${status}]`;
        document.getElementById('goalList').appendChild(item);
        document.getElementById('goalText').value = '';
        document.getElementById('goalStatus').value = 'Pending';
      } else {
        alert("Enter a goal to track.");
      }
    }
  </script>
</body>
</html>
