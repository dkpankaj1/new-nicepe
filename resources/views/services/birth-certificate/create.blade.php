<x-app-layout>

    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Child Name</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Child Name (Hindi)</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">--select gender---</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Father Name</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Father Name (In Hindi)</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Father Aadhar Number</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Mother Name</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Mother Name (In Hindi)</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Mother Aadhar Number</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                        placeholder="Enter Name in hindi">
                </div>




            </div>

            <div class="mb-3">
                <hr />
                <button class="btn btn-primary px-4" type="sybmit">Submit</button>
            </div>

        </div>

    </div>


</x-app-layout>
