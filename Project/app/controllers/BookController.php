<?php
require_once __DIR__ . '/../config/config.php';

class BookController {
    private $bookModel;

    public function __construct() {
        $this->bookModel = new BookModel();
    }

    public function index() {
        // requireLogin(); // Keep commented out for public access

        $search = trim($_GET['search'] ?? '');
        $sort = $_GET['sort'] ?? 'newest'; // 🌟 NEW: Get the sort option or default to 'newest'

        if ($search !== '') {
            $books = $this->bookModel->searchBooks($search, $sort); // 🌟 Pass $sort here
        } else {
            $books = $this->bookModel->getAll($sort); // 🌟 Pass $sort here
        }

        include __DIR__ . '/../views/books/list.php';
    }
    public function create() {
        requireLogin();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $type = $_POST['type'] ?? '';
            $publisher = $_POST['publisher'] ?? '';

            // 🌟 FIX: If no supplier is sent from the form, set it to NULL instead of 0
            $supplier_id = !empty($_POST['supplier_id']) ? $_POST['supplier_id'] : null;

            if ($title && $type && $publisher) {
                // Pass the null supplier_id safely to the model
                if ($this->bookModel->create($title, $type, $publisher, $supplier_id)) {
                    header('Location: index.php?page=books');
                    exit;
                } else {
                    $error = 'Error adding book.';
                }
            } else {
                $error = 'All fields are required.';
            }
        }

        // 🌟 NEW: Fetch suppliers so the dropdown works!
        require_once __DIR__ . '/../models/SupplierModel.php';
        $supplierModel = new SupplierModel();
        $suppliers = $supplierModel->getAll();
        include __DIR__ . '/../views/books/create.php';
    }

    public function edit() {
        requireLogin();
        $id = $_GET['id'] ?? null;
        if (!$id) { header('Location: index.php?page=books'); exit; }

        $book = $this->bookModel->getById($id);
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $type = $_POST['type'] ?? '';
            $publisher = $_POST['publisher'] ?? '';

            // Add this exact same line:
            $supplier_id = !empty($_POST['supplier_id']) ? $_POST['supplier_id'] : null;

            if ($title && $type && $publisher) {
                // Make sure to pass $supplier_id to the update function!
                if ($this->bookModel->update($id, $title, $type, $publisher, $supplier_id)) {

                    header('Location: index.php?page=books');
                    exit;
                } else {
                    $error = 'Error updating book.';
                }
            } else {
                $error = 'All fields are required.';
            }
        }

        // 🌟 NEW: Fetch suppliers so the dropdown works!
        require_once __DIR__ . '/../models/SupplierModel.php';
        $supplierModel = new SupplierModel();
        $suppliers = $supplierModel->getAll();
        include __DIR__ . '/../views/books/edit.php';
    }

    public function delete() {
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            try {
                $this->bookModel->delete($_POST['id']);
            } catch (\PDOException $e) {
                // Block deletion if the book is tied to existing loan records
                if ($e->getCode() == '23000') {
                    header('Location: index.php?page=books&error=in_use');
                    exit;
                }
            }
        }
        header('Location: index.php?page=books');
        exit;
    }
}
?>
