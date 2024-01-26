<?php
session_start();
require_once __DIR__ . '/sendJson.php';

try {
    session_destroy();
} catch (Exception $e) {
    sendJson(500, 'Unable to handle request.');
}
sendJson(200, 'Logout successful! Will return to login page');
