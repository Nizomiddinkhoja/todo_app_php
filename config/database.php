<?php
$dsn = 'mysql:host=localhost;port=8889;dbname=todo_app;charset=utf8';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
