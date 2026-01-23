<?php
class BookModel
{
    private mysqli $db;

    // Why: inject the db so we can reuse same connection everywhere
    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    // List all books – used for base inventory and some reports later
    public function getAll(): array
    {
        $sql    = "SELECT id, title, type, publisher FROM books ORDER BY title";
        $result = $this->db->query($sql);

        $rows = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    // Simple create – lets Admin/User add new books
    public function create(string $title, string $type, string $publisher): bool
    {
        $sql  = "INSERT INTO books (title, type, publisher) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param('sss', $title, $type, $publisher);
        return $stmt->execute();
    }
}
