

<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/sendJson.php';

echo 'Hello World!';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (
        !isset($username) ||
        !isset($password)
    ) :
        sendJson(
            422,
            'Please fill all the required fields & None of the fields should be empty.',
            array('required_fields' => array('username', 'password'))
        );
    endif;

    $username = trim($username);
    $password = trim($password);

    if (strlen($password) < 8) :
        sendJson(422, 'Your password must be at least 8 characters long!');
    endif;

    $sql = "SELECT * FROM `forum_users` WHERE `username`='$username'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    if ($row === null) sendJson(404, 'User not found! (Username is not registered)');
    if ($password != $row['password']) sendJson(401, 'Incorrect Password!');
    sendJson(200, 'Login successful!', array(
        'user_id' => $row['id']
    ));
endif;

sendJson(405, 'Invalid Request Method. HTTP method should be POST');
