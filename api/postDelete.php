<?php
session_start();
require_once("../../../mysql.php");
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $post_id = $_POST['post_id'];
    $author_id = $_SESSION['id'];

    if (
        !isset($post_id) ||
        !isset($author_id)
    ) :
        sendJson(
            422,
            'Fill all the required fields',
            array('required_fields' => array('post_id'))
        );
    endif;

    $sql = "DELETE FROM `forum_posts` WHERE `id` = :post_id AND `author_id` = :author_id";
    $query = $db->prepare($sql);
    $query->bindParam(':post_id', $post_id);
    $query->bindParam(':author_id', $author_id);
    $query->execute();
    if ($query) {
        $sql = "DELETE FROM `forum_comments` WHERE `post_id` = :post_id";
        $query = $db->prepare($sql);
        $query->bindParam(':post_id', $post_id);
        $query->execute();
        sendJson(200, 'Deleted successfully');
    };
    sendJson(500, 'Unable to handle request. Try again');
endif;

sendJson(405, 'Invalid Request');
