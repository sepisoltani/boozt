<?php

namespace App\libraries;

class BaseModel
{

    private ?Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * @return Database|null
     */
    public function getDb(): ?Database
    {
        return $this->db;
    }
}