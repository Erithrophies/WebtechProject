<?php
$name = $email = $message = $captcha_input = "";
$errors = [];
$success = false;


session_start();
if (!isset($_SESSION['captcha_code']) || isset($_POST['refresh_captcha'])) {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
    $code = "";
    for ($i = 0; $i < 5; $i++) {
        $code .= $chars[rand(0, strlen($chars) - 1)];
    }
    $_SESSION['captcha_code'] = $code;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['refresh_captcha'])) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $message = isset($_POST['message']) ? trim($_POST['message']) : "";
    $captcha_input = isset($_POST['captcha']) ? trim($_POST['captcha']) : "";

    if ($name == "") {
        $errors['name'] = "Name is required.";
    }
    if ($email == "") {
        $errors['email'] = "Email is required.";
    }
    if ($message == "") {
        $errors['message'] = "Message is required.";
    }
    if ($captcha_input == "" || strtoupper($captcha_input) !== $_SESSION['captcha_code']) {
        $errors['captcha'] = "Incorrect CAPTCHA.";
     
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
        $code = "";
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[rand(0, strlen($chars) - 1)];
        }
        $_SESSION['captcha_code'] = $code;
    }

    if (empty($errors)) {
        $success = true;
        $name = $email = $message = "";
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
        $code = "";
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[rand(0, strlen($chars) - 1)];
        }
        $_SESSION['captcha_code'] = $code;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Us with CAPTCHA</title>
  <link rel="stylesheet" href="../Asset/contact.css" />
  <style>.error { color: #e74c3c; font-size: 0.98em; }</style>
</head>
<body>
  <div class="container">
    <h2>Contact Us</h2>
    <?php if ($success): ?>
      <div id="confirmation-message">
        <h3>Thank you!</h3>
        <p>Your message has been received.</p>
      </div>
    <?php else: ?>
    <form id="contact-form" method="post" action="">
      <input type="text" name="name" placeholder="Your Name" value="<?php echo $name; ?>" />
      <?php if(isset($errors['name'])): ?><div class="error"><?php echo $errors['name']; ?></div><?php endif; ?>

      <input type="email" name="email" placeholder="Your Email" value="<?php echo $email; ?>" />
      <?php if(isset($errors['email'])): ?><div class="error"><?php echo $errors['email']; ?></div><?php endif; ?>

      <textarea name="message" placeholder="Your Message"><?php echo $message; ?></textarea>
      <?php if(isset($errors['message'])): ?><div class="error"><?php echo $errors['message']; ?></div><?php endif; ?>

      <div class="captcha-container" style="margin-bottom:8px;">
        <span style="font-family:monospace;font-size:1.3em;letter-spacing:4px;background:#eee;padding:6px 14px;border-radius:7px;display:inline-block;"><?php echo $_SESSION['captcha_code']; ?></span>
        <button type="submit" name="refresh_captcha" style="margin-left:10px;padding:4px 10px;font-size:1em;">↻</button>
      </div>
      <input type="text" name="captcha" placeholder="Enter CAPTCHA" autocomplete="off" />
      <?php if(isset($errors['captcha'])): ?><div class="error"><?php echo $errors['captcha']; ?></div><?php endif; ?>

      <button type="submit">Submit</button>
    </form>
    <?php endif; ?>
  </div>
</body>
</html>
