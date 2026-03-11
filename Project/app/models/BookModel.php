<?php
require_once __DIR__ . '/../config/database.php';

class BookModel {
    private $conn;
    private $table = 'books';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // 🌟 NEW: A safe helper function to determine the sorting order
    private function getSortSql($sortOption) {
        switch ($sortOption) {
            case 'title_asc': return "ORDER BY title ASC";
            case 'title_desc': return "ORDER BY title DESC";
            case 'oldest': return "ORDER BY id ASC";
            case 'newest':
            default: return "ORDER BY id DESC"; // Default is newest first
        }
    }

    public function getAll($sort = 'newest') {
        $orderSql = $this->getSortSql($sort);
        $query = "SELECT * FROM " . $this->table . " " . $orderSql;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function searchBooks($keyword, $sort = 'newest') {
        $orderSql = $this->getSortSql($sort);
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE title LIKE :keyword 
                  OR type LIKE :keyword 
                  OR publisher LIKE :keyword 
                  " . $orderSql;

        $stmt = $this->conn->prepare($query);

        $searchTerm = "%{$keyword}%";
        $stmt->bindParam(':keyword', $searchTerm);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($title, $type, $publisher, $supplier_id = null) {
        $query = "INSERT INTO " . $this->table . " (title, type, publisher, supplier_id) 
                  VALUES (:title, :type, :publisher, :supplier_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':publisher', $publisher);

        // 🌟 FIX: Tell PDO to specifically treat this as a NULL database value if it's empty
        $stmt->bindValue(':supplier_id', $supplier_id, $supplier_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update($id, $title, $type, $publisher, $supplier_id = null) {
        $query = "UPDATE " . $this->table . " 
                  SET title = :title, type = :type, publisher = :publisher, supplier_id = :supplier_id 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':publisher', $publisher);

        // Safely bind the NULL
        $stmt->bindValue(':supplier_id', $supplier_id, $supplier_id === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id) {
        // 1. Check if the book is currently checked out by someone
        $checkQuery = "SELECT COUNT(*) FROM loans WHERE book_id = :id AND return_date IS NULL";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':id', $id);
        $checkStmt->execute();
        $activeLoans = $checkStmt->fetchColumn();

        // If it is checked out, trigger the controller's error alert
        if ($activeLoans > 0) {
            throw new \PDOException("Book is currently checked out", 23000);
        }

        // 2. If the book is physically in the library, delete its past loan history
        $deleteHistory = "DELETE FROM loans WHERE book_id = :id";
        $histStmt = $this->conn->prepare($deleteHistory);
        $histStmt->bindParam(':id', $id);
        $histStmt->execute();

        // 3. Finally, delete the book
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getByTypeTitle() {
        return $this->getAll(); // Already sorted by type, title
    }

    public function getOverdue() {
        $query = "SELECT b.*, l.due_date, c.name as client_name 
                  FROM " . $this->table . " b 
                  INNER JOIN loans l ON b.id = l.book_id 
                  INNER JOIN clients c ON l.client_id = c.id 
                  WHERE l.return_date IS NULL AND l.due_date < CURDATE() 
                  ORDER BY l.due_date";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
