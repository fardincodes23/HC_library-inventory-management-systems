<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findByUsername($username) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function verifyPassword($inputPassword, $hashedPassword) {
        // Using SHA-256 as per design document
        return hash('sha256', $inputPassword) === $hashedPassword;
    }

    public function create($username, $password, $role = 'USER') {
        $query = "INSERT INTO " . $this->table . " (username, password_hash, role) VALUES (:username, :password_hash, :role)";
        $stmt = $this->conn->prepare($query);

        $passwordHash = hash('sha256', $password);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_hash', $passwordHash);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }
}
?>
