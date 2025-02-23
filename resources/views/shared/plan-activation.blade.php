<x-app-layout>
    @section('title', 'Plan Activation')
    @section('page-title', 'Plan Activation')
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

                    <button class="btn btn-success">Process</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>