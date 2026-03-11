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
}
?>
