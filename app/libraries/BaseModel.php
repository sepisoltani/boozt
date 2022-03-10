<?php

namespace App\libraries;

class BaseModel
{

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @return Database
     */
    public function getDb(): Database
    {
        return $this->db;
    }
}