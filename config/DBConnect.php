<?php

namespace Config;

class DBConnect
{
    var $db;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $username = 'root';
        $password = 'root';
        $host = 'localhost';
        $port = '8889';
        $dbname = 'todo_app';

        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
            $option = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false
            );
            $this->db = new \PDO($dsn, $username, $password, $option);
            $this->db->exec("set names utf8");
            return $this->db;
        } catch (\PDOException $e) {
            throw new \Exception('Нет подключения к БД: ' . $e->getMessage());
        }
    }
}