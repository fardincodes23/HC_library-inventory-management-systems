<?php
require_once APP_PATH . '/config/database.php';
require_once APP_PATH . '/models/BookModel.php';

class BookController
{

    private BookModel $model;

    public function __construct()
    {
        // Why: use the shared mysqli from database.php
        global $mysqli;
        $this->model = new BookModel($mysqli);
    }
    private function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    // GET /index.php?controller=book&action=index
    // Shows main inventory list
    public function index(): void
    {
        $this->requireLogin();
        $books = $this->model->getAll();
        include VIEW_PATH . '/books/list.php';
    }

    // GET+POST /index.php?controller=book&action=create
    // Shows form and handles “add book”
    public function create(): void
    {
        $this->requireLogin();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title     = trim($_POST['title'] ?? '');
            $type      = trim($_POST['type'] ?? '');
            $publisher = trim($_POST['publisher'] ?? '');

            if ($title !== '' && $type !== '' && $publisher !== '') {
                $this->model->create($title, $type, $publisher);
                header('Location: index.php?controller=book&action=index');
                exit;
            } else {
                $error = 'All fields are required.';
            }
        }

        include VIEW_PATH . '/books/create.php';
    }
}
