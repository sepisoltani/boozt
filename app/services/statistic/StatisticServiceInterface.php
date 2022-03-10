<?php


namespace App\services\statistic;


interface StatisticServiceInterface
{
    public function getCustomersCount(string $fromDate, string $toDate): int;

    public function getRevenue(string $fromDate, string $toDate): float;

    public function getOrdersCount(string $fromDate, string $toDate): int;

    public function getLastMonthOrdersCounts(): array;

    public function getLastMonthCustomersCounts(): array;
}