<?php


namespace App\models;


use App\libraries\BaseModel;

class OrderItem extends BaseModel
{
    protected string $tableName = 'OrderItems';

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }
}