<?php

require_once __DIR__ . '/../../config/database.php';

class Todo
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTodosByUser($userId)
    {
        $stmt = $this->pdo->prepare("
            SELECT todos.*, categories.name AS category_name
            FROM todos
            LEFT JOIN categories ON todos.category_id = categories.id
            WHERE user_id = ?
            ORDER BY due_date ASC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function addTodoByUser($userId, $todo)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO todos (user_id, category_id, title, description, due_date)
            VALUES (:user_id, :category_id, :title, :description, :due_date)
        ");
    
        $stmt->execute([
            ':user_id'     => $userId,
            ':category_id'=> $todo['category_id'],
            ':title'       => $todo['title'],
            ':description' => $todo['description'],
            ':due_date'    => $todo['due_date']
        ]);
    
        return $this->pdo->lastInsertId();
    }
    

}
