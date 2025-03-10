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



                    <div class="mb-3 row">
                        <hr />
                        <button class="btn btn-primary" onclick="captureFingerprint()">Submit</button>
                    </div>

                </div>

            </div>



        </div>
    </div>


</x-app-layout>