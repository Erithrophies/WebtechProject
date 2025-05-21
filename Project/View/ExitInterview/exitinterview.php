<?php
$reason = $like_most = $improve = $recommend = $assets_other = "";
$assets = [];
$alumni_opt_in = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate reason
    if (empty(trim($_POST["reason"]))) {
        $errors['reason'] = "Reason for leaving is required.";
    } else {
        $reason = htmlspecialchars($_POST["reason"]);
    }
    // Optional fields
    $like_most = isset($_POST["like_most"]) ? htmlspecialchars($_POST["like_most"]) : "";
    $improve = isset($_POST["improve"]) ? htmlspecialchars($_POST["improve"]) : "";
    // Validate recommend
    if (empty($_POST["recommend"])) {
        $errors['recommend'] = "Please select if you would recommend the company.";
    } else {
        $recommend = htmlspecialchars($_POST["recommend"]);
    }
    // At least one asset must be checked
    $assets = isset($_POST["assets"]) ? $_POST["assets"] : [];
    if (empty($assets)) {
        $errors['assets'] = "Please select at least one asset to return.";
    }
    $assets_other = isset($_POST["assets_other"]) ? htmlspecialchars($_POST["assets_other"]) : "";
    // Alumni
    $alumni_opt_in = isset($_POST["alumni_opt_in"]) ? "yes" : "";
    // If no errors, you can process/store the data here
    if (empty($errors)) {
        $success = true;
        // You can save to database or send email here if needed
        echo "<script>window.location.href='../../landingpage.html';</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exit Interview Form</title>
    <link rel="stylesheet" href="exitform.css">
</head>
<body>
    <div class="background-overlay"></div>
    <main>
        <h1>Exit Interview Form</h1>
        <?php if ($success): ?>
            <div style="color:#A0C878;text-align:center;margin-bottom:1rem;">
                Thank you for submitting your exit interview.
            </div>
        <?php endif; ?>
        <form id="exitInterviewForm" method="post" action="">
            <section>
                <h2>Standardized Questionnaire</h2>
                <label>
                    Reason for leaving:
                    <textarea name="reason"><?php echo $reason; ?></textarea>
                </label>
                <?php if(isset($errors['reason'])): ?>
                    <div style="color:#ff4d4d;"><?php echo $errors['reason']; ?></div>
                <?php endif; ?>
                <label>
                    What did you like most about working here?
                    <textarea name="like_most"><?php echo $like_most; ?></textarea>
                </label>
                <label>
                    What could we improve?
                    <textarea name="improve"><?php echo $improve; ?></textarea>
                </label>
                <label>
                    Would you recommend this company to others?
                    <select name="recommend">
                        <option value="">Select</option>
                        <option value="yes" <?php if($recommend=="yes") echo "selected"; ?>>Yes</option>
                        <option value="no" <?php if($recommend=="no") echo "selected"; ?>>No</option>
                    </select>
                </label>
                <?php if(isset($errors['recommend'])): ?>
                    <div style="color:#ff4d4d;"><?php echo $errors['recommend']; ?></div>
                <?php endif; ?>
            </section>
            <section>
                <h2>Company Asset Return Checklist</h2>
                <label><input type="checkbox" name="assets[]" value="laptop" <?php if(in_array("laptop",$assets)) echo "checked"; ?>> Laptop</label><br>
                <label><input type="checkbox" name="assets[]" value="id_card" <?php if(in_array("id_card",$assets)) echo "checked"; ?>> ID Card</label><br>
                <label><input type="checkbox" name="assets[]" value="phone" <?php if(in_array("phone",$assets)) echo "checked"; ?>> Company Phone</label><br>
                <label><input type="checkbox" name="assets[]" value="access_card" <?php if(in_array("access_card",$assets)) echo "checked"; ?>> Access Card</label><br>
                <label><input type="checkbox" name="assets[]" value="other" <?php if(in_array("other",$assets)) echo "checked"; ?>> Other (specify below)</label>
                <input type="text" name="assets_other" placeholder="Other asset" value="<?php echo $assets_other; ?>">
                <?php if(isset($errors['assets'])): ?>
                    <div style="color:#ff4d4d;"><?php echo $errors['assets']; ?></div>
                <?php endif; ?>
            </section>
            <section>
                <h2>Alumni Network</h2>
                <label>
                    <input type="checkbox" name="alumni_opt_in" value="yes" <?php if($alumni_opt_in=="yes") echo "checked"; ?>>
                    I would like to join the company alumni network
                </label>
            </section>
            <button type="submit">Submit Exit Interview</button>
        </form>
    </main>
</body>
</html>
