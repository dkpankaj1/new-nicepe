<x-app-layout>
    @section('title', 'Create Plans')
    @section('page-title', 'Create Plans')
    @section('breadcrumb', Breadcrumbs::render('admin.plans.create'))

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('admin.plans.store') }}" method="post">
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
                            <textarea name="description"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Feature -->
                        <div id="plan-details">
                            <h5 class="mb-3">Plan Details</h5>

                            <div class="row mb-3 align-items-center">
                                <div class="col-md-8">
                                    <label>Feature</label>
                                </div>
                                <div class="col-md-2">
                                    <label>Current Fee ( {{$generalSetting->currency->symbol}} )</label>
                                </div>
                                <div class="col-md-2">
                                    <label>Fee ( {{$generalSetting->currency->symbol}} )</label>
                                </div>
                            </div>
                            @foreach($featurs as $feature)
                                <div class="row mb-3 align-items-center plan-detail-item">
                                    <!-- Feature Name -->
                                    <div class="col-md-8">
                                        <input type="text"
                                            class="form-control {{ $feature->enable ? '' : 'text-danger' }}"
                                            value="{{ $feature->name }}" disabled
                                            title="{{ $feature->enable ? '' : 'This feature is disabled.' }}">
                                    </div>

                                    <div class="col-md-2">
                                        <input type="number"
                                            class="form-control {{ $feature->enable ? '' : 'text-danger' }}"
                                            value="{{ $feature->fee }}" disabled>
                                    </div>

                                    <!-- Feature Fee -->
                                    <div class="col-md-2">
                                        <input type="number" step="0.01"
                                            class="form-control @error("feature.{$feature->id}.fee") is-invalid @enderror {{ $feature->enable ? '' : 'text-danger' }}"
                                            name="feature[{{ $feature->id }}][fee]"
                                            value="{{ old("feature.{$feature->id}.fee", $feature->fee) }}"
                                            title="{{ $feature->enable ? '' : 'This feature is disabled.' }}">
                                        @error("feature.{$feature->id}.fee")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
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