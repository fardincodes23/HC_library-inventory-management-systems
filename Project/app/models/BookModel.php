<?php
require_once __DIR__ . '/../config/database.php';

class BookModel {
    private $conn;
    private $table = 'books';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        // Updated to show the newest books first
        $query = "SELECT * FROM " . $this->table . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
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
        $query = "INSERT INTO " . $this->table . " (title, type, publisher, supplier_id) VALUES (:title, :type, :publisher, :supplier_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':publisher', $publisher);
        $stmt->bindParam(':supplier_id', $supplier_id);

        return $stmt->execute();
    }

    public function update($id, $title, $type, $publisher, $supplier_id = null) {
        $query = "UPDATE " . $this->table . " SET title = :title, type = :type, publisher = :publisher, supplier_id = :supplier_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':publisher', $publisher);
        $stmt->bindParam(':supplier_id', $supplier_id);

        return $stmt->execute();
    }

    public function delete($id) {
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
