<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Training Records</title>
  <link rel="stylesheet" href="../Asset/training.css">
</head>
<body>
  <div class="container">
    <h1>Training Records</h1>
    <p class="description">Track skill development</p>

    
    <div class="screens">
      <div class="screen-card" data-screen="catalog">Training Catalog</div>
      <div class="screen-card" data-screen="transcripts">Transcripts</div>
      <div class="screen-card" data-screen="certifications">Certification Tracker</div>
    </div>

    
    <div id="catalog" class="screen-content">
        <h2>Training Catalog</h2>
        <p>Browse and register for available training courses.</p>
        <ul id="courseList">
          <li>
            <img src="../View/Assets/c++.png" class="course-img" alt="C++" />
            <div style="font-weight:bold;">C++</div>
            <div class="course-desc">Master the basics and advanced concepts of C++ programming.</div>
            <button class="register-btn" data-course="C++">Register</button>
          </li>
          <li>
            <img src="../View/Assets/python.png" class="course-img" alt="Python" />
            <div style="font-weight:bold;">Python</div>
            <div class="course-desc">Learn Python for data science, automation, and web development.</div>
            <button class="register-btn" data-course="Python">Register</button>
          </li>
          <li>
            <img src="../View/Assets/java.png" class="course-img" alt="Java" />
            <div style="font-weight:bold;">Java</div>
            <div class="course-desc">Build robust applications and backend systems with Java.</div>
            <button class="register-btn" data-course="Java">Register</button>
          </li>
          <li>
            <img src="../View/Assets/blender.svg" class="course-img" alt="Blender" />
            <div style="font-weight:bold;">Blender</div>
            <div class="course-desc">Create 3D models, animations, and visual effects using Blender.</div>
            <button class="register-btn" data-course="Blender">Register</button>
          </li>
          <li>
            <img src="../View/Assets/unreal engine.png" class="course-img" alt="Unreal Engine" />
            <div style="font-weight:bold;">Unreal Engine</div>
            <div class="course-desc">Develop games and simulations with Unreal Engine.</div>
            <button class="register-btn" data-course="Unreal Engine">Register</button>
          </li>
        </ul>
        <div id="registerMessage" style="color:#ff4d4d;margin-top:10px;"></div>
      </div>
      

    <div id="transcripts" class="screen-content hidden">
      <h2>Transcripts</h2>
      <p>View your completed courses and scores.</p>
      <ul id="completedCourses"></ul>
      <div id="noCoursesMsg" style="color:#ff4d4d;"></div>
    </div>

    <div id="certifications" class="screen-content hidden">
      <h2>Certification Tracker</h2>
      <p>Monitor your active and expired certifications.</p>
      <button id="alertBtn">Check Expiry Alert</button>
      <button id="gapReportBtn">Skills Gap Report</button>
      <p id="expiryAlert" style="color:#ff4d4d;"></p>
      <p id="gapReport"></p>
    </div>
  </div>

  <script src="../Asset/training.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
   
    document.querySelectorAll('.register-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const course = btn.getAttribute('data-course');
            fetch('../Controller/register_training.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'course_name=' + encodeURIComponent(course)
            })
            .then(response => response.json())
            .then(data => {
                const msgDiv = document.getElementById('registerMessage');
                msgDiv.textContent = data.message;
                msgDiv.style.color = data.success ? '#27ae60' : '#ff4d4d';
                if (data.success) loadTranscripts(); 
            })
            .catch(() => {
                const msgDiv = document.getElementById('registerMessage');
                msgDiv.textContent = 'An error occurred. Please try again.';
                msgDiv.style.color = '#ff4d4d';
            });
        });
    });

   
    document.querySelector('[data-screen="transcripts"]').addEventListener('click', loadTranscripts);

    function loadTranscripts() {
      fetch('../Controller/get_transcripts.php')
        .then(response => response.json())
        .then(data => {
          const ul = document.getElementById('completedCourses');
          ul.innerHTML = '';
          if (data.success && data.transcripts.length > 0) {
            data.transcripts.forEach(function(item) {
              const li = document.createElement('li');
              li.innerHTML = `<b>${item.course_name}</b> | Registered: ${item.registered_at} | Score: <span style='color:#27ae60;'>${item.score}</span>`;
              ul.appendChild(li);
            });
            document.getElementById('noCoursesMsg').textContent = '';
          } else {
            document.getElementById('noCoursesMsg').textContent = 'No completed courses.';
          }
        });
    }

    
    // Certification Tracker buttons
    document.getElementById('alertBtn').addEventListener('click', function() {
      fetch('../Controller/check_expiry_alert.php')
        .then(response => response.json())
        .then(data => {
          const alertP = document.getElementById('expiryAlert');
          alertP.textContent = data.message;
          alertP.style.color = data.success ? '#27ae60' : '#ff4d4d';
        });
    });

    document.getElementById('gapReportBtn').addEventListener('click', function() {
      fetch('../Controller/skills_gap_report.php')
        .then(response => response.json())
        .then(data => {
          const reportP = document.getElementById('gapReport');
          reportP.textContent = data.message;
          reportP.style.color = data.success ? '#27ae60' : '#ff4d4d';
        });
    });
  });
  </script>
</body>
</html>
