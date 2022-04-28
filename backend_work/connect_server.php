<?php
    // this file connects to the backend database

    $dbServername = "127.0.0.1";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "algowiz_schema";
    
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
?>