<?php
// Initialize variables
$errors = [];
$success = false;

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $reason = $_POST['reason'] ?? '';
    $like_most = $_POST['like_most'] ?? '';
    $improve = $_POST['improve'] ?? '';
    $recommend = $_POST['recommend'] ?? '';
    $assets = $_POST['assets'] ?? [];
    $assets_other = $_POST['assets_other'] ?? '';
    $alumni_opt_in = isset($_POST['alumni_opt_in']) ? 'yes' : 'no';

    // Validate required fields
    if (empty($reason)) $errors[] = "Please provide a reason for leaving";
    if (empty($like_most)) $errors[] = "Please tell us what you liked most";
    if (empty($improve)) $errors[] = "Please provide suggestions for improvement";
    if (empty($recommend)) $errors[] = "Please select if you would recommend us";
    
    // Validate assets if "Other" is checked
    if (in_array('other', $assets) && empty($assets_other)) {
        $errors[] = "Please specify the other asset";
    }

    // If no errors, process the form
    if (empty($errors)) {
        $success = true;
        
        // Here you would normally:
        // 1. Save to database
        // 2. Send email notifications
        // 3. Redirect to thank you page
        
        // For now, just show success message
        include 'exitform.html';
        exit;
    }
}

// If there are errors or form wasn't submitted, show the form
include 'exitform.html';
?>