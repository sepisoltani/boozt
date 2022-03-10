<?php

namespace App\repositories\customer;


interface CustomerRepositoryInterface
{
    public function count(string $fromDate, string $toDate): int;

    public function getCountByDate(string $date): int;
}