const screenButtons = document.querySelectorAll('.screen-card');
const screens = document.querySelectorAll('.screen-content');

screenButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    const screenToShow = btn.getAttribute('data-screen');
    screens.forEach(screen => {
      screen.classList.add('hidden');
    });
    document.getElementById(screenToShow).classList.remove('hidden');
  });
});


document.getElementById("alertBtn").addEventListener("click", function() {
  alert("⚠️ Alert: One of your certifications is about to expire!");
});


function registerCourse(courseName) {
    alert(`✅ You have successfully registered for ${courseName}.`);
    const completedCourses = document.getElementById("completedCourses");
    const newCourse = document.createElement("li");
    newCourse.textContent = `${courseName} – Assessment Completed`;
    completedCourses.appendChild(newCourse);
  }
  


function generateGapReport() {
  const report = document.getElementById("gapReport");
  report.textContent = "📊 Skills Gap Report: Needs improvement in JavaScript and Database Systems.";
}

// --- Training Records JS (merged from training.js) ---
document.addEventListener('DOMContentLoaded', function() {
  let registeredCourses = [];
  // Each course expires 3 months after registration
  let courseExpiries = {};

  // Example required skills for gap report
  const requiredSkills = ["C++", "Python", "Java", "Blender", "Unreal Engine", "AWS Certified", "Scrum Master"];

  // Register button logic
  document.querySelectorAll('.register-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const course = btn.getAttribute('data-course');
      if (!registeredCourses.includes(course)) {
        registeredCourses.push(course);
        // Set expiry date 3 months from now
        const now = new Date();
        const expiry = new Date(now.setMonth(now.getMonth() + 3));
        courseExpiries[course] = expiry.toISOString().split('T')[0];
        document.getElementById('registerMessage').textContent = `You have registered for ${course}.`;
        updateTranscripts();
      } else {
        document.getElementById('registerMessage').textContent = `You have already registered for ${course}.`;
      }
    });
  });

  // Update transcripts section
  function updateTranscripts() {
    const completedCourses = document.getElementById('completedCourses');
    const noCoursesMsg = document.getElementById('noCoursesMsg');
    completedCourses.innerHTML = "";
    if (registeredCourses.length === 0) {
      noCoursesMsg.textContent = "No courses registered yet.";
    } else {
      noCoursesMsg.textContent = "";
      registeredCourses.forEach(function(course) {
        // For demo, assign a random score
        const score = Math.floor(Math.random() * 21) + 80; // 80-100
        const expiry = courseExpiries[course] ? ` (Expires: ${courseExpiries[course]})` : "";
        const li = document.createElement('li');
        li.textContent = `${course} - Score: ${score}${expiry}`;
        completedCourses.appendChild(li);
      });
    }
  }

  // Tab switching logic for screens
  document.querySelectorAll('.screen-card').forEach(function(card) {
    card.addEventListener('click', function() {
      document.querySelectorAll('.screen-content').forEach(function(content) {
        content.classList.add('hidden');
      });
      document.getElementById(card.getAttribute('data-screen')).classList.remove('hidden');
      // Update transcripts when switching to it
      if (card.getAttribute('data-screen') === 'transcripts') {
        updateTranscripts();
      }
    });
  });

  // Expiry alert for registered courses
  document.getElementById('alertBtn').addEventListener('click', function() {
    if (registeredCourses.length === 0) {
      alert("No registered courses.");
      return;
    }
    let msg = "Registered courses and their expiry dates:\n";
    registeredCourses.forEach(course => {
      msg += `${course}: ${courseExpiries[course]}\n`;
    });
    alert(msg.trim());
  });

  // Skills gap report
  document.getElementById('gapReportBtn').addEventListener('click', function() {
    // Use registeredCourses as completed skills
    const missing = requiredSkills.filter(skill => !registeredCourses.includes(skill));
    const gapReport = document.getElementById('gapReport');
    if (missing.length > 0) {
      gapReport.textContent = "Skills gap: " + missing.join(", ");
      gapReport.style.color = "#ff4d4d";
    } else {
      gapReport.textContent = "No skills gap. All required skills are covered!";
      gapReport.style.color = "#A0C878";
    }
  });
});
// ...add any other JS for this page below...
