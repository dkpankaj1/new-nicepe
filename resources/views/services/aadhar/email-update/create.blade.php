<x-app-layout>

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                            placeholder="Enter Name">
                    </div>

                    <div class="mb-3">
                        <label for="name">Father Or Husband Name (Optional)</label>
                        <input type="text" class="form-control" value="{{ old('parent') }}" name="parent"
                            placeholder="Enter father Or hsband name">
                    </div>

                    <div class="mb-3">
                        <label for="name">Aadhaar No.</label>
                        <input type="text" class="form-control" value="{{ old('aadhar') }}" name="aadhar"
                            placeholder="Enter adhaar NUmber">
                    </div>

                    <div class="mb-3">
                        <label for="name">Mobile No.</label>
                        <input type="text" class="form-control" value="{{ old('mobile') }}" name="mobile"
                            placeholder="+91 9794xxx940">
                    </div>

                    <div class="mb-3">
                        <label for="name">Email ID</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                            placeholder="example@email.com">
                    </div>

                    <div class="mb-3">
                        <input type="hidden" class="d-none" name="" id="">
                        <input type="hidden" class="d-none" name="" id="">
                        <input type="hidden" class="d-none" name="" id="">
                        <input type="hidden" class="d-none" name="" id="">
                        <input type="hidden" class="d-none" name="" id="">
                    </div>

                    <div class="row justify-content-center">

                        <div class="col-md-4">
                            <div class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                <div class="card-body">
                                    <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                        alt="" class="img-fluid" style="width: 150px">
                                </div>
                                <button class="btn btn-success w-100">Scan</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                <div class="card-body">
                                    <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                        alt="" class="img-fluid" style="width: 150px">
                                </div>
                                <button class="btn btn-success w-100">Scan</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                <div class="card-body">
                                    <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                        alt="" class="img-fluid" style="width: 150px">
                                </div>
                                <button class="btn btn-success w-100">Scan</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                <div class="card-body">
                                    <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                        alt="" class="img-fluid" style="width: 150px">
                                </div>
                                <button class="btn btn-success w-100">Scan</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border p-2 d-flex flex-column justify-content-center align-items-center">
                                <div class="card-body">
                                    <img src="https://cdn.dribbble.com/users/846207/screenshots/4787301/fingerprint.gif"
                                        alt="" class="img-fluid" style="width: 150px">
                                </div>
                                <button class="btn btn-success w-100">Scan</button>
                            </div>
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <hr />
                        <button class="btn btn-primary" onclick="captureFingerprint()">Submit</button>
                    </div>

                </div>

            </div>



        </div>
    </div>

    @push('pageScript')

        <script src="{{asset('backend/libs/msf100/MSF100.js')}}"></script>
        <script>

            const scanner = new MFS100Scanner();

            async function captureFingerprint(thumb) {
                try {
                    const result = await scanner.captureFingerprint();

                    if (!result.success) {
                        alert(`Error: ${result.error}`);
                    } else {
                        console.log("Fingerprint Image:", result.data);
                    }
                } catch (e) {
                    alert("Unknown error: " + e.message);
                }
            }


        </script>
    @endpush

</x-app-layout>