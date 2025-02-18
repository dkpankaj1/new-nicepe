<x-app-layout>
    @section('title', 'Update Profile')
    @section('page-title', 'Update Profile')
    @section('breadcrumb', Breadcrumbs::render('retailer.account.update'))



    <form action="{{ route('retailer.account.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card" style="font-weight:bold">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">

                        <div class="border text-center p-1">
                            <img src="{{ $user->avatar }}" class="rounded-2 avatar-xxl" alt="image profile">
                        </div>

                        <div class="mb-3 text-center">
                            <input type="file" name="avatar" class="form-control my-2">
                            @error('name')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="Enter name" class="form-control">
                            @error('name')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="Enter email" class="form-control">
                            @error('email')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <button class="btn btn-primary px-5">{{"Update"}}</button>

                    </div>
                    <div class="col-md-4"></div>

                </div>
            </div>
        </div>
    </form>

    @section('page-js')
    <script>
        function previewImage(event) {
            const imageInput = event.target;
            const imagePreview = document.getElementById('imagePreview');
            const deleteIcon = document.querySelector('.delete-icon');

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    deleteIcon.classList.remove('d-none');
                };
                reader.readAsDataURL(imageInput.files[0]);
            }
        }

        function removeImage(event) {
            event.stopPropagation(); // Prevent triggering the file input
            const imageInput = document.getElementById('imageInput');
            const imagePreview = document.getElementById('imagePreview');
            const deleteIcon = document.querySelector('.delete-icon');

            imageInput.value = ""; // Clear the file input
            imagePreview.src = "https://via.placeholder.com/150"; // Reset to placeholder
            deleteIcon.classList.add('d-none'); // Hide the delete icon
        }
    </script>
    @endsection

</x-app-layout>