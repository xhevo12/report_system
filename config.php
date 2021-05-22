<?php

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = "reports";
$con = mysqli_connect($serverName, $username, $password, $dbName);
if (mysqli_connect_errno()) {
    echo ' Please check your database connection! ';
    exit();
}
