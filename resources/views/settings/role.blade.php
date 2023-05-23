<form action="{{ route('store_role') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="exampleInputUsername2">Role Name</label>
        <input type="text" name="role_name" class="form-control" placeholder="Role Name" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="exampleInputUsername2">Role Initials</label>
        <input type="text" name="role_initials" class="form-control" placeholder="Role Initials" required>
      </div>
    </div>

    <div>
      <button type="submit" class="btn btn-success">Submit <span style="position: relative; top:2px; left: 2px" ><ion-icon name="checkbox-outline"></ion-icon></span></button>
    </div>
</form>