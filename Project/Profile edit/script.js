document.addEventListener("DOMContentLoaded", () => {
    const editProfileBtn = document.getElementById("edit-profile-btn");
    const cancelEditBtn = document.getElementById("cancel-edit-btn");
    const editProfileSection = document.getElementById("edit-profile");
    const viewProfileSection = document.getElementById("view-profile");
  
    const nameInput = document.getElementById("name");
    const emailInput = document.getElementById("email");
    const nameDisplay = document.getElementsByClassName("name-display")[0];
    const emailDisplay = document.getElementsByClassName("email-display")[0];

  
    const profileImageInput = document.getElementById("profile-image-input");
    const profileImagePreview = document.getElementById("profile-image-preview");
    const profileImageView = document.getElementById("profile-image-view");
  
   
    editProfileBtn.addEventListener("click", () => {
      editProfileSection.style.display = "block";
      viewProfileSection.style.display = "none";
      nameInput.value = nameDisplay.textContent.replace("Name:", "").trim();
      emailInput.value = emailDisplay.textContent.replace("Email:", "").trim();
    });
  
    
    cancelEditBtn.addEventListener("click", () => {
      editProfileSection.style.display = "none";
      viewProfileSection.style.display = "block";
    });
  
    
    const editProfileForm = document.getElementById("edit-profile-form");
    editProfileForm.addEventListener("submit", (e) => {
      e.preventDefault();
      nameDisplay.innerHTML = "<strong>Name:</strong> " + nameInput.value;
      emailDisplay.innerHTML = "<strong>Email:</strong> " + emailInput.value;
      
      if (profileImagePreview.src) {
        profileImageView.src = profileImagePreview.src;
      }
      alert("Profile updated successfully!");
      editProfileSection.style.display = "none";
      viewProfileSection.style.display = "block";
    });
  
    
    profileImageInput.addEventListener("change", () => {
      const file = profileImageInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          profileImagePreview.src = reader.result;
        };
        reader.readAsDataURL(file);
      }
    });
  
    
    const updatePasswordForm = document.getElementById("update-password-form");
    updatePasswordForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const current = document.getElementById("current-password").value;
      const newPass = document.getElementById("new-password").value;
      const confirm = document.getElementById("confirm-password").value;
  
      if (newPass !== confirm) {
        alert("New password and confirmation do not match!");
        return;
      }
  
      
      alert("Password updated successfully!");
      updatePasswordForm.reset();
    });
  });
  