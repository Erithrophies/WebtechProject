<?php
    if(isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if($username == "" || $password == ""){
            echo "<p style='color:red;'>Null username/password!</p>";
        } else {
            echo "<p style='color:red;'>Valid user!</p>";
        }
    } else {
        echo "<p style='color:red;'>Invalid request! Please submit the form!</p>";
    }
?>
