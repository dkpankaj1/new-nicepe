<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Datatables\SuperDistributor\DistributorDatatable;
use App\Http\Controllers\Controller;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.   
     */
    public function index(Request $request, DistributorDatatable $datatable)
    {
        if ($request->expectsJson()) {
            return $datatable->get();
        }
        return view(
            'super-distributor.distributor.index',
            ['breadcrumb' => Breadcrumbs::render('superdistributor.distributors.index')]
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'super-distributor.distributor.create',
            ['breadcrumb' => Breadcrumbs::render('superdistributor.distributors.create')]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('super-distributor.distributor.show', ['breadcrumb' => Breadcrumbs::render('superdistributor.distributors.show', $id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('super-distributor.distributor.edit', ['breadcrumb' => Breadcrumbs::render('superdistributor.distributors.index', $id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
