<form action="">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Aadhaar Number</label>
        <input type="text" class="form-control" id="aadharnumber" name="aadharnumber" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>

</form>