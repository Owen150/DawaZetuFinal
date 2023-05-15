<form action="{{ route('store_county') }}" method="POST">
    @csrf
    <div class="row ms-2">
        <div class="col-md-12">
            <label for="exampleInputUsername2" class="mb-2">County Name</label>
            <input type="text" name="county_name" class="form-control" placeholder="Enter County Name" required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary mt-3">Add County <span style="position: relative; top:2px; left: 2px"><ion-icon name="add-circle-outline"></ion-icon></span></button>
        </div>
    </div>    
</form>