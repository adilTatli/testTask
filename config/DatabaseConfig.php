<?php
declare(strict_types = 1);

namespace Config;

use PDO;

class DatabaseConfig
{
    /**
     * Database Configurations
     *
     * @return array
     */
    public static function getConfig()
    {
        return [
            'host' => 'mysql',
            'dbname' => 'test',
            'username' => 'root',
            'password' => 'root',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        ];
    }
}