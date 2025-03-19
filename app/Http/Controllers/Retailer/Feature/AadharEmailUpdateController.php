<?php

namespace App\Http\Controllers\Retailer\Feature;

use App\Datatables\Retailer\AdharEmailUpdateDataTable;
use App\Http\Controllers\Controller;
use App\Models\AadharMobileEmailUpdate;
use App\Services\AdharEmailUpdateService;
use App\Services\ToasterService;
use Exception;
use Illuminate\Http\Request;

class AadharEmailUpdateController extends Controller
{
    protected $adharEmailUpdateService;

    public function __construct(AdharEmailUpdateService $adharEmailUpdateService)
    {
        $this->adharEmailUpdateService = $adharEmailUpdateService;
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $datatable = new AdharEmailUpdateDataTable();
            return $datatable->get();
        }

        return view('services.aadhar.email.index', [
            'url' => route('retailer.aadhar.emailupdate.index'),
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
        return view('services.aadhar.email.create', [
            'action' => route('retailer.aadhar.emailupdate.store')
        ]);
    }
    public function store(Request $request)
    {
        $request->validate($this->adharEmailUpdateService->rules());
        try {

            $status = $this->adharEmailUpdateService->store($request);

            return redirect()->route('retailer.aadhar.emailupdate.index');
        } catch (Exception $e) {
            ToasterService::error($e->getMessage());
            return redirect()->back();
        }
    }
    public function show()
    {
    }
    public function edit(AadharMobileEmailUpdate $aadharMobileEmailUpdate)
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}
