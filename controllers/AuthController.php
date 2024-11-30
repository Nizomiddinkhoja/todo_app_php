<?php

namespace Controllers;

class AuthController
{
    public function login()
    {
        $message = '';
        if (!isset($_SESSION)) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if ($username == 'admin' && $password == '123') {
                $_SESSION['logged_in'] = true;
                header('Location: /index.php');
            } else {
                $message = "Недействительные учетные данные";
            }
        }
        require 'views/login.php';
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['logged_in'])) {
            session_unset();
            session_destroy();
            session_write_close();
            setcookie(session_name(), '', 0, '/');
            $_SESSION['logged_in'] = '';
            header('Location: /index.php');
        }
    }
}
