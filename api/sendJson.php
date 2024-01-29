<?php
function sendJson($status,  $message,  $extra = array())
{
    $response = array('status' => $status);
    if ($message) $response['message'] = $message;
    echo json_encode(array_merge($response, $extra));
    echo "
        <br><button onclick='window.history.back()'>Click here to return to previous page, reload to get updated information</button>
        <br><button onclick=\"window.location.href = '../home.php'\">Click here to go to the home page, reload to get updated information</button>
    ";
    exit;
}
