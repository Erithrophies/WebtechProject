<?php
session_start();
include_once("../Model/db.php");

$name = $email = "";
$errors = [];
$success = false;


if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $con = getConnection();
    $stmt = $con->prepare("SELECT username, email, password FROM employee WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($db_name, $db_email, $db_password);
    if ($stmt->fetch()) {
        $name = $db_name;
        $email = $db_email;
        $_SESSION['db_password'] = $db_password; // Store current password in session for password check
    }
    $stmt->close();
    $con->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : $name;
    $email = isset($_POST['email']) ? trim($_POST['email']) : $email;

    if ($name == "") {
        $errors['name'] = "Name is required.";
    }
    if ($email == "") {
        $errors['email'] = "Email is required.";
    }

    if (empty($errors)) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile Management</title>
  <link rel="stylesheet" href="../Asset/profileedit.css" />
</head>
<body>
  <div class="container">
    <div id="view-profile" class="profile-section" <?php if(!$success && $_SERVER["REQUEST_METHOD"] == "POST") echo 'style="display:none;"'; ?>>
      <h2>View Profile</h2>
      <img id="profile-image-view" src="../View/Assets/3.jpg" alt="Profile Image" />
      <div id="profile-details">
        <p class="name-display"><strong>Name:</strong> <?php echo $name ? $name : "Md. Abdullah Al Noman"; ?></p>
        <p class="email-display"><strong>Email:</strong> <?php echo $email ? $email : "abdullahjoy3000@gmail.com"; ?></p>
      </div>
      <button id="edit-profile-btn">Edit Profile</button>
    </div>

    <div id="edit-profile" class="edit-section" style="<?php if(!$success && $_SERVER["REQUEST_METHOD"] == "POST") { echo 'display:block;'; } else { echo 'display:none;'; } ?>">
      <h2>Edit Profile</h2>
      <form id="edit-profile-form" method="post" enctype="multipart/form-data" autocomplete="off">
        <label for="profile-image-input">
          <img id="profile-image-preview" src="../View/account.png" alt="Profile Change" style="cursor: pointer;" />
        </label>
        <input type="file" id="profile-image-input" name="profile_image" accept="image/*" style="display: none;" />

        <input type="text" id="name" name="name" placeholder="Your Name" value="<?php echo $name; ?>" required />
        <?php if(isset($errors['name'])): ?>
          <div class="error" style="color:red;"><?php echo $errors['name']; ?></div>
        <?php endif; ?>

        <input type="email" id="email" name="email" placeholder="Your Email" value="<?php echo $email; ?>" required />
        <?php if(isset($errors['email'])): ?>
          <div class="error" style="color:red;"><?php echo $errors['email']; ?></div>
        <?php endif; ?>

        <button type="submit">Save Changes</button>
        <button type="button" id="cancel-edit-btn">Cancel</button>
      </form>

      <h3>Update Password</h3>
      <form id="update-password-form" method="post" autocomplete="off">
        <input type="password" id="current-password" name="current_password" placeholder="Current Password" required />
        <input type="password" id="new-password" name="new_password" placeholder="New Password" required />
        <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm New Password" required />
        <button type="submit">Update Password</button>
        <div id="password-message" style="color:red;margin-top:8px;"></div>
      </form>
    </div>
  </div>
  <script src="../Asset/profileedit.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('update-password-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const currentPassword = document.getElementById('current-password').value;
      const newPassword = document.getElementById('new-password').value;
      const confirmPassword = document.getElementById('confirm-password').value;
      const msgDiv = document.getElementById('password-message');
      msgDiv.style.color = 'red';
      if (newPassword !== confirmPassword) {
        msgDiv.textContent = 'New passwords do not match!';
        return;
      }
      fetch('../Controller/update_password.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'current_password=' + encodeURIComponent(currentPassword) + '&new_password=' + encodeURIComponent(newPassword)
      })
      .then(response => response.json())
      .then(data => {
        msgDiv.textContent = data.message;
        msgDiv.style.color = data.success ? '#27ae60' : 'red';
        if (data.success) {
          document.getElementById('update-password-form').reset();
        }
      })
      .catch(() => {
        msgDiv.textContent = 'An error occurred. Please try again.';
      });
    });
  });
  </script>
</body>
</html>