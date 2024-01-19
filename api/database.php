<?php
$hostname = 'localhost';
$username = 'acJake';
$password = 'asdf';
$database = 'acJake';
$port = 3306;
$connection = mysqli_connect($hostname, $username, $password, $database, $port);
if (mysqli_connect_errno()) {
    echo "Connection Failed - " . mysqli_connect_error();
    exit;
}
