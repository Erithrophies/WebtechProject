<?php

$reason = $like_most = $improve = $recommend = $assets_other = "";
$assets = [];
$alumni_opt_in = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reason = trim($_POST['reason']);
    $like_most = trim($_POST['like_most']);
    $improve = trim($_POST['improve']);
    $recommend = trim($_POST['recommend']);
    $assets = isset($_POST['assets']) ? $_POST['assets'] : [];
    $assets_other = trim($_POST['assets_other']);
    $alumni_opt_in = isset($_POST['alumni_opt_in']) ? trim($_POST['alumni_opt_in']) : '';

    
    if ($reason == "" ) {
        $errors['reason'] = "Reason for leaving is required.";
    }
    if ($like_most == "" ) {
        $errors['like_most'] = "What you liked most is required.";
    }
    if ($improve == "" ) {
        $errors['improve'] = "Improvement field is required.";
    }
    if ($recommend !== 'yes' && $recommend !== 'no') {
        $errors['recommend'] = "Please select yes or no for recommendation.";
    }
    if (in_array('other', $assets) && empty($assets_other)) {
        $errors['assets_other'] = "Please specify the other asset.";
    }

   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exit Interview Form</title>
    <link rel="stylesheet" href="../View/ExitInterview/exitform.css">
    <style>.error { color: red; }</style>
</head>
<body>
    <div class="background-overlay"></div>
    <main>
        <h1>Exit Interview Form</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $err) echo $err . "<br>"; ?>
            </div>
        <?php endif; ?>
    
        <form id="exitInterviewForm" method="post" action="">
            <section>
                <h2>Standardized Questionnaire</h2>
                <label>
                    Reason for leaving:
                    <textarea name="reason"><?php echo htmlspecialchars($reason); ?></textarea>
                    <?php if(isset($errors['reason'])): ?>
                        <span class="error"><?php echo $errors['reason']; ?></span>
                    <?php endif; ?>
                </label>
                <label>
                    What did you like most about working here?
                    <textarea name="like_most"><?php echo htmlspecialchars($like_most); ?></textarea>
                    <?php if(isset($errors['like_most'])): ?>
                        <span class="error"><?php echo $errors['like_most']; ?></span>
                    <?php endif; ?>
                </label>
                <label>
                    What could we improve?
                    <textarea name="improve"><?php echo htmlspecialchars($improve); ?></textarea>
                    <?php if(isset($errors['improve'])): ?>
                        <span class="error"><?php echo $errors['improve']; ?></span>
                    <?php endif; ?>
                </label>
                <label>
                    Would you recommend this company to others?
                    <select name="recommend">
                        <option value="">Select</option>
                        <option value="yes" <?php if($recommend=="yes") echo "selected"; ?>>Yes</option>
                        <option value="no" <?php if($recommend=="no") echo "selected"; ?>>No</option>
                    </select>
                    <?php if(isset($errors['recommend'])): ?>
                        <span class="error"><?php echo $errors['recommend']; ?></span>
                    <?php endif; ?>
                </label>
            </section>
            <section>
                <h2>Company Asset Return Checklist</h2>
                <label><input type="checkbox" name="assets[]" value="laptop" <?php if(in_array("laptop",$assets)) echo "checked"; ?>> Laptop</label><br>
                <label><input type="checkbox" name="assets[]" value="id_card" <?php if(in_array("id_card",$assets)) echo "checked"; ?>> ID Card</label><br>
                <label><input type="checkbox" name="assets[]" value="phone" <?php if(in_array("phone",$assets)) echo "checked"; ?>> Company Phone</label><br>
                <label><input type="checkbox" name="assets[]" value="access_card" <?php if(in_array("access_card",$assets)) echo "checked"; ?>> Access Card</label><br>
                <label><input type="checkbox" name="assets[]" value="other" <?php if(in_array("other",$assets)) echo "checked"; ?>> Other (specify below)</label>
                <input type="text" name="assets_other" placeholder="Other asset" value="<?php echo htmlspecialchars($assets_other); ?>">
                <?php if(isset($errors['assets_other'])): ?>
                    <span class="error"><?php echo $errors['assets_other']; ?></span>
                <?php endif; ?>
            </section>
            <section>
                <h2>Alumni Network</h2>
                <label>
                    <input type="checkbox" name="alumni_opt_in" value="yes" <?php if($alumni_opt_in=="yes") echo "checked"; ?>>
                    I would like to join the company alumni network
                </label>
            </section>
            <button type="submit">Submit</button>
            <button type="button" class="submit-btn" onclick="window.location.href='../landing page/home.html'">Home</button>
        </form>
    </main>
</body>
</html>