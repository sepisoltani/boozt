<?php

namespace App\libraries;

abstract class BaseModel
{
    /**
     * @var Database|null
     */
    private ?Database $db;

    /**
     * BaseModel constructor.
     */
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