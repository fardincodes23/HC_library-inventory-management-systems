<?php
require_once __DIR__ . '/../config/config.php';

class LoanController {
    private $loanModel;
    private $bookModel;
    private $clientModel;

    public function __construct() {
        $this->loanModel = new LoanModel();
        $this->bookModel = new BookModel();
        $this->clientModel = new ClientModel();
    }

    public function index() {
        requireLogin();
        $loans = $this->loanModel->getAll();
        include __DIR__ . '/../views/loans/list.php';
    }

    public function checkout() {
        requireLogin();
        $books = $this->bookModel->getAll();
        $clients = $this->clientModel->getAll();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book_id = (int)($_POST['book_id'] ?? 0);
            $client_id = (int)($_POST['client_id'] ?? 0);
            $loan_date = $_POST['loan_date'] ?? date('Y-m-d');
            $due_date = $_POST['due_date'] ?? date('Y-m-d', strtotime('+14 days'));

            if ($book_id && $client_id) {
                if ($this->loanModel->create($book_id, $client_id, $loan_date, $due_date)) {
                    header('Location: index.php?page=loans');
                    exit;
                } else {
                    $error = 'Book is not available or there was an error.';
                }
            } else {
                $error = 'Please select book and client.';
            }
        }

        include __DIR__ . '/../views/loans/checkout.php';
    }

    public function returnBook() {
        requireLogin();
        $activeLoans = $this->loanModel->getActiveLoans();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loan_id = (int)($_POST['loan_id'] ?? 0);
            $return_date = $_POST['return_date'] ?? date('Y-m-d');

            if ($loan_id) {
                if ($this->loanModel->returnBook($loan_id, $return_date)) {
                    header('Location: index.php?page=loans');
                    exit;
                } else {
                    $error = 'Error updating return date.';
                }
            } else {
                $error = 'Please select a loan.';
            }
        }

        include __DIR__ . '/../views/loans/return.php';
    }
}
?>
