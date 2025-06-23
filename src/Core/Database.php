<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $host = 'mysql';
        $db   = 'demo';
        $user = 'demo';
        $pass = 'demo_pass';
        $charset = 'utf8mb4';

        // 👇 ОБЯЗАТЕЛЬНО добавить `port`
        // $dsn = "mysql:host=$host;port=3306;dbname=$db;charset=$charset";
        $dsn = "mysql:host=$host;port=3306;dbname=$db;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
