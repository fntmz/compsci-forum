<?php

$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
);

$dsn = "mysql:host=localhost; dbname=instagram; charset=utf8; port=8081";
$username = "phntmz";
$password = "minh2007";

$db = new PDO($dsn, $username, $password, $option);
