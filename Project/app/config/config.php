<?php
// Absolute paths
define('PROJECT_PATH', dirname(__DIR__, 2));        // .../Project/app -> .../Project
define('APP_PATH', PROJECT_PATH . '/app');
define('VIEW_PATH', APP_PATH . '/views');
define('BASE_URL', '/Project/public');              // adjust if your folder name is different

// Start session (needed later for login/roles)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
