<?php
session_start();
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (
        !isset($username) ||
        !isset($password)
    ) :
        sendJson(
            422,
            'Fill all the required fields',
            array('required_fields' => array('username', 'password'))
        );
    endif;

    $username = trim($username);
    $password = trim($password);

    if (strlen($password) < 8) :
        sendJson(422, 'Password must be at least 8 characters in length');
    endif;

    $sql = "SELECT * FROM `forum_users` WHERE `username`='$username'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    if ($row === null) sendJson(404, 'User not found');
    if ($password != $row['password']) sendJson(401, 'Incorrect password');

    $_SESSION['id'] = $row['id'];

    sendJson(200, 'Login successful, will go to home page', array(
        'user_id' => $row['id']
    ));
endif;

sendJson(405, 'Invalid Request');
