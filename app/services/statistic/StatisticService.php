<?php

namespace App\services\statistic;


use App\models\Customer;
use App\models\Order;
use App\repositories\customer\CustomerRepository;
use App\repositories\order\OrderRepository;
use Carbon\Carbon;

class StatisticService implements StatisticServiceInterface
{
    private CustomerRepository $customerRepository;
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository(new Customer());
        $this->orderRepository = new OrderRepository(new Order());
    }

    public function getCustomersCount(string $fromDate, string $toDate): int
    {
        return $this->customerRepository->count($fromDate, $toDate);
    }

    public function getRevenue(string $fromDate, string $toDate): float
    {
        return $this->orderRepository->sumPrice($fromDate, $toDate);
    }

    public function getOrdersCount(string $fromDate, string $toDate): int
    {
        return $this->orderRepository->count($fromDate, $toDate);
    }

    public function getLastMonthOrdersCounts(): array
    {
        $results = [];
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $count = $this->orderRepository->getCountByDate($date);
            array_push($results, ['date' => $date, 'count' => $count]);
        }
        $results = array_reverse($results);
        return $results;

    }

    public function getLastMonthCustomersCounts(): array
    {
        $results = [];
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $count = $this->customerRepository->getCountByDate($date);
            array_push($results, ['date' => $date, 'count' => $count]);
        }
        $results = array_reverse($results);
        return $results;
    }
}