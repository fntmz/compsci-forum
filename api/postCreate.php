<?php
session_start();
require_once("../../../mysql.php");
require_once __DIR__ . '/sendJson.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $caption = $_POST['caption'];
    $author_id = $_SESSION['id'];

    if (
        !isset($caption) ||
        !isset($author_id)
    ) {
        sendJson(
            422,
            'Fill all the required fields',
            array('required_fields' => array('caption'))
        );
    }

    $sql = "INSERT INTO `forum_posts`(`caption`,`author_id`) VALUES (:caption, :author_id)";
    $query = $db->prepare($sql);
    $query->bindParam(':caption', $caption);
    $query->bindParam(':author_id', $author_id);
    $query->execute();
    if ($query) sendJson(201, 'Posted successfully');
    sendJson(500, 'Unable to handle request. Try again');
}

sendJson(405, 'Invalid Request');
