<?php
session_start();
$post_content = "";
$target_department = "";
$errors = [];
$success = false;

// form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_content = isset($_POST['post-content']) ? trim($_POST['post-content']) : "";
    $target_department = isset($_POST['target-department']) ? trim($_POST['target-department']) : "";

    if ($post_content == "") {
        $errors['post-content'] = "Post content is required.";
    }
    if ($target_department == "") {
        $errors['target-department'] = "Please select a department.";
    }

    if (empty($errors)) {
        $success = true;
        // databace post test add  here
        // 
        $post_content = "";
        $target_department = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Announcements</title>
    <link rel="stylesheet" href="../Asset/announcement.css"> 
    <style>.error { color: #e74c3c; font-size: 0.98em; }</style>
</head>
<body>
    <div class="background-overlay"></div>
    <header>
        <div class="header-content">
            <img src="../View/logo2.png" alt="Company Logo" class="company-logo">
            <h1>Company Announcements</h1>
        </div>
    </header>

    <main>
        <div id="priority-alerts">
            <h2>Priority Alerts</h2>
            <div class="alert">
                <p><strong>System Maintenance:</strong> Scheduled downtime on May 10th from 1 AM to 3 AM.</p>
                <button class="acknowledge-btn">Acknowledge</button>
            </div>
            <div class="alert">
                <p><strong>Policy Update:</strong> New remote work policy effective immediately.</p>
                <button class="acknowledge-btn">Acknowledge</button>
            </div>
        </div>

        <div id="news-feed">
            <h2>News Feed</h2>
            <div id="post-form">
                <h3>Post an Update</h3>
                <?php if (!empty($errors)): ?>
                    <div class="error">
                        <?php foreach ($errors as $err) echo $err . "<br>"; ?>
                    </div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div style="color:#27ae60;font-weight:bold;margin-bottom:10px;">Your post has been submitted!</div>
                <?php endif; ?>
                <form id="post-update-form" method="post" action="">
                    <textarea id="post-content" name="post-content" placeholder="Write your update here..." required><?php echo $post_content; ?></textarea>
                    <?php if(isset($errors['post-content'])): ?>
                        <div class="error"><?php echo $errors['post-content']; ?></div>
                    <?php endif; ?>
                    <label for="target-department">Target Department:</label>
                    <select id="target-department" name="target-department">
                        <option value="">Select Department</option>
                        <option value="all" <?php if($target_department=="all") echo "selected"; ?>>All Departments</option>
                        <option value="hr" <?php if($target_department=="hr") echo "selected"; ?>>HR</option>
                        <option value="engineering" <?php if($target_department=="engineering") echo "selected"; ?>>Engineering</option>
                        <option value="sales" <?php if($target_department=="sales") echo "selected"; ?>>Sales</option>
                    </select>
                    <?php if(isset($errors['target-department'])): ?>
                        <div class="error"><?php echo $errors['target-department']; ?></div>
                    <?php endif; ?>
                    <button type="submit">Post</button>
                </form>
            </div>

            
            <div id="posts">
                <div class="post">
                    <p><strong>HR:</strong> Dont forget to submit your timesheets by Friday</p>
                    <div class="reactions">
                        <button class="like-btn">👍 Like</button>
                        <button class="comment-btn">💬 Comment</button>
                    </div>
                    <div class="comments">
                        <p><strong>Noman:</strong> Got it thanks.</p>
                    </div>
                </div>
                <div class="post">
                    <p><strong>Engineering:</strong> Code freeze starts next Monday. Please finalize your changes.</p>
                    <div class="reactions">
                        <button class="like-btn">👍 Like</button>
                        <button class="comment-btn">💬 Comment</button>
                    </div>
                    <div class="comments">
                        <p><strong>Siam:</strong> Will do.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../Asset/announcemenet.js" defer></script>
</body>
</html>
