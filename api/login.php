<?php
session_start();
require_once("../../../mysql.php");
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (
        !isset($username) ||
        !isset($password)
    ) {
        sendJson(
            422,
            'Fill all the required fields',
            array('required_fields' => array('username', 'password'))
        );
    }

    $username = trim($username);
    $password = trim($password);

    if (strlen($password) < 8) :
        sendJson(422, 'Password must be at least 8 characters in length');
    endif;

    $sql = "SELECT * FROM `forum_users` WHERE `username` = :username";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row['id'] === null) sendJson(404, 'User not found');
    if ($password != $row['password']) sendJson(401, 'Incorrect password');

    $_SESSION['id'] = $row['id'];

    sendJson(200, 'Login successful, will go to home page', array(
        'user_id' => $row['id']
    ));
}

sendJson(405, 'Invalid Request');
