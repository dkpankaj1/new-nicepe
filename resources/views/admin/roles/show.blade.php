<x-app-layout>
    @section('title', 'Roles | Show')
    @section('page-title', 'Roles | Show')
    @section('breadcrumb', Breadcrumbs::render('admin.roles.show', $role))

    <div class="container-fluid">
        <!-- Card for Role Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">User Roles</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Role Name"
                        value="{{ old('name', $role->name) }}" readonly>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Permissions Section -->
        <div class="row">
            @foreach ($permissionGroups as $permissionGroup)
                <div class="col-md-6 col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="card-title mb-0">{{ $permissionGroup->name }}</h6>
                        </div>
                        <div class="card-body">
                            @foreach ($permissionGroup->permissions as $permission)
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        @if (in_array($permission->name, old('permissions', $hasPermissions)))
                                            <i data-feather="check-circle" class="text-success"></i>
                                        @else
                                            <i data-feather="x-circle" class="text-danger"></i>
                                        @endif
                                    </div>
                                    <label class="form-check-label" for="permission-{{ $loop->index }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>