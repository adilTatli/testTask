<?php

namespace App\Helpers;

use Config\DatabaseConfig;
use PDO;
use PDOException;

class DatabaseConnect
{
    private static $instance;
    private $db;

    /**
     * Manages database connection.
     */
    private function __construct()
    {
        $dbConfig = DatabaseConfig::getConfig();

        try {
            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}";
            $this->db = new PDO(
                $dsn,
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['options']
            );
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    /**
     * Provides a PDO database connection instance.
     *
     * @return PDO
     */
    public static function connect(): PDO
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance->db;
    }
}