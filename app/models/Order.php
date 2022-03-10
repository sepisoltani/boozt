<?php

namespace App\models;

use App\libraries\BaseModel;

class Order extends BaseModel
{
    /**
     * @var string
     */
    private string $tableName = 'Orders';

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }
}