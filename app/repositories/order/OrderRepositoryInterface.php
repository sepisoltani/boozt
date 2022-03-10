<?php

namespace App\repositories\order;

interface OrderRepositoryInterface
{
    /**
     * @param string $fromDate
     * @param string $toDate
     * @return int
     */
    public function count(string $fromDate, string $toDate): int;

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return float
     */
    public function sumPrice(string $fromDate, string $toDate): float;

    /**
     * @param string $date
     * @return int
     */
    public function getCountByDate(string $date): int;
}