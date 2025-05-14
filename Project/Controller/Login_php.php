<?php
    session_start();
    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if($username == "" || $password == ""){
            echo "<p style='color:red;'>Null username/password!</p>";
        } else {
            setcookie('status', 'true', time()+3000, '/');
            header('location: ../View/HR_Dashboard.php');
            
        }
    } else {
        header('location: ../View/UserAuth.html');
    }
?>




