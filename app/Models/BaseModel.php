<?php
declare(strict_types = 1);

namespace App\Models;

use App\Helpers\DatabaseConnect;
use PDO;

class BaseModel
{
    protected $db;

    /**
     * Connecting to the database
     */
    public function __construct()
    {
        $this->db = DatabaseConnect::connect();
    }
}