<?php
    error_reporting(E_ALL);
    $host = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "timesheet_db";

    function getConnection(){
        global $dbname;
        global $dbpass;
        global $dbuser;

        $con = mysqli_connect($GLOBALS['host'], $dbuser, $dbpass, $dbname);
        return $con;
    }
    $con = getConnection();

?>