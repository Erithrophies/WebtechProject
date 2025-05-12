// Handle screen switching
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

// Certification expiry alert
document.getElementById("alertBtn").addEventListener("click", function() {
  alert("⚠️ Alert: One of your certifications is about to expire!");
});

// Register for course interaction
function registerCourse(courseName) {
    alert(`✅ You have successfully registered for ${courseName}.`);
    const completedCourses = document.getElementById("completedCourses");
    const newCourse = document.createElement("li");
    newCourse.textContent = `${courseName} – Assessment Completed`;
    completedCourses.appendChild(newCourse);
  }
  

// Skills gap analysis
function generateGapReport() {
  const report = document.getElementById("gapReport");
  report.textContent = "📊 Skills Gap Report: Needs improvement in JavaScript and Database Systems.";
}
