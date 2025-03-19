<?php

namespace App\Http\Controllers\Retailer\Feature;

use App\Datatables\Retailer\AdharMobileUpdateDataTable;
use App\Http\Controllers\Controller;
use App\Services\AdharMobileUpdateService;
use App\Services\ToasterService;
use Exception;
use Illuminate\Http\Request;

class AadharMobileUpdateController extends Controller
{
    protected $adharMobileUpdateService;

    public function __construct(AdharMobileUpdateService $adharMobileUpdateService)
    {
        $this->adharMobileUpdateService = $adharMobileUpdateService;
    }
    public function index(Request $request, AdharMobileUpdateDataTable $adharMobileUpdateDataTable)
    {
        if ($request->expectsJson()) {
            return $adharMobileUpdateDataTable->get();
        }
        return view('services.aadhar.mobile.index', [
            'url' => "",
            'columns' => [
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#', 'searchable' => false, 'orderable' => false],
                ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
                ['data' => 'aadhar', 'name' => 'aadhar', 'title' => 'Aadhar'],
                ['data' => 'mobile', 'name' => 'mobile', 'title' => 'Mobile'],
                ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Create At'],
                ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Update At'],
            ]
        ]);
    }
    public function create()
    {
        return view('services.aadhar.mobile.create', ['action' => route('retailer.aadhar.mobileupdate.store')]);
    }
    public function store(Request $request)
    {
        $request->validate($this->adharMobileUpdateService->rules());
        try {

            $status = $this->adharMobileUpdateService->store($request);

            return redirect()->route('retailer.aadhar.mobileupdate.index');
        } catch (Exception $e) {
            ToasterService::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function show()
    {
    }
    public function edit()
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}
