<?php

namespace App\controllers;

use App\libraries\BaseController;
use App\services\statistic\StatisticService;
use Carbon\Carbon;


class Home extends BaseController
{
    /**
     * @var StatisticService
     */
    private StatisticService $statisticService;

    /**
     * Home constructor.
     */
    public function __construct()
    {
        $this->statisticService = new StatisticService();
    }

    public function index()
    {   //TODO : validate form data
        $fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : Carbon::now()->subMonth()->toDateString();
        $toDate = isset($_GET['toDate']) ? $_GET['toDate'] : Carbon::now()->toDateString();
        //call statistic service
        $numberOfCustomers = $this->statisticService->getCustomersCount($fromDate, $toDate);
        $numberOfOrders = $this->statisticService->getOrdersCount($fromDate, $toDate);
        $revenue = $this->statisticService->getRevenue($fromDate, $toDate);
        //call statistic service - fetching chart data - should be cached later
        //TODO : cache these queries
        $orderChartData = $this->statisticService->getLastMonthOrdersCounts();
        $customersChartData = $this->statisticService->getLastMonthCustomersCounts();
        //prepare data array for view
        $data = [
            'numberOfCustomers'  => $numberOfCustomers,
            'numberOfOrders'     => $numberOfOrders,
            'revenue'            => $revenue,
            'fromDate'           => $fromDate,
            'toDate'             => $toDate,
            'orderChartData'     => json_encode($orderChartData),
            'customersChartData' => json_encode($customersChartData),
        ];
        //pass data to view
        $this->view('pages/home', $data);
    }
}