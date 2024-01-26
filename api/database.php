<?php

$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
);

$dsn = "mysql:host=localhost; dbname=acJake";
$username = "acJake";
$password = "asdf";

$db = new PDO($dsn, $username, $password, $option);
