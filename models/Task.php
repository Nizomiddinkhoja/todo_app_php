<?php

namespace Models;

use Config\DBConnect;

class Task
{
    private $pdo;

    public function __construct()
    {
        $dBConnect = new DBConnect();
        $this->pdo = $dBConnect->db;
    }

    public function getAllTasks($page, $sort, $order)
    {
        settype($page, 'integer');

        $limit = 3;
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT `id`, `username`, `email`, `text`, `completed`, `admin_edited` FROM tasks ORDER BY $sort $order LIMIT $limit OFFSET " . $offset);
        $stmt->execute();
        $tasks = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $total = $this->pdo->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
        $page_count = ceil($total / $limit);

        return ['tasks' => $tasks, 'total' => $total, 'page' => $page, 'page_count' => $page_count, 'order' => $order, 'sort' => $sort];
    }

    public function addTask($username, $email, $text, $completed)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (username, email, text, completed) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $text, $completed]);
    }

    public function getTask($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateTask($id, $username, $email, $text, $completed, $admin_edited)
    {
        $stmt = $this->pdo->prepare("UPDATE tasks SET username=?, email=?, text=?, completed=?, admin_edited=? WHERE id=?");
        return $stmt->execute([$username, $email, $text, $completed, $admin_edited, $id]);
    }

    public function deleteTask($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
