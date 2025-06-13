<x-app-layout>
    @section('title', 'Edit Plan')
    @section('page-title', 'Edit Plan')
    @section('breadcrumb', Breadcrumbs::render('admin.plans.edit', $plan))

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('admin.plans.update', $plan->id) }}" method="post">
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
                            <textarea name="description"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $plan->description) }}</textarea>
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
                                            <th>Current Fee ( {{$generalSetting->currency->symbol}} )</th>
                                            <th>Fee ( {{$generalSetting->currency->symbol}} )</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($plan->planDetails as $detail)
                                            <tr>
                                                <td>
                                                    <input type="text"
                                                        class="form-control {{ $detail->feature->enable ? '' : 'text-danger' }}"
                                                        value="{{ $detail->feature->name }}" disabled
                                                        title="{{ $detail->feature->enable ? '' : 'This feature is disabled.' }}">
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        class="form-control {{ $detail->feature->enable ? '' : 'text-danger' }}"
                                                        value="{{ $detail->feature->fee }}" disabled>
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01"
                                                        class="form-control {{ $detail->feature->enable ? '' : 'text-danger' }} @error("detail.{$detail->id}.fee") is-invalid @enderror"
                                                        name="detail[{{ $detail->id }}][fee]"
                                                        value="{{ old("detail.{$detail->id}.fee", $detail->fee ?? 0) }}">
                                                    @error("detail.{$detail->id}.fee")
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