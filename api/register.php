<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

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
    ) :
        sendJson(
            422,
            'Please fill all the required fields & None of the fields should be empty.',
            array('required_fields' => array('username', 'public_name', 'password', 'password_confirm', 'email'))
        );
    endif;

    $username = htmlspecialchars(trim($username));
    $public_name = htmlspecialchars(trim($public_name));
    $password = trim($password);
    $password_confirm = trim($password_confirm);
    $email = trim($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        sendJson(422, 'Invalid Email Address!');

    elseif (strlen($password) < 8) :
        sendJson(422, 'Your password must be at least 8 characters long!');

    elseif (strlen($username) < 3) :
        sendJson(422, 'Your username must be at least 3 characters long!');

    elseif ($password !== $password_confirm) :
        sendJson(422, 'Your password and confirm password does not match!');

    endif;
    $sql = "SELECT `email` FROM `forum_users` WHERE `email`='$email'";
    $query = $db->prepare($sql);
    $query->execute();
    $row_num = $query->rowCount();

    if ($row_num > 0) sendJson(422, 'This email already in use');

    $sql = "INSERT INTO `forum_users`(`username`,`public_name`,`password`,`email`) VALUES ('$username','$public_name','$password','$email')";
    $query = $db->prepare($sql)->execute();
    if ($query) sendJson(201, 'Registered successfully. Login to continue');
    sendJson(500, 'Unable to handle request. Try again');
endif;

sendJson(405, 'Invalid Request');
