<?php

namespace App\controllers;

use App\libraries\BaseController;
use App\services\statistic\StatisticService;
use Carbon\Carbon;


class Home extends BaseController
{
    private StatisticService $statisticService;

    public function __construct()
    {
        $this->statisticService = new StatisticService();
    }

    public function index()
    {   //validation is required ...
        $fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : Carbon::now()->subMonth()->toDateString();
        $toDate = isset($_GET['toDate']) ? $_GET['toDate'] : Carbon::now()->toDateString();
        //call statistic service
        $numberOfCustomers = $this->statisticService->getCustomersCount($fromDate, $toDate);
        $numberOfOrders = $this->statisticService->getOrdersCount($fromDate, $toDate);
        $revenue = $this->statisticService->getRevenue($fromDate, $toDate);

        $orderChartData = $this->statisticService->getLastMonthOrdersCounts();
        $customersChartData = $this->statisticService->getLastMonthCustomersCounts();

        //create data array for view
        $data = [
            'numberOfCustomers'  => $numberOfCustomers,
            'numberOfOrders'     => $numberOfOrders,
            'revenue'            => $revenue,
            'fromDate'           => $fromDate,
            'toDate'             => $toDate,
            'orderChartData'     => json_encode($orderChartData),
            'customersChartData' => json_encode($customersChartData),
        ];
        //showing data
        $this->view('pages/home', $data);
    }
}