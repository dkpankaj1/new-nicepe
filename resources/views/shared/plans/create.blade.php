<x-app-layout>

    @section('title', 'Create Plan')
    @section('page-title', 'Create Plan')
    @section('breadcrumb')
        {!! $breadcrumb !!}
    @endsection


    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ $actionUrl }}" method="post">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" placeholder="Enter name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Feature -->
                        <div id="plan-details">
                            <h5 class="mb-3">Plan Details</h5>

                            <div class="table-responsive">
                                <table class="table table-sm table-striped text-center align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-nowrap">Select</th>
                                            <th class="text-nowrap">Feature</th>
                                            <th class="text-nowrap">Current Fee
                                                ({{ $generalSetting->currency->symbol }})</th>
                                            <th class="text-nowrap">Fee ({{ $generalSetting->currency->symbol }})</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($featurs as $feature)
                                            <tr class="plan-detail-item">
                                                <!-- Enable Checkbox -->
                                                <td class="text-nowrap">
                                                    <input type="checkbox" class="form-check-input  "
                                                        name="feature[{{ $feature->id }}][select]"
                                                        {{ old("feature.{$feature->id}.select") ? 'checked' : '' }}>
                                                </td>

                                                <!-- Feature Name -->
                                                <td class="text-nowrap">
                                                    <input type="text" class="form-control text-center  "
                                                        value="{{ $feature->name }}" disabled>
                                                </td>

                                                <!-- Current Fee -->
                                                <td class="text-nowrap">
                                                    <input type="number" class="form-control text-center  "
                                                        value="{{ $feature->fee }}" disabled>
                                                </td>

                                                <!-- Editable Fee -->
                                                <td class="text-nowrap">
                                                    <input type="number" step="0.01"
                                                        class="form-control text-center @error("feature.{$feature->id}.fee") is-invalid @enderror  "
                                                        name="feature[{{ $feature->id }}][fee]"
                                                        value="{{ old("feature.{$feature->id}.fee", 0.0) }}">
                                                    @error("feature.{$feature->id}.fee")
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
                            <button type="submit" class="btn btn-primary px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
