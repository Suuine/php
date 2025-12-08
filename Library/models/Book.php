<?php

class Book {
    private $pdo;

    public function __construct($pdo) {
        if (!$pdo instanceof PDO) {
            throw new Exception("Невірний об'єкт PDO передано в конструктор");
        }
        $this->pdo = $pdo;
    }

    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM books ORDER BY id DESC");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Помилка при отриманні всіх книг: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Помилка при отриманні книги #$id: " . $e->getMessage());
            return false;
        }
    }

    public function create($title, $author, $year) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO books (title, author, year) VALUES (?, ?, ?)");
            return $stmt->execute([$title, $author, $year]);
        } catch (PDOException $e) {
            error_log("Помилка при створенні книги: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $title, $author, $year) {
        try {
            $stmt = $this->pdo->prepare("UPDATE books SET title = ?, author = ?, year = ? WHERE id = ?");
            return $stmt->execute([$title, $author, $year, $id]);
        } catch (PDOException $e) {
            error_log("Помилка при оновленні книги #$id: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Помилка при видаленні книги #$id: " . $e->getMessage());
            return false;
        }
    }
    public function search($query) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ? ORDER BY id DESC");
            $searchTerm = "%$query%";
            $stmt->execute([$searchTerm, $searchTerm]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Помилка при пошуку книг: " . $e->getMessage());
            return [];
        }
    }

}
