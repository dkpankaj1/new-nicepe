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
                @if(Session::has('message'))
                    <div class="mt-3">
                        <div class="alert alert-danger">
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    </div>
                @endif

                <div class="mt-3">
                    <div class="alert alert-info">
                        <strong>Important:</strong> Please verify your details before proceeding. </br>
                        <strong>Important:</strong> Your balance has been deducted by {{$planDetails->feature->activation_fee}} {{$generalSetting->currency->code}} </br>
                        <strong>Need Help?</strong> <a href="#">Contact our support team</a>.
                    </div>
                </div>

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @method('PUT')
                    <ul>
                        <li>Feature: {{$planDetails->feature->name}}</li>
                        <li>Feature Fee: {{$planDetails->fee}} {{$generalSetting->currency->code}}</li>
                        <li>Feature Activation Fee: {{$planDetails->feature->activation_fee}}
                            {{$generalSetting->currency->code}}
                        </li>
                    </ul>

                    <hr>
                    <button class="btn btn-success">Process</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>