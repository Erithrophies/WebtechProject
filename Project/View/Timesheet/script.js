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

  
  // document.getElementById("clockInBtn").addEventListener("click", clockInWithGPS);
});
