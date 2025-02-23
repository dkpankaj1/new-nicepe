<x-app-layout>

    @section('title', 'Server - Command')
    @section('page-title', 'Server - Command')

    <div class="card">
        <div class="card-body row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin.server.command') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="command" class="form-label">Command</label>
                        <input type="text" name="command" class="form-control" value="{{ old('command') }}">
                        @error('command')
                            <span class="invalid-feedback d-block text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <hr>
                    <button class="btn btn-danger px-3">Execute</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>