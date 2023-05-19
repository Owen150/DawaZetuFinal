@extends('layouts.app')

@push('plugin-styles')
<style>
  .mynav{
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  .cancel{
    display: flex;
    flex-direction: row-reverse;
  }
</style>
@endpush
@section('content')
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Roles Table</a></li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{ route('roles.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
        class="fa-solid fa-ban"></i></span></a>
  </div>
</nav>

  <div class="col-md-12">
    <div class="card ">
      <div class="card-body">

        <h6 class="card-title">Add Role</h6>

        <form action="{{ route('roles.store') }}" method="POST">
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

      </div>
    </div>
  </div>

@endsection
