<?php
require_once __DIR__ . '/../config/config.php';

class BookController {
    private $bookModel;

    public function __construct() {
        $this->bookModel = new BookModel();
    }

    public function index() {
       // requireLogin();
        $books = $this->bookModel->getAll();
        include __DIR__ . '/../views/books/list.php';
    }

    public function create() {
        requireLogin();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $type = trim($_POST['type'] ?? '');
            $publisher = trim($_POST['publisher'] ?? '');
            $supplier_id = $_POST['supplier_id'] !== '' ? (int)$_POST['supplier_id'] : null;

            if ($title === '' || $type === '' || $publisher === '') {
                $error = 'All fields except supplier are required.';
            } else {
                if ($this->bookModel->create($title, $type, $publisher, $supplier_id)) {
                    header('Location: index.php?page=books');
                    exit;
                } else {
                    $error = 'Error saving book.';
                }
            }
        }

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

            if ($title && $type && $publisher) {
                if ($this->bookModel->update($id, $title, $type, $publisher)) {
                    header('Location: index.php?page=books');
                    exit;
                } else {
                    $error = 'Error updating book.';
                }
            } else {
                $error = 'All fields are required.';
            }
        }
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
