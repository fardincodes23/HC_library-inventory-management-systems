<?php

class UserModel
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    // Look up a user by username for login
    public function findByUsername(string $username): ?array
    {
        $sql  = "SELECT id, username, password_hash, role FROM users WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row;
        }

        return null;
    }

    // Register a new user (role: USER by default)
    public function create(string $username, string $password, string $role = 'USER'): bool
    {
        $hash = hash('sha256', $password);

        $sql  = "INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sss', $username, $hash, $role);
        return $stmt->execute();
    }
}
