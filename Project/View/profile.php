<?php
$name = $email = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";

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
      <form id="update-password-form">
        <input type="password" id="current-password" placeholder="Current Password" required />
        <input type="password" id="new-password" placeholder="New Password" required />
        <input type="password" id="confirm-password" placeholder="Confirm New Password" required />
        <button type="submit">Update Password</button>
      </form>
    </div>
  </div>
  <script src="../Asset/profileedit.js"></script>
</body>
</html>