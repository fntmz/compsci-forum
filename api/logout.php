<?php
session_start();
require_once __DIR__ . '/sendJson.php';

try {
    session_destroy();
} catch (Exception $e) {
    sendJson(500, 'Unable to handle request. Try again');
}
sendJson(200, 'Logout successful, will return to login page');
