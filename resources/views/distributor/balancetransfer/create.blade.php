<x-app-layout>
    @section('title', 'New Balance Transfer')
    @section('page-title', 'New Balance Transfer')
    @section('breadcrumb', Breadcrumbs::render('distributor.balance-transfers.create'))

    @push('pageCss')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    @endpush
    <!-- Start Content-->

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('distributor.balance-transfers.store') }}" method="POST">
                    @csrf

                    <div class="row justify-content-center">

                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="user" class="form-label">User</label>
                                <select name="user" class="form-control" id="select-field">
                                    <option value="">---select---</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if (old('user') == $user->id) selected @endif>
                                            {{ $user->name }} - {{ $user->email }} (Balance : {{ $user->wallet }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="user" class="form-label">Amount</label>
                                <input type="number" class="form-control" name="amount" placeholder="Enter amount">
                                @error('amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="user" class="form-label">Notes</label>
                                <textarea name="notes" class="form-control" cols="5" rows="5"
                                    placeholder="Write some notes">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">Transfer</button>

                        </div>

                    </div>



                </form>
            </div>

        </div>
    </div>


    @push('pageScript')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('#select-field').select2({
                theme: 'bootstrap-5'
            });
        </script>
    @endpush
</x-app-layout>