<?php
require_once __DIR__ . '/../app/config/config.php';

// Decide which controller + action to call
$controllerName = $_GET['controller'] ?? 'book';
$actionName     = $_GET['action'] ?? 'index';

switch ($controllerName) {
    case 'book':
      require_once APP_PATH . '/controllers/BookController.php';
        $controller = new BookController();
        break;

    default:
        http_response_code(404);
        echo 'Controller not found';
        exit;
}

if (!method_exists($controller, $actionName)) {
    http_response_code(404);
    echo 'Action not found';
    exit;
}

$controller->$actionName();
