<?php
require_once __DIR__ . '/../config/database.php';

class SupplierModel {
    private $conn;
    private $table = "suppliers";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        // 🌟 NEW: Uses LEFT JOIN and GROUP_CONCAT to bundle book titles together!
        $query = "SELECT s.*, GROUP_CONCAT(b.title SEPARATOR ', ') as supplied_books 
                  FROM " . $this->table . " s 
                  LEFT JOIN books b ON s.id = b.supplier_id 
                  GROUP BY s.id 
                  ORDER BY s.id DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($name, $email, $phone) {
        $query = "INSERT INTO " . $this->table . " (name, email, phone) VALUES (:name, :email, :phone)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($id, $name, $email, $phone) {
        $query = "UPDATE " . $this->table . " SET name = :name, email = :email, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }

    public function delete($id) {
        // Smart deletion: Block if the supplier is tied to existing books
        $checkQuery = "SELECT COUNT(*) FROM books WHERE supplier_id = :id";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':id', $id);
        $checkStmt->execute();

        if ($checkStmt->fetchColumn() > 0) {
            throw new \PDOException("Supplier is linked to existing books", 23000);
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>