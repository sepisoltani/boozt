<?php

namespace App\services\statistic;

interface StatisticServiceInterface
{
    /**
     * @param string $fromDate
     * @param string $toDate
     * @return int
     */
    public function getCustomersCount(string $fromDate, string $toDate): int;

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return float
     */
    public function getRevenue(string $fromDate, string $toDate): float;

    /**
     * @param string $fromDate
     * @param string $toDate
     * @return int
     */
    public function getOrdersCount(string $fromDate, string $toDate): int;

    /**
     * @return array
     */
    public function getLastMonthOrdersCounts(): array;

    /**
     * @return array
     */
    public function getLastMonthCustomersCounts(): array;
}