<form action="">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Aadhaar Number</label>
        <input type="text" class="form-control" id="aadharnumber" name="aadharnumber" required>
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary px-4 w-100">Submit</button>
    </div>


</form>
