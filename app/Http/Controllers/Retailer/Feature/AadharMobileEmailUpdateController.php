<?php

namespace App\Http\Controllers\Retailer\Feature;

use App\Datatables\Retailer\AdharMobileEmailUpdateDataTable;
use App\Http\Controllers\Controller;
use App\Services\AdharMobileEmailUpdateService;
use App\Services\ToasterService;
use Exception;
use Illuminate\Http\Request;

class AadharMobileEmailUpdateController extends Controller
{
    protected $adharMobileEmailUpdateService;
    public function __construct(AdharMobileEmailUpdateService $adharMobileEmailUpdateService)
    {
        $this->adharMobileEmailUpdateService = $adharMobileEmailUpdateService;
    }
    public function index(Request $request, AdharMobileEmailUpdateDataTable $adharMobileEmailUpdateDataTable)
    {
        if ($request->expectsJson()) {
            return $adharMobileEmailUpdateDataTable->get();
        }
        return view('services.aadhar.mobile-email.index', [
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
        return view('services.aadhar.mobile-email.create', ['action' => route('retailer.aadhar.mobileemailupdate.store')]);
    }
    public function store(Request $request)
    {
        $request->validate($this->adharMobileEmailUpdateService->rules());
        try {

            $status = $this->adharMobileEmailUpdateService->store($request);

            return redirect()->route('retailer.aadhar.mobileemailupdate.index');
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
