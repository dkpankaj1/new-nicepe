<?php

namespace App\Http\Controllers\Distributor;

use App\Datatables\Distributor\RetailerDatatable;
use App\Http\Controllers\Controller;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, RetailerDatatable $datatable)
    {
        if ($request->expectsJson()) {
            return $datatable->get();
        }

        return view('shared.retailer.index',['breadcrumb' => Breadcrumbs::render('distributor.retailers.index')]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shared.retailer.create',['breadcrumb' => Breadcrumbs::render('distributor.retailers.create')]);
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
        return view('shared.retailer.show',['breadcrumb' => Breadcrumbs::render('distributor.retailers.show',$id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('shared.retailer.edit',['breadcrumb' => Breadcrumbs::render('distributor.retailers.edit',$id)]);
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
