<?php
require_once 'models/dbconnection.php';

class Job {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function create($title, $description, $company, $location, $posted_by) {
        // Input validation
        if (empty($title) || empty($description) || empty($company) || empty($location) || empty($posted_by)) {
            throw new InvalidArgumentException("All fields are required.");
        }

        try {
            $stmt = $this->pdo->prepare("INSERT INTO jobs (title, description, company, location, posted_by) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $company, $location, $posted_by]);
            return $this->pdo->lastInsertId(); // Return the ID of the newly created job
        } catch (PDOException $e) {
            // Log the error message
            error_log($e->getMessage());
            return false; // Indicate failure
        }
    }

    public function all() {
        try {
            $sql = "SELECT j.*, u.name AS employer 
                    FROM jobs j 
                    JOIN users u ON j.posted_by = u.id";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error message
            error_log($e->getMessage());
            return []; // Return an empty array on failure
        }
    }

    public function find($id) {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("Invalid job ID.");
        }

        try {
            $stmt = $this->pdo->prepare("SELECT * FROM jobs WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error message
            error_log($e->getMessage());
            return null; // Return null if not found or on error
        }
    }

    public function update($id, $title, $description, $company, $location) {
        if (!is_numeric($id) || empty($title) || empty($description) || empty($company) || empty($location)) {
            throw new InvalidArgumentException("Invalid input.");
        }

        try {
            $stmt = $this->pdo->prepare("UPDATE jobs SET title = ?, description = ?, company = ?, location = ? WHERE id = ?");
            return $stmt->execute([$title, $description, $company, $location, $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete($id) {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("Invalid job ID.");
        }

        try {
            $stmt = $this->pdo->prepare("DELETE FROM jobs WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
