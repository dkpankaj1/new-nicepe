<x-app-layout>
    @section('title', 'Plan Detail')
    @section('page-title', 'Plan Detail')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Plan Information -->
                    <div class="mb-4">
                        <h4 class="text-primary">Plan Information</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $plan->name }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $plan->description ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $plan->created_at->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $plan->updated_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Plan Features -->
                    <div class="mb-4">
                        <h4 class="text-primary">Plan Features</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Feature Name</th>
                                    <th>Current Fee ({{ $generalSetting->currency->symbol }})</th>
                                    <th>Fee ({{ $generalSetting->currency->symbol }})</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($planDetails as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ number_format($plan->current_fee, 2) }}</td>
                                        <td>{{ number_format($plan->fee, 2) }}</td>
                                    </tr>
                                    @endforeach
{{-- 
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No features available for this plan.</td>
                                        </tr>
                                    @endforelse --}}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </x-app-layout>
