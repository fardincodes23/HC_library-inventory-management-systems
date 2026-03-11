<?php
require_once __DIR__ . '/../config/database.php';

class LoanModel {
    private $conn;
    private $table = 'loans';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT l.*, b.title as book_title, c.name as client_name 
                  FROM " . $this->table . " l 
                  INNER JOIN books b ON l.book_id = b.id 
                  INNER JOIN clients c ON l.client_id = c.id 
                  ORDER BY l.id ASC"; // Updated to sort strictly by newest ID
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getActiveLoans() {
        $query = "SELECT l.*, b.title as book_title, c.name as client_name 
                  FROM " . $this->table . " l 
                  INNER JOIN books b ON l.book_id = b.id 
                  INNER JOIN clients c ON l.client_id = c.id 
                  WHERE l.return_date IS NULL 
                  ORDER BY l.due_date";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function checkBookAvailability($book_id) {
        $query = "SELECT COUNT(*) as count FROM " . $this->table . " WHERE book_id = :book_id AND return_date IS NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'] == 0;
    }

    public function create($book_id, $client_id, $loan_date, $due_date) {
        if (!$this->checkBookAvailability($book_id)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table . " (book_id, client_id, loan_date, due_date) VALUES (:book_id, :client_id, :loan_date, :due_date)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':book_id', $book_id);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':loan_date', $loan_date);
        $stmt->bindParam(':due_date', $due_date);

        return $stmt->execute();
    }

    public function returnBook($loan_id, $return_date) {
        $query = "UPDATE " . $this->table . " SET return_date = :return_date WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $loan_id);
        $stmt->bindParam(':return_date', $return_date);

        return $stmt->execute();
    }
}
?>
