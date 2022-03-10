<?php

namespace App\repositories\order;

interface OrderRepositoryInterface
{
    public function count(string $fromDate, string $toDate): int;

    public function sumPrice(string $fromDate, string $toDate): float;

    public function getCountByDate(string $date): int;
}