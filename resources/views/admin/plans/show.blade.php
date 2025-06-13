<x-app-layout>
    @section('title', 'Plan Details')
    @section('page-title', 'Plan Details')
    @section('breadcrumb', Breadcrumbs::render('admin.plans.show', $plan))

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
                                    <th>Current Fee ({{$generalSetting->currency->symbol}})</th>
                                    <th>Fee ({{$generalSetting->currency->symbol}})</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plan->planDetails as $detail)
                                    <tr>
                                        <td>{{ $detail->feature->name }}</td>
                                        <td>{{ $detail->feature->fee }}</td>
                                        <td>{{ number_format($detail->fee, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No features available for this plan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Back Button -->
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Back to Plans</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>