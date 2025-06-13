<x-app-layout>
    @section('title', 'Wallet Recharge')
    @section('page-title', 'Wallet Recharge')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection

    <div class="card">
        <div class="card-body row justify-content-center">
            <div class="col-md-4">
                <!-- Positive bullet point -->
                <div class="mt-3">
                    <div class="alert alert-success">
                        We ensure that your payment is secure through advanced encryption and trusted payment gateways.
                    </div>
                </div>

                <form action="{{ $action }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="">Amount</label>
                        <select name="amount" class="form-control" name="amount">
                            <option disabled selected>--- select amount ---</option>
                            <option value="1">1</option>
                            <option value="10">10</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="2000">2000</option>
                            <option value="5000">5000</option>
                        </select>
                        @error('amount')
                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-success">Process</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>