<?php

namespace App\Http\Controllers\Distributor;
use App\Http\Controllers\BaseMyPlanController;

class MyPlanController extends BaseMyPlanController
{
    protected function setRoutes(): void
    {
        $this->routes = [
            'index' => 'distributor.myplan.index',
            'activation' => 'distributor.myplan.activation'
        ];
    }

    protected function setBreadcrumbs(): void
    {
        $this->breadcrumbs = [
            'index' => 'distributor.myplan.index',
            'activation' => 'distributor.myplan.activation'
        ];
    }
}
