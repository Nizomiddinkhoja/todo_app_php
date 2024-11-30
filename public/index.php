<?php
require_once '../config/database.php';
require_once '../controllers/TaskController.php';
require_once '../controllers/AuthController.php';




if (!isset($_SESSION)) {
    session_start();
}

$controller = new TaskController($pdo);
$authController = new AuthController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login':
            $authController->login();
            break;
        case 'logout':
            $authController->logout();
            break;
        case 'create':
            $controller->createTask();
            break;
        case 'edit':
            $controller->editTask();
            break;
        case 'delete':
            $controller->deleteTask();
            break;
        default:
            $controller->listTasks();
    }
} else {
    $controller->listTasks();
}
