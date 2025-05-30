<?php
//session_start();
include_once("../Model/userModel.php");

$reviews = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['review_title'];
    $date = $_POST['review_date'];
    $created_by = $_SESSION['id'];

    if (addPerformanceReview($title, $date, $created_by)) {
        header("Location: ../View/HR_Performance.php?msg=success");
    } else {
        header("Location: ../View/HR_Performance.php?msg=error");
    }
    exit();
}


if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'hr') {
    header("Location: UserAuth.php");
    exit();
} else {
    $result = getAllPerformanceReviews(); 
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }
    }
}
