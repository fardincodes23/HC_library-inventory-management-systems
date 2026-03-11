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

    public function edit() {
        requireLogin();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?page=clients'); exit; }

        $client = $this->clientModel->getById($id);
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';

            if ($name) {
                if ($this->clientModel->update($id, $name, $email, $phone)) {
                    header('Location: index.php?page=clients');
                    exit;
                } else {
                    $error = 'Error updating client.';
                }
            } else {
                $error = 'Name is required.';
            }
        }
        include __DIR__ . '/../views/clients/edit.php';
    }

    public function delete() {
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            try {
                $this->clientModel->delete($_POST['id']);
            } catch (\PDOException $e) {
                // SQLSTATE 23000 means "Integrity constraint violation" (Foreign Key rule blocked it)
                if ($e->getCode() == '23000') {
                    header('Location: index.php?page=clients&error=in_use');
                    exit;
                }
            }
        }
        header('Location: index.php?page=clients');
        exit;
    }
}
?>
