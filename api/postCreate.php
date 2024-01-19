<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $caption = $_POST['caption'];
    $author_id = $_POST['author_id'];

    if (
        !isset($caption) ||
        !isset($author_id)
    ) :
        sendJson(
            422,
            'Please fill all the required fields & None of the fields should be empty.',
            array('required_fields' => array('caption'))
        );
    endif;

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
    $query = mysqli_query($connection, $sql);
    $row_num = mysqli_num_rows($query);

    if ($row_num > 0) sendJson(422, 'This email already in use!');

    $sql = "INSERT INTO `forum_users`(`username`,`public_name`,`password`,`email`) VALUES ('$username','$public_name','$password','$email')";
    $query = mysqli_query($connection, $sql);
    if ($query) sendJson(201, 'You have successfully registered.');
    sendJson(500, 'Unable to handle request.');
endif;

sendJson(405, 'Invalid Request Method. HTTP method should be POST');
