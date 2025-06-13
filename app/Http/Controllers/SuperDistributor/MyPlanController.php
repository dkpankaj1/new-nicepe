<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Http\Controllers\BaseMyPlanController;

class MyPlanController extends BaseMyPlanController
{
    protected function setRoutes(): void
    {
        $this->routes = [
            'index' => 'superdistributor.myplan.index',
            'activation' => 'superdistributor.myplan.activation'
        ];
    }

    protected function setBreadcrumbs(): void
    {
        $this->breadcrumbs = [
            'index' => 'superdistributor.myplan.index',
            'activation' => 'superdistributor.myplan.activation'
        ];
    }
}
