<?php

namespace App\Http\Controllers\Retailer\Feature;

use App\Actions\AadharMobileUpdate\ProcessTransaction;
use App\Actions\AadharMobileUpdate\StoreAadharMobileUpdate;
use App\Datatables\Retailer\AdharMobileUpdateDataTable;
use App\Enums\Status;
use App\Enums\TransactionEnum;
use App\Features\AadharMobileUpdateFeature;
use App\Http\Controllers\Controller;
use App\Services\AdharMobileUpdateService;
use App\Services\ToasterService;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

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
            'url' => route('retailer.aadhar.mobileupdate.index'),
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
    public function store(Request $request,TransactionService $transactionService)
    {
        $request->validate($this->adharMobileUpdateService->rules());
        try {

           
            $amount = $request->user()->getFeeForFeature(AadharMobileUpdateFeature::getFeatureDetail());

            $transaction = $transactionService
                ->setUser($request->user())
                ->setAmount($amount)
                ->setPaymentMethod(TransactionEnum::STATUS_COMPLETE)
                ->setTransactionType(TransactionEnum::TYPE_INTERNAL)
                ->setTransactionDirection(TransactionEnum::DIRECTION_DEBIT)
                ->setVendor(TransactionEnum::VENDOR_LOCAL)
                ->setFee(0)
                ->setTax(0)
                ->setPaymentMethod(TransactionEnum::METHOD_WALLET)
                ->setStatus(TransactionEnum::STATUS_COMPLETE)
                ->setMetadata([
                    'message' => "New subbmission",
                    'feature' => "Aadhar Mobile Update"
                ])
                ->processTransaction();

            $status = $this->adharMobileUpdateService->store($request, $transaction);

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
