<x-app-layout>
    @section('title', 'Mobile/Email Update')
    @section('page-title', 'Mobile/Email Update')

    <div class="card">
        <div class="card-body">
            <form action="{{ $action }}" method="POST">
                @csrf

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                placeholder="Enter Name">
                            @error('name')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name">Father Or Husband Name (Optional)</label>
                            <input type="text" class="form-control" value="{{ old('parent') }}" name="parent"
                                placeholder="Enter father Or hsband name">
                            @error('parent')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name">Aadhaar No.</label>
                            <input type="text" class="form-control" value="{{ old('aadhar') }}" name="aadhar"
                                placeholder="Enter adhaar Number">
                            @error('aadhar')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name">Mobile No.</label>
                            <input type="text" class="form-control" value="{{ old('mobile') }}" name="mobile"
                                placeholder="+91 9794xxx940">
                            @error('mobile')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name">Email ID</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                placeholder="example@email.com">
                            @error('email')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="hidden" class="d-none" name="fingerprint1" id="fingerprint1">
                            <input type="hidden" class="d-none" name="fingerprint2" id="fingerprint2">
                            <input type="hidden" class="d-none" name="fingerprint3" id="fingerprint3">
                            <input type="hidden" class="d-none" name="fingerprint4" id="fingerprint4">
                            <input type="hidden" class="d-none" name="fingerprint5" id="fingerprint5">
                        </div>

                        <div class="row justify-content-center">

                            <div class="col-md-4">
                                <div
                                    class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                    <div class="card-body">
                                        <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                            alt="" class="img-fluid" style="width: 150px"
                                            id="fingerprint1_preview">
                                        @error('fingerprint1')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-success w-100"
                                        onclick = "captureFingerprint('fingerprint1',this)">Scan fingerprint 1</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div
                                    class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                    <div class="card-body">
                                        <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                            alt="" class="img-fluid" style="width: 150px"
                                            id="fingerprint2_preview">
                                        @error('fingerprint2')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-success w-100"
                                        onclick = "captureFingerprint('fingerprint2',this)">Scan fingerprint 2</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div
                                    class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                    <div class="card-body">
                                        <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                            alt="" class="img-fluid" style="width: 150px"
                                            id="fingerprint3_preview">
                                        @error('fingerprint3')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-success w-100"
                                        onclick = "captureFingerprint('fingerprint3',this)">Scan fingerprint 3</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div
                                    class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                    <div class="card-body">
                                        <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                            alt="" class="img-fluid" style="width: 150px"
                                            id="fingerprint4_preview">
                                        @error('fingerprint4')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-success w-100"
                                        onclick = "captureFingerprint('fingerprint4',this)">Scan fingerprint 4</button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div
                                    class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                    <div class="card-body">
                                        <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                            alt="" class="img-fluid" style="width: 150px"
                                            id="fingerprint5_preview">
                                        @error('fingerprint5')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-success w-100"
                                        onclick = "captureFingerprint('fingerprint5',this)">Scan fingerprint 3</button>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3 row">
                            <hr />
                            <button class="btn btn-primary">Submit</button>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>

    @push('pageScript')
        <script src="{{ asset('backend/libs/msf100/MSF100.js') }}"></script>
        <script>
            const scanner = new MFS100Scanner();

            async function captureFingerprint(thumb, button) {
                try {
                    button.disabled = true;

                    const result = await scanner.captureFingerprint();

                    if (result?.success && result.data) {
                        const fingerprintData = "data:image/png;base64," + result.data;
                        document.getElementById(thumb).value = fingerprintData;

                        // Set preview image if exists
                        const previewElement = document.getElementById(thumb + "_preview");
                        if (previewElement) {
                            previewElement.src = fingerprintData; // Set src if it's an <img>
                        }

                        alert("Success");
                    } else {
                        alert(`Error: ${result?.error || "Unknown error"}`);
                    }
                } catch (error) {
                    alert(`Unknown error: ${error.message}`);
                } finally {
                    // Fallback preview image (if applicable)
                    const previewElement = document.getElementById(thumb + "_preview");
                    const dummy =
                        "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAIAAADTED8xAAADMElEQVR4nOzVwQnAIBQFQYXff81RUkQCOyDj1YOPnbXWPmeTRef+/3O/OyBjzh3CD95BfqICMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMK0CMO0TAAD//2Anhf4QtqobAAAAAElFTkSuQmCC";
                    if (previewElement) {
                        previewElement.src = dummy

                    }
                    document.getElementById(thumb).value = dummy;

                    button.disabled = false;
                }
            }
        </script>
    @endpush

</x-app-layout>
