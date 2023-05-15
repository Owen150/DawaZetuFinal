<form action="{{ route('store_location') }}" method="POST">
    @csrf
    <div class="row ms-2">
        <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2" class="mb-2">Location Name</label>
            <input type="text" name="location_name" class="form-control" placeholder="Enter Location Name" required>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputUsername2" class="mb-2">Subcounty Name</label>
                <select class="js-example-basic-single form-select" data-width="100%" name="subcounty_id" id="subcounties_two">
                    @foreach ($subcounties as $subcounty)
                    <option value="{{ $subcounty->id }}">{{ $subcounty->subcounty_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputUsername2" class="mb-2">County Name</label>
                <select class="js-example-basic-single form-select" data-width="100%" name="county_id" id="counties_two">
                    @foreach ($counties as $county)
                    <option value="{{ $county->id }}">{{ $county->county_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputUsername2" class="mb-2">Ward Name</label>
                <select class="js-example-basic-single form-select" data-width="100%" name="ward_id" id="wards">
                    @foreach ($wards as $ward)
                    <option value="{{ $ward->id }}">{{ $ward->ward_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-primary mt-3">Add Location <span style="position: relative; top:2px; left: 2px"><ion-icon name="add-circle-outline"></ion-icon></span></button>
        </div>
    </div>
</form>