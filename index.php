<?php
require_once 'vendor/autoload.php';

use Controllers\TaskController;
use Controllers\AuthController;

if (!isset($_SESSION)) {
    session_start();
}

$controller = new TaskController();
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
