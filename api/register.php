<?php
require_once("../../../mysql.php");
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $public_name = $_POST['public_name'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];

    if (
        !isset($username) ||
        !isset($public_name) ||
        !isset($password) ||
        !isset($password_confirm) ||
        !isset($email)
    ) {
        sendJson(
            422,
            'Fill all the required fields',
            array('required_fields' => array('username', 'public_name', 'password', 'password_confirm', 'email'))
        );
    }

    $username = htmlspecialchars(trim($username));
    $public_name = htmlspecialchars(trim($public_name));
    $password = trim($password);
    $password_confirm = trim($password_confirm);
    $email = trim($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sendJson(422, 'Invalid email address');
    }
    if (strlen($password) < 8) {
        sendJson(422, 'Password must be at least 8 characters long');
    }
    if (strlen($username) < 3) {
        sendJson(422, 'Username must be at least 3 characters long');
    }
    if ($password !== $password_confirm) {
        sendJson(422, 'Password and confirm password does not match');
    }

    $sql = "SELECT `email` FROM `forum_users` WHERE `email` = :email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email);
    $query->execute();
    $row_num = $query->rowCount();

    if ($row_num > 0) sendJson(422, 'Email already in use');

    $sql = "INSERT INTO `forum_users`(`username`,`public_name`,`password`,`email`) VALUES (:username, :public_name, :password, :email)";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username);
    $query->bindParam(':public_name', $public_name);
    $query->bindParam(':password', $password);
    $query->bindParam(':email', $email);
    $query->execute();
    if ($query) sendJson(201, 'Registered successfully. Login to continue');
    sendJson(500, 'Unable to handle request. Try again');
}

sendJson(405, 'Invalid Request');
