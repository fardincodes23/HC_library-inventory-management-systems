<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../app/config/config.php';


require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/BookController.php';
require_once __DIR__ . '/../app/controllers/ClientController.php';
require_once __DIR__ . '/../app/controllers/LoanController.php';


$page = $_GET['page'] ?? '';

$authController = new AuthController();
$bookController = new BookController();
$clientController = new ClientController();
$loanController = new LoanController();



if ($page === 'login') {
    $authController->login();
} elseif ($page === 'logout') {
    $authController->logout();
} else {
    // All routes below this point are processed here

    switch ($page) {
        case 'register':
            requireLogin(); // Must be logged in
            if (!isAdmin()) { // Must be an ADMIN
                die("Access Denied: Only Administrators can create new accounts.");
            }
            $authController->register();
            break;
        case 'books':
            // Publicly accessible book list
            $bookController->index();
            break;
        case 'books_create':
            requireLogin();
            $bookController->create();
            break;
        case 'clients':
            requireLogin();
            $clientController->index();
            break;
        case 'clients_create':
            requireLogin();
            $clientController->create();
            break;
        case 'loans':
            requireLogin();
            $loanController->index();
            break;
        case 'loan_checkout':
            requireLogin();
            $loanController->checkout();
            break;
        case 'loan_return':
            requireLogin();
            $loanController->returnBook();
            break;
        default:
            // 🌟 NEW: Dedicated Home Page!
            include __DIR__ . '/../app/views/home.php';
            break;
    }
}
?>
