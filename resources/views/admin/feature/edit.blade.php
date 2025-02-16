<x-app-layout>

    @section('title', 'Update Feature')
    @section('page-title', 'Update Feature')
    @section('breadcrumb', Breadcrumbs::render('admin.features.edit', $feature))

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <form action="{{route('admin.features.update', $feature)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <!-- Service Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $feature->name) }}" placeholder="Enter Name">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Service Fee Input -->
                        <div class="mb-3">
                            <label for="fee" class="form-label">Fee
                                ( {{$generalSetting->currency->symbol}} )</label>
                            <input type="number" class="form-control" name="fee" value="{{ old('fee', $feature->fee) }}"
                                placeholder="Enter Fee">
                            @error('fee')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Activation Fee Input -->
                        <div class="mb-3">
                            <label for="fee" class="form-label">Activation Fee
                                ( {{$generalSetting->currency->symbol}} )</label>
                            <input type="number" class="form-control" name="activation_fee"
                                value="{{ old('activation_fee', $feature->activation_fee) }}"
                                placeholder="Enter Activation Fee">
                            @error('activation_fee')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Service Enable (Yes/No) Dropdown -->
                        <div class="mb-3">
                            <label for="enable" class="form-label">Enable</label>
                            <select name="enable" class="form-control">
                                <option value="">---select---</option>
                                <option value="1" @if (old('enable', $feature->enable) === 1) selected @endif>Yes
                                </option>
                                <option value="0" @if (old('enable', $feature->enable) === 0) selected @endif>No
                                </option>
                            </select>
                            @error('enable')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Service Thumbnail Section -->
                        <div class="mb-3 text-center">
                            <div class="border text-center">
                                <img src="{{ $feature->image }}" alt="{{ $feature->name }}" class="img-fluid p-1 "
                                    style="height: 113px">
                            </div>
                            <input type="file" class="form-control mt-1" name="thumbnail">
                            @error('thumbnail')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Service Description Input -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" rows="5"
                                class="form-control">{{ old('description', $feature->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <button class="btn btn-primary px-5">{{"Update"}}</button>
                    </form>

                </div>
                <div class="col-md-4"></div>
            </div>

        </div>
    </div>


</x-app-layout>