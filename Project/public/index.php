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
} elseif ($page === 'register') {
    // Add this new route!
    $authController->register();

} else {
    // Remove the global requireLogin() from here!

    switch ($page) {
        case 'books':
            // Let's make viewing books public for clients!
            $bookController->index();
            break;
        case 'books_create':
            requireLogin(); // Staff only
            $bookController->create();
            break;
        case 'clients':
            requireLogin(); // Staff only
            $clientController->index();
            break;
        case 'clients_create':
            requireLogin(); // Staff only
            $clientController->create();
            break;
        case 'loans':
            requireLogin(); // Staff only
            $loanController->index();
            break;
        case 'loan_checkout':
            requireLogin(); // Staff only
            $loanController->checkout();
            break;
        case 'loan_return':
            requireLogin(); // Staff only
            $loanController->returnBook();
            break;
        default:
            // Public Home Page for Clients
            include __DIR__ . '/../app/views/layout/header.php';
            echo '<h2>Welcome to the Library</h2>';
            echo '<p>Clients can browse our collection below:</p>';
            $bookController->index(); // Show the book list directly on the home page
            include __DIR__ . '/../app/views/layout/footer.php';
            break;
    }
}
?>
