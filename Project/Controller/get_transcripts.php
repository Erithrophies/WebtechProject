<?php
session_start();
include_once("../Model/db.php");
header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in.']);
    exit;
}

$employee_id = $_SESSION['id'];

$con = getConnection();
$stmt = $con->prepare("SELECT course_name, registered_at, score FROM training_registrations WHERE employee_id = ? ORDER BY registered_at DESC");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$stmt->bind_result($course_name, $registered_at, $score);

$transcripts = [];
while ($stmt->fetch()) {
    $transcripts[] = [
        'course_name' => $course_name,
        'registered_at' => $registered_at,
        'score' => $score
    ];
}
$stmt->close();
$con->close();

echo json_encode(['success' => true, 'transcripts' => $transcripts]);
?>
