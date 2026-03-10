<?php
session_start();

define('BASE_URL', 'http://localhost/LIMS/');
define('APP_PATH', __DIR__ . '/../');

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
