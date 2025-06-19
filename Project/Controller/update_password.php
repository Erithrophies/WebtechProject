<?php
session_start();
include_once("../Model/db.php");
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in.']);
    exit;
}

$user_id = $_SESSION['id'];
$current_password = isset($_POST['current_password']) ? trim($_POST['current_password']) : '';
$new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
$confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

if ($current_password === '' || $new_password === '' || $confirm_password === '') {
    echo json_encode(['success' => false, 'message' => 'All password fields are required.']);
    exit;
}

$con = getConnection();
$stmt = $con->prepare("SELECT password FROM employee WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($db_password);
$stmt->fetch();
$stmt->close();

if ($db_password === null) {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
    $con->close();
    exit;
}

if ($current_password !== $db_password) {
    echo json_encode(['success' => false, 'message' => 'Current password is incorrect!']);
    $con->close();
    exit;
} elseif ($new_password !== $confirm_password) {
    echo json_encode(['success' => false, 'message' => 'New passwords do not match!']);
    $con->close();
    exit;
} elseif (strlen($new_password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters!']);
    $con->close();
    exit;
}

$stmt = $con->prepare("UPDATE employee SET password = ? WHERE id = ?");
$stmt->bind_param("si", $new_password, $user_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Password updated successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update password.']);
}
$stmt->close();
$con->close();
?>
