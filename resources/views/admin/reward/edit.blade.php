<x-app-layout>

    @section('title', 'Edit Reward')
    @section('page-title', 'Edit Reward')
    @section('breadcrumb', Breadcrumbs::render('admin.rewards.edit', $reward))

    <div class="card">
        <div class="card-body row justify-content-center">

            <div class="col-md-6">

                <form action="{{ route('admin.rewards.update', $reward) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="feature_id" class="form-label">Feature</label>
                        <input type="text" class="form-control" value="{{ $reward->feature->name }}" readonly disabled>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"
                            value="{{ old('name', $reward->name) }}">
                        @error('name')
                            <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="point" class="form-label">Point</label>
                        <input type="number" step="0.01" name="point" class="form-control"
                            placeholder="Enter Reward Point" value="{{ old('point', $reward->point) }}">
                        @error('point')
                            <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reward_type" class="form-label">Reward Type</label>
                        <select name="reward_type" class="form-control">
                            <option value="">---select---</option>
                            <option value="0" @if (old('reward_type', $reward->reward_type) == 0) selected @endif>Fixed
                            </option>
                            <option value="1" @if (old('reward_type', $reward->reward_type) == 1) selected @endif>
                                Percentage</option>
                        </select>
                        @error('reward_type')
                            <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiration</label>
                        <input type="date" name="expiry_date" class="form-control" id="name" placeholder="Enter Name"
                            value="{{ old('expiry_date', $reward->expiry_date) }}">
                        @error('expiry_date')
                            <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="enable" class="form-label">Enable</label>
                        <select name="enable" class="form-control">
                            <option value="">---select---</option>
                            <option value="1" @if (old('enable', $reward->enable) == 1) selected @endif>Yes
                            </option>
                            <option value="0" @if (old('enable', $reward->enable) == 0) selected @endif>No
                            </option>
                        </select>
                        @error('enable')
                            <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            placeholder="Enter description">{{old('description', $reward->description)}}</textarea>
                        @error('description')
                            <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>
                    <button class="btn btn-primary px-3">Update</button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>