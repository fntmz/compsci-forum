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
            'Fill all the required fields',
            array('required_fields' => array('caption'))
        );
    endif;

    $sql = "INSERT INTO `forum_posts`(`caption`,`author_id`) VALUES ('$caption','$author_id')";
    $query = $db->prepare($sql)->execute();
    if ($query) sendJson(201, 'Posted successfully');
    sendJson(500, 'Unable to handle request. Try again');
endif;

sendJson(405, 'Invalid Request');
