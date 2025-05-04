<form action="">
    @csrf

    <input type="hidden" name="transaction_id" value="{{ $ekyc->id }}">
    <input type="hidden" name="aadhar_number" value="">

    <div class="mb-3">
        <label for="name" class="form-label">Aadhaar Number</label>
        <input type="text" class="form-control" id="aadharnumber" name="aadharnumber" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
