<?php

namespace App\repositories\customer;

use App\models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    private Customer $model;

    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }

    public function count(string $fromDate, string $toDate): int
    {
        $sql = "SELECT count(*) FROM {$this->model->getTableName()} WHERE (registered_at BETWEEN ? AND ?)";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$fromDate, $toDate]);
        return intval($result->fetchColumn());
    }

    public function getCountByDate(string $date): int
    {
        $sql = "SELECT count(*) FROM {$this->model->getTableName()} WHERE DATE(registered_at) = ?";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$date]);
        return intval($result->fetchColumn());
    }
}