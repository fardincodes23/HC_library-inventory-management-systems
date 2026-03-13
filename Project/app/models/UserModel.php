<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {
    private $conn;
    private $table = 'users';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getByUsername($username) {
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // FETCH_ASSOC guarantees it returns a clean array we can read
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function verifyPassword($inputPassword, $hashedPassword) {
        // Using SHA-256 as per design document
        return hash('sha256', $inputPassword) === $hashedPassword;
    }

    public function create($username, $password, $role = 'STAFF') {
        // 1. Securely scramble the password before saving
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 2. Insert into the correct password_hash column
        $query = "INSERT INTO " . $this->table . " (username, password_hash, role) VALUES (:username, :password_hash, :role)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_hash', $hash);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }
}
?>
