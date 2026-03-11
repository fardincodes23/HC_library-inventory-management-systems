<?php
class SupplierController {
    private $supplierModel;

    public function __construct() {
        $this->supplierModel = new SupplierModel();
    }

    public function index() {
        requireLogin();
        $suppliers = $this->supplierModel->getAll();
        include __DIR__ . '/../views/suppliers/list.php';
    }

    public function create() {
        requireLogin();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if ($name) {
                if ($this->supplierModel->create($name, $email, $phone)) {
                    header('Location: index.php?page=suppliers');
                    exit;
                } else {
                    $error = 'Error adding supplier.';
                }
            } else {
                $error = 'Company Name is required.';
            }
        }
        include __DIR__ . '/../views/suppliers/create.php';
    }

    public function edit() {
        requireLogin();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?page=suppliers'); exit; }

        $supplier = $this->supplierModel->getById($id);
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if ($name) {
                if ($this->supplierModel->update($id, $name, $email, $phone)) {
                    header('Location: index.php?page=suppliers');
                    exit;
                } else {
                    $error = 'Error updating supplier.';
                }
            } else {
                $error = 'Company Name is required.';
            }
        }
        include __DIR__ . '/../views/suppliers/edit.php';
    }

    public function delete() {
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            try {
                $this->supplierModel->delete($_POST['id']);
            } catch (\PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: index.php?page=suppliers&error=in_use');
                    exit;
                }
            }
        }
        header('Location: index.php?page=suppliers');
        exit;
    }
}
?>