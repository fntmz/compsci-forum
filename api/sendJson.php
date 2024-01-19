<?php
function sendJson($status,  $message,  $extra = array())
{
    $response = array('status' => $status);
    if ($message) $response['message'] = $message;
    echo json_encode(array_merge($response, $extra));
    exit;
}
