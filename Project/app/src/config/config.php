<?php
define('BASE_PATH', __DIR__ . '/src');
define('BASE_URL', '/lims');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
