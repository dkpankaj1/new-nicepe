<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\BalanceTransferDatatable;
use App\Enums\TransactionEnum;
use App\Enums\UserType;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\User;
use App\Services\ToasterService;
use App\Traits\AuthorizationFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BalanceTransferController extends Controller
{
    use AuthorizationFilter;
    public function __construct()
    {
        $this->applyAuthorization([
            'index' => 'balance-transfers.read',
            'show' => 'balance-transfers.read',
            'create' => 'balance-transfers.create',
            'store' => 'balance-transfers.create',
            'edit' => 'balance-transfers.edit',
            'update' => 'balance-transfers.edit',
            'destroy' => 'balance-transfers.delete',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BalanceTransferDatatable $balance_transferDatatable)
    {
        return $request->expectsJson()
            ? $balance_transferDatatable->get()
            : view('admin.balancetransfer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type', '!=', UserType::ADMIN->value)
            ->where('active', true)
            ->get();

        return view('admin.balancetransfer.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user' => ['required', 'integer', Rule::exists('users', 'id')],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'user.required' => 'User is required.',
            'user.exists' => 'The selected user does not exist.',
            'amount.required' => 'Amount is required.',
            'amount.min' => 'Amount must be at least 0.01.',
        ]);

        try {
            DB::beginTransaction();

            $user = User::lockForUpdate()->findOrFail($validatedData['user']);

            // Create new transaction
            $transaction = $this->handleTransaction(
                $user,
                $validatedData['amount'],
                TransactionEnum::DIRECTION_CREDIT->value,
                $validatedData['notes'] ?? 'Wallet credited by admin',
                $request
            );

            // Create balance transfer record
            BalanceTransfer::create([
                'from_user' => Auth::id(),
                'to_user' => $validatedData['user'],
                'transaction_id' => $transaction->id,
                'amount' => $validatedData['amount'],
                'notes' => $validatedData['notes'] ?? 'N/A',
                'status' => 'complete',
            ]);

            DB::commit();

            ToasterService::success('Transfer created successfully.');
            return redirect()->route('admin.balance-transfers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            ToasterService::error('Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BalanceTransfer $balance_transfer)
    {
        $balance_transfer->load(["fromUser", "transaction", "toUser"]);

        return view(
            'admin.balancetransfer.show',
            ['balanceTransfer' => $balance_transfer]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BalanceTransfer $balance_transfer)
    {
        $balance_transfer->load(["transaction", "toUser"]);
        return view(
            'admin.balancetransfer.edit',
            ['balanceTransfer' => $balance_transfer]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BalanceTransfer $balance_transfer)
    {
        $validatedData = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'amount.required' => 'Amount is required.',
            'amount.min' => 'Amount must be at least 0.01.',
        ]);

        try {
            DB::beginTransaction();

            $user = User::lockForUpdate()->findOrFail($balance_transfer->to_user);

            // Revert previous transaction
            $this->handleTransaction(
                $user,
                $balance_transfer->amount,
                TransactionEnum::DIRECTION_DEBIT->value,
                'Reversal of previous balance transfer',
                $request
            );

            // Create new transaction
            $newTransaction = $this->handleTransaction(
                $user,
                $validatedData['amount'],
                TransactionEnum::DIRECTION_CREDIT->value,
                $validatedData['notes'] ?? 'Wallet updated by admin',
                $request
            );

            // Update balance transfer record
            $balance_transfer->update([
                'transaction_id' => $newTransaction->id,
                'amount' => $validatedData['amount'],
                'notes' => $validatedData['notes'] ?? 'N/A',
                'status' => 'complete',
            ]);

            DB::commit();

            ToasterService::success('Transfer updated successfully.');
            return redirect()->route('admin.balance-transfers.index');
        } catch (\Exception $e) {
            DB::rollBack();
            ToasterService::error('Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BalanceTransfer $balance_transfer)
    {
        try {

            DB::beginTransaction();
            $user = User::lockForUpdate()->findOrFail($balance_transfer->to_user);
            // Revert previous transaction
            $this->handleTransaction(
                $user,
                $balance_transfer->amount,
                TransactionEnum::DIRECTION_DEBIT->value,
                'Reversal of previous balance transfer',
                request()
            );
            $balance_transfer->delete();
            DB::commit();

            return response()->json([
                'message' => 'Delete successfully.',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'An error occurred. Please try again.',
                'status' => 'error',
            ]);
        }
    }

    private function handleTransaction(User $user, float $amount, string $direction, string $message, Request $request)
    {
        $openingBalance = $user->wallet;
        $closingBalance = $direction === TransactionEnum::DIRECTION_CREDIT->value
            ? $openingBalance + $amount
            : $openingBalance - $amount;

        $transaction = $user->transactions()->create([
            'transaction_type' => TransactionEnum::TYPE_INTERNAL,
            'transaction_direction' => $direction,
            'vendor' => TransactionEnum::VENDOR_LOCAL,
            'transaction_id' => TransactionHelper::generateTransactionId(),
            'opening_balance' => $openingBalance,
            'amount' => $amount,
            'fee' => 0,
            'tax' => 0,
            'closing_balance' => $closingBalance,
            'currency_id' => TransactionHelper::getCurrency()->id,
            'payment_method' => TransactionEnum::METHOD_WALLET,
            'status' => TransactionEnum::STATUS_COMPLETE,
            'metadata' => ['message' => $message],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $user->wallet = $closingBalance;
        $user->save();

        return $transaction;
    }
}
