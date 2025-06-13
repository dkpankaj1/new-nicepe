<x-app-layout>
    @section('title', 'Edit Role')
    @section('page-title', 'Edit Role')
    @section('breadcrumb')
    {{ Breadcrumbs::render('admin.roles.edit',$role) }}
    @endsection



    <div class="container-fluid">

        <form action="{{ route('admin.roles.update',$role) }}" method="POST">
            @csrf
            @method('put')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">User Roles</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Role Name"
                            value="{{ old('name',$role->name) }}">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($permissionGroups as $permissionGroup)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">{{ $permissionGroup->name }}</h3>
                            </div>
                            <div class="card-body">
                                
                                @foreach ($permissionGroup->permissions as $permission)
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                        id="flexCheckChecked" name="permissions[]" 
                                        {{ in_array($permission->name, old('permissions', $hasPermissions)) ? "checked" : "" }}>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        {{ $permission->name }}
                                    </label>
                                </div>

                                @endforeach
                            
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary px-5">Update</button>
                </div>

            </div>

        </form>
    </div>


</x-app-layout>