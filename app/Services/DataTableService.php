<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

abstract class DataTableService
{
    protected Model|Builder $query;

    public function __construct(Model|Builder $query)
    {
        $this->query = $query;
    }

    abstract protected function configure($dataTable);

    public function get(): JsonResponse
    {
        $dataTable = DataTables::of($this->query);
        $this->configure($dataTable);

        return $dataTable->make(true);
    }
}
