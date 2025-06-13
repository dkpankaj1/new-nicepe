<?php

namespace App\Http\Controllers\ApiClient;

use App\Http\Controllers\BaseMyPlanController;

class MyPlanController extends BaseMyPlanController
{
    protected function setRoutes(): void
    {
        $this->routes = [
            'index' => 'apiclient.myplan.index',
            'activation' => 'apiclient.myplan.activation'
        ];
    }

    protected function setBreadcrumbs(): void
    {
        $this->breadcrumbs = [
            'index' => 'apiclient.myplan.index',
            'activation' => 'apiclient.myplan.activation'
        ];
    }
}
