<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $caption = $_POST['caption'];
    $post_id = $_POST['post_id'];
    $author_id = $_POST['author_id'];

    if (
        !isset($caption) ||
        !isset($post_id) ||
        !isset($author_id)
    ) :
        sendJson(
            422,
            'Please fill all the required fields & None of the fields should be empty.',
            array('required_fields' => array('caption'))
        );
    endif;

    $sql = "INSERT INTO `forum_comments`(`content`,`post_id`,`author_id`) VALUES ('$caption',$post_id,$author_id)";
    $query = mysqli_query($connection, $sql);
    if ($query) sendJson(201, 'You have successfully posted.');
    sendJson(500, 'Unable to handle request.');
endif;

sendJson(405, 'Invalid Request Method. HTTP method should be POST');
