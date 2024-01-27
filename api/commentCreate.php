<?php
session_start();
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $caption = $_POST['caption'];
    $post_id = $_POST['post_id'];
    $author_id = $_SESSION['id'];

    if (
        !isset($caption) ||
        !isset($post_id) ||
        !isset($author_id)
    ) :
        sendJson(
            422,
            'Fill all the required fields',
            array('required_fields' => array('caption'))
        );
    endif;

    $sql = "INSERT INTO `forum_comments`(`content`,`post_id`,`author_id`) VALUES (:caption, :post_id, :author_id)";
    $query = $db->prepare($sql);
    $query->bindParam(':caption', $caption);
    $query->bindParam(':post_id', $post_id);
    $query->bindParam(':author_id', $author_id);
    $query->execute();
    if ($query) sendJson(201, 'Posted successfully');
    sendJson(500, 'Unable to handle request. Try again');
endif;

sendJson(405, 'Invalid Request');
