<?php

namespace App\models;

use App\libraries\BaseModel;

class Customer extends BaseModel
{
    private string $tableName = 'Customers';

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }
}