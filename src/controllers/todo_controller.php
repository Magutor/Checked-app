<?php
// controllers/TodoController.php

require_once __DIR__ . '/../models/Todo.php';

class TodoController
{
    private $todoModel;

    public function __construct($pdo)
    {
        $this->todoModel = new Todo($pdo);
    }

    public function index($userId)
    {
        $message = '';
        
        // Procesar POST para añadir tarea
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo_add'])) {
            $todoData = [
                'title'       => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'due_date'    => $_POST['due_date'],
                'category_id' => $_POST['category_id']
            ];

            $result = $this->todoModel->addTodoByUser($userId, $todoData);

            if ($result) {
                $message = 'Tarea añadida correctamente.';
            } else {
                $message = 'Error al añadir la tarea.';
            }

                    // Redirigir para evitar reenvío de formulario al refrescar
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Obtener la lista de tareas para mostrar
        $todos = $this->todoModel->getTodosByUser($userId);
        if (!$todos) {
            $todos = [];
        }

        // Incluir la vista que muestra tanto el formulario como la lista
        include __DIR__ . '/../views/todo_list.php';
    }
}
