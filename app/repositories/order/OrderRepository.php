<?php

namespace App\repositories\order;

use App\models\Order;
use App\models\OrderItem;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var Order
     */
    private Order $model;

    /**
     * OrderRepository constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return int
     */
    public function count(string $fromDate, string $toDate): int
    {
        $sql = "SELECT count(*) FROM {$this->model->getTableName()} WHERE (purchase_date BETWEEN ? AND ?)";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$fromDate, $toDate]);
        return intval($result->fetchColumn());
    }

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return float
     */
    public function sumPrice(string $fromDate, string $toDate): float
    {
        $orderItem = new OrderItem();
        $sql = "SELECT SUM(quantity * price) AS total FROM {$orderItem->getTableName()} orderItems JOIN {$this->model->getTableName()} orders ON (orders.id = orderItems.order_id) where (purchase_date BETWEEN ? AND ?)";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$fromDate, $toDate]);
        return floatval($result->fetchColumn());
    }

    /**
     * @param string $date
     * @return int
     */
    public function getCountByDate(string $date): int
    {
        $sql = "SELECT count(*) FROM {$this->model->getTableName()} WHERE DATE(purchase_date) = ?";
        $result = $this->model->getDb()->getPdo()->prepare($sql);
        $result->execute([$date]);
        return intval($result->fetchColumn());
    }
}