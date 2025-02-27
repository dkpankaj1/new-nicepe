<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\BaseMyPlanController;

class MyPlanController extends BaseMyPlanController
{
    protected function setRoutes(): void
    {
        $this->routes = [
            'index' => 'retailer.myplan.index',
            'activation' => 'retailer.myplan.activation'
        ];
    }

    protected function setBreadcrumbs(): void
    {
        $this->breadcrumbs = [
            'index' => 'retailer.myplan.index',
            'activation' => 'retailer.myplan.activation'
        ];
    }
}
