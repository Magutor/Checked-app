<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/todo_controller.php';


$controller = new TodoController($pdo);
$controller->index($_SESSION['user_id']);

