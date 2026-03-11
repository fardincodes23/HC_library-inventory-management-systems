<?php
session_start();

define('BASE_URL', 'http://localhost/LIMS/Project/');
define('APP_PATH', __DIR__ . '/../');

// ==========================================
// 🌟 NEW: INACTIVITY TIMEOUT LOGIC
// ==========================================
$timeout_duration = 60; // 1 minutes in seconds

// Only check timeout if the user is actually logged in
if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['last_activity'])) {
        // Calculate the seconds since their last action
        $elapsed_time = time() - $_SESSION['last_activity'];

        // If they exceed the time limit, log them out
        if ($elapsed_time >= $timeout_duration) {
            session_unset();     // Clear session data
            session_destroy();   // Destroy the session completely

            // Redirect to login page with a special timeout message
            header('Location: ' . BASE_URL . 'public/index.php?page=login&timeout=1');
            exit;
        }
    }
    // Update their last activity timestamp to RIGHT NOW
    $_SESSION['last_activity'] = time();
}
// ==========================================

// Autoload function for models
spl_autoload_register(function($class) {
    $file = APP_PATH . 'models/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Helper function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Helper function to require login
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . 'public/index.php?page=login');
        exit;
    }
}

// Helper function to check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN';
}
?>