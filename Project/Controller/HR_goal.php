<?php
//session_start();
include_once("../Model/userModel.php");

$goals = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['goal_title'])) {
        $goal_title = trim($_POST['goal_title']);
        if ($goal_title !== '') {
            addHRGoal($goal_title);
        }
        header("Location: ../View/HR_performance.php");
        exit();
    } elseif (isset($_POST['goal_id']) && isset($_POST['status'])) {
        updateHRGoalStatus($_POST['goal_id'], $_POST['status']);
        header("Location: ../View/HR_performance.php");
        exit();
    }
}

if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'hr') {
    header("Location: UserAuth.php");
    exit();
}else{
    $result = getAllHRGoals();
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $goals[] = $row;
    }
}
}

?>
