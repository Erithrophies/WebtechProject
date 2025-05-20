document.addEventListener("DOMContentLoaded", () => {
  console.log("Timesheets page loaded");

  function clockInWithGPS() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          alert(`Clocked in at: (${position.coords.latitude}, ${position.coords.longitude})`);
        },
        (error) => {
          alert("Location access denied.");
        }
      );
    } else {
      alert("Geolocation not supported by this browser.");
    }
  }

  // Overtime threshold alert logic
  const OVERTIME_THRESHOLD = 8; // hours per day
  const table = document.querySelector('.timesheet-table');
  if (table) {
    table.addEventListener('input', (e) => {
      if (e.target.type === 'time') {
        const row = e.target.closest('tr');
        const clockIn = row.querySelectorAll('input[type="time"]')[0].value;
        const clockOut = row.querySelectorAll('input[type="time"]')[1].value;
        const totalCell = row.querySelector('input[readonly]');
        const notesCell = row.querySelector('input[placeholder="Notes"]');
        if (clockIn && clockOut) {
          const [inH, inM] = clockIn.split(':').map(Number);
          const [outH, outM] = clockOut.split(':').map(Number);
          let total = (outH + outM/60) - (inH + inM/60);
          if (total < 0) total += 24; // handle overnight
          totalCell.value = total.toFixed(2);
          if (total > OVERTIME_THRESHOLD) {
            notesCell.value = 'Overtime';
            notesCell.classList.add('overtime-notes');
          } else {
            if (notesCell.value === 'Overtime') notesCell.value = '';
            notesCell.classList.remove('overtime-notes');
          }
        } else {
          totalCell.value = '';
          if (notesCell.value === 'Overtime') notesCell.value = '';
          notesCell.classList.remove('overtime-notes');
        }
      }
    });
  }

  // document.getElementById("clockInBtn").addEventListener("click", clockInWithGPS);
});
