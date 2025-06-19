<?php
session_start();
include_once("../Model/db.php");

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in.']);
    exit;
}

$employee_id = $_SESSION['id'];
$course_name = $_POST['course_name'] ?? '';

if ($course_name === '') {
    echo json_encode(['success' => false, 'message' => 'No course selected.']);
    exit;
}

$con = getConnection();


$stmt = $con->prepare("SELECT id FROM training_registrations WHERE employee_id = ? AND course_name = ?");
$stmt->bind_param("is", $employee_id, $course_name);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Already registered for this course.']);
    $stmt->close();
    $con->close();
    exit;
}
$stmt->close();

$stmt = $con->prepare("INSERT INTO training_registrations (employee_id, course_name, registered_at, score) VALUES (?, ?, NOW(), ROUND(RAND()*100,2))");
$stmt->bind_param("is", $employee_id, $course_name);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;
    $stmt->close();
    $stmt2 = $con->prepare("SELECT registered_at, score FROM training_registrations WHERE id = ?");
    $stmt2->bind_param("i", $last_id);
    $stmt2->execute();
    $stmt2->bind_result($registered_at, $score);
    $stmt2->fetch();
    $stmt2->close();
    echo json_encode([
        'success' => true,
        'message' => 'Registered successfully!',
        'registered_at' => $registered_at,
        'score' => $score
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Registration failed.']);
}
$stmt->close();
$con->close();
?>
