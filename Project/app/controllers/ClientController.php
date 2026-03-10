<?php
require_once __DIR__ . '/../config/config.php';

class ClientController {
    private $clientModel;

    public function __construct() {
        $this->clientModel = new ClientModel();
    }

    public function index() {
        requireLogin();
        $clients = $this->clientModel->getAll();
        include __DIR__ . '/../views/clients/list.php';
    }

    public function create() {
        requireLogin();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if ($name === '' || $email === '' || $phone === '') {
                $error = 'All fields are required.';
            } else {
                if ($this->clientModel->create($name, $email, $phone)) {
                    header('Location: index.php?page=clients');
                    exit;
                } else {
                    $error = 'Error saving client.';
                }
            }
        }

        include __DIR__ . '/../views/clients/create.php';
    }
}
?>
