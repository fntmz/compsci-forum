<?php
session_start();
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $caption = $_POST['caption'];
    $author_id = $_SESSION['id'];

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

    $sql = "INSERT INTO `forum_posts`(`caption`,`author_id`) VALUES ('$caption','$author_id')";
    $query = mysqli_query($connection, $sql);
    if ($query) sendJson(201, 'You have successfully posted.');
    sendJson(500, 'Unable to handle request.');
endif;

sendJson(405, 'Invalid Request Method. HTTP method should be POST');
