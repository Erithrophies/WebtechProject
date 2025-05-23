<?php
error_reporting(E_ALL);
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $reason = trim($_POST['reason'] ?? '');
    $like_most = trim($_POST['like_most'] ?? '');
    $improve = trim($_POST['improve'] ?? '');
    $recommend = $_POST['recommend'] ?? '';
    $assets = $_POST['assets'] ?? [];
    $assets_other = trim($_POST['assets_other'] ?? '');
    $alumni = isset($_POST['alumni_opt_in']) ? 'Yes' : 'No';

    if (empty($reason) || empty($like_most) || empty($improve) || empty($recommend)) {
        echo "<script>alert('Please fill in all required fields.'); window.location.href='../ExitInterview/exitInterview.html';</script>";
        exit;
    }

    
    echo "<h2>Exit Interview Submitted Successfully</h2>";
    echo "<p><strong>Reason for leaving:</strong> " . htmlspecialchars($reason) . "</p>";
    echo "<p><strong>What you liked most:</strong> " . htmlspecialchars($like_most) . "</p>";
    echo "<p><strong>Suggestions for improvement:</strong> " . htmlspecialchars($improve) . "</p>";
    echo "<p><strong>Recommendation:</strong> " . htmlspecialchars($recommend) . "</p>";
    echo "<p><strong>Assets Returned:</strong> " . implode(", ", array_map('htmlspecialchars', $assets)) . "</p>";
    if (!empty($assets_other)) {
        echo "<p><strong>Other asset:</strong> " . htmlspecialchars($assets_other) . "</p>";
    }
    echo "<p><strong>Alumni Network:</strong> $alumni</p>";

} else {
    
    header('Location: exitInterviewForm.html');
    exit;
}
?>
