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
    // All other pages require login
    requireLogin();

    switch ($page) {
        case 'books':
            $bookController->index();
            break;
        case 'books_create':
            $bookController->create();
            break;
        case 'clients':
            $clientController->index();
            break;
        case 'clients_create':
            $clientController->create();
            break;
        case 'loans':
            $loanController->index();
            break;
        case 'loan_checkout':
            $loanController->checkout();
            break;
        case 'loan_return':
            $loanController->returnBook();
            break;
        default:
            // Simple home page
            include __DIR__ . '/../app/views/layout/header.php';
            echo '<h2>Welcome to LIMS</h2><p>Use the navigation menu to manage books, clients, and loans.</p>';
            include __DIR__ . '/../app/views/layout/footer.php';
            break;
    }
}
?>
