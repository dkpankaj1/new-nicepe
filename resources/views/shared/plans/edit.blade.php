<x-app-layout>
    @section('title', 'Edit Plan')
    @section('page-title', 'Edit Plan')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ $actionUrl }}" method="post">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $plan->name) }}" placeholder="Enter name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $plan->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Plan Details -->
                        <div id="plan-details">
                            <h5 class="mb-3">Plan Details</h5>

                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Feature</th>
                                            <th>Current Fee ( {{ $generalSetting->currency->symbol }} )</th>
                                            <th>Fee ( {{ $generalSetting->currency->symbol }} )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($planDetails as $plan)
                                            <tr>
                                                <td>
                                                    <input type="text"
                                                        class="form-control {{ $plan->feature_enabled ? '' : 'text-danger' }}"
                                                        value="{{ $plan->name }}" disabled
                                                        title="{{  $plan->feature_enabled ? '' : 'This feature is disabled.' }}">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control {{ $plan->feature_enabled ? '' : 'text-danger' }}"
                                                        value="{{ $plan->current_fee }}" disabled>
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01"
                                                        class="form-control {{ $plan->feature_enabled ? '' : 'text-danger' }} @error("detail.{$plan->id}.fee") is-invalid @enderror"
                                                        name="detail[{{ $plan->id }}][fee]"
                                                        value="{{ old("detail.{$plan->id}.fee", $plan->fee ?? 0) }}">
                                                    @error("detail.{$plan->id}.fee")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <hr>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
