<?php

namespace Controllers;

use Models\Task;

class TaskController
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new Task();

    }

    public function listTasks()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'username';
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

        $data = $this->taskModel->getAllTasks($page, $sort, $order);
        require 'views/task_list.php';
    }

    public function createTask()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $text = htmlspecialchars(trim($_POST['text']));
            $completed = 0;

            if ($this->taskModel->addTask($username, $email, $text, $completed)) {
                header('Location: /index.php?success=Задача создана');
            }
        }
        require 'views/task_form.php';
    }

    public function editTask()
    {
        $this->checkAuth();
        $this->checkId();
        $task = $this->taskModel->getTask($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require 'views/task_form.php';
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $text = htmlspecialchars(trim($_POST['text']));
            $completed = (int)isset($_POST['completed']);
            $admin_edited = (int)($task['text'] !== $text);

            if ($this->taskModel->updateTask($_GET['id'], $username, $email, $text, $completed, $admin_edited)) {
                header('Location: /index.php?success=Задача обновлена');
            }
        }
    }

    public function deleteTask()
    {
        $this->checkAuth();
        $this->checkId();
        $this->taskModel->deleteTask($_GET['id']);
        header('Location: /index.php?success=Задача удалена');
    }

    private function checkAuth()
    {
        if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])) {
            header('Location: /index.php?action=login&error=Нужна авторизация');
        }
    }

    private function checkId()
    {
        if (!isset($_GET['id'])) {
            header('Location: /index.php');
        }
    }
}
