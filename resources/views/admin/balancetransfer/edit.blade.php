<x-app-layout>
    @section('title', 'Edit Balance Transfer')
    @section('page-title', 'Edit Balance Transfer')
    @section('breadcrumb', Breadcrumbs::render('admin.balance-transfers.edit', $balanceTransfer))
    <!-- Start Content-->

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.balance-transfers.update', $balanceTransfer) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="row justify-content-center">

                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="user" class="form-label">User</label>
                                <input type="text" disabled class="form-control"
                                    value=" {{ $balanceTransfer->toUser->name }} - {{ $balanceTransfer->toUser->email }} (Balance : {{ $balanceTransfer->toUser->wallet }})">
                                @error('user')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="user" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" placeholder="Enter amount"
                                    value="{{ old('amount', $balanceTransfer->amount) }}">
                                @error('amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="user" class="form-label">Notes</label>
                                <textarea name="notes" class="form-control" cols="5" rows="5"
                                    placeholder="Write some notes">{{ old('notes', $balanceTransfer->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">Update</button>

                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>

</x-app-layout>