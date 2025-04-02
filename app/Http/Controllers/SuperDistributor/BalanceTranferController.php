<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Datatables\SuperDistributor\BalanceTransferDatatable;
use App\Enums\TransactionEnum;
use App\Enums\UserType;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\User;
use App\Services\ToasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BalanceTranferController extends Controller
{
    public function index(Request $request, BalanceTransferDatatable $balance_transferDatatable)
    {
        return $request->expectsJson()
            ? $balance_transferDatatable->get()
            : view('super-distributor.balancetransfer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type', '!=', UserType::ADMIN->value)
            ->where('parent', Auth::id())
            ->where('active', true)
            ->get();

        return view('super-distributor.balancetransfer.create', ['users' => $users]);
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

            if ($validatedData['amount'] > Auth::user()->wallet) {
                ToasterService::error('Low Balance. Please Recharge');
                return redirect()->route('superdistributor.wallet-recharge.create');
            }

            DB::beginTransaction();

            $fromUser = User::lockForUpdate()->where('id', Auth::id())->first();
            $toUser = User::lockForUpdate()->where('id', $validatedData['user'])->first();

            // Create new transaction
            $transaction = $this->handleTransaction(
                $toUser,
                $validatedData['amount'],
                TransactionEnum::DIRECTION_CREDIT->value,
                $validatedData['notes'] ?? 'Balance credit.',
                $request
            );
            $this->handleTransaction(
                $fromUser,
                $validatedData['amount'],
                TransactionEnum::DIRECTION_DEBIT->value,
                'Balance Transfer',
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
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            ToasterService::error('Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BalanceTransfer $balance_transfer)
    {
        $balance_transfer->load(["fromUser", "transaction", "toUser"]);

        return view(
            'super-distributor.balancetransfer.show',
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
            'super-distributor.balancetransfer.edit',
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

            // Load users with proper locking and null checking
            $fromUser = User::lockForUpdate()->findOrFail(Auth::id());
            $toUser = User::lockForUpdate()->findOrFail($balance_transfer->to_user);

            // Check if sufficient balance exists
            if ($fromUser->wallet < $validatedData['amount']) {
                ToasterService::error('Insufficient funds for transfer');
                return redirect()->route('superdistributor.wallet-recharge.create');
            }

            // Revert previous transaction if it exists
            if ($balance_transfer->amount > 0) {
                $this->handleTransaction(
                    $fromUser,
                    $balance_transfer->amount,
                    TransactionEnum::DIRECTION_CREDIT->value,
                    'Reversal of balance transfer #' . $balance_transfer->id,
                    $request
                );

                $this->handleTransaction(
                    $toUser,
                    $balance_transfer->amount,
                    TransactionEnum::DIRECTION_DEBIT->value,
                    'Reversal of balance transfer #' . $balance_transfer->id,
                    $request
                );
            }

            // Create new transaction
            $this->handleTransaction(
                $fromUser,
                $validatedData['amount'],
                TransactionEnum::DIRECTION_DEBIT->value,
                $validatedData['notes'] ?? 'Balance transfer updated',
                $request
            );

            $newTransaction = $this->handleTransaction(
                $toUser,
                $validatedData['amount'],
                TransactionEnum::DIRECTION_CREDIT->value,
                $validatedData['notes'] ?? 'Balance transfer received',
                $request
            );

            // Update balance transfer record
            $balance_transfer->update([
                'transaction_id' => $newTransaction->id,
                'amount' => $validatedData['amount'],
                'notes' => $validatedData['notes'] ?? 'N/A',
                'status' => 'complete',
                'updated_at' => now(),
            ]);

            DB::commit();

            ToasterService::success('Transfer updated successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            ToasterService::error('Error updating transfer: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BalanceTransfer $balance_transfer)
    {
        try {

            DB::beginTransaction();

            // Load users with proper locking and null checking
            $fromUser = User::lockForUpdate()->findOrFail(Auth::id());
            $toUser = User::lockForUpdate()->findOrFail($balance_transfer->to_user);

            $this->handleTransaction(
                $fromUser,
                $balance_transfer->amount,
                TransactionEnum::DIRECTION_CREDIT->value,
                'Reversal of balance transfer #' . $balance_transfer->id,
                request()
            );

            $this->handleTransaction(
                $toUser,
                $balance_transfer->amount,
                TransactionEnum::DIRECTION_DEBIT->value,
                'Reversal of balance transfer #' . $balance_transfer->id,
                request()
            );

            $balance_transfer->delete();

            DB::commit();

            return response()->json([
                'message' => __('message.success.default'),
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => __('message.error.default'),
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
