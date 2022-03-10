<?php

namespace App\repositories\order;

use App\models\Order;
use App\models\OrderItem;

class OrderRepository implements OrderRepositoryInterface
{
    private Order $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function count(string $fromDate, string $toDate): int
    {
        $sql = "SELECT count(*) FROM {$this->model->getTableName()} WHERE (purchase_date BETWEEN ? AND ?)";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$fromDate, $toDate]);
        return intval($result->fetchColumn());
    }

    public function sumPrice(string $fromDate, string $toDate): float
    {
        $orderItem = new OrderItem();
        $sql = "SELECT SUM({$orderItem->getTableName()}.quantity * {$orderItem->getTableName()}.price) AS total FROM {$this->model->getTableName()} JOIN {$orderItem->getTableName()} orderItems ON (orders.id = orderItems.order_id) where (purchase_date BETWEEN ? AND ?)";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$fromDate, $toDate]);
        return floatval($result->fetchColumn());
    }

    public function getCountByDate(string $date): int
    {
        $sql = "SELECT count(*) FROM {$this->model->getTableName()} WHERE DATE(purchase_date) = ?";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$date]);
        return intval($result->fetchColumn());
    }
}