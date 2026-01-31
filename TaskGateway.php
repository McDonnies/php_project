<?php
namespace App;

use PDO;

class TaskGateway
{
    private PDO $conn;

    public function __construct(PDO $databaseConnection)
    {
        $this->conn = $databaseConnection;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM tasks ORDER BY id DESC";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(string $title, string $description, string $status): bool
    {
        $sql = "INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?? null;
    }
    public function updateStatus(int $id, string $status): bool
    {
        $sql = "UPDATE tasks SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM tasks WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}