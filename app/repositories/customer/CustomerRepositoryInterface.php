<?php

namespace App\repositories\customer;


interface CustomerRepositoryInterface
{
    /**
     * @param string $fromDate
     * @param string $toDate
     * @return int
     */
    public function count(string $fromDate, string $toDate): int;

    /**
     * @param string $date
     * @return int
     */
    public function getCountByDate(string $date): int;
}