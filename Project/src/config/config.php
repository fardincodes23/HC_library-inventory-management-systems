<?php
define('BASE_PATH', __DIR__ . '/..');
define('BASE_URL', '/lims');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
