@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="">User Profile</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
  </ol>
</nav>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <h3 class="card-title">Edit User Profile</h3>

        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">

                <div class="col-md-6 mb-3">
                  <label for="exampleInputUsername2" class="mb-2">Email</label>
                  <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="categoryName" placeholder="">
                </div>

                <div class="col-md-6 mb-3">
                  <label for="exampleInputUsername2" class="mb-2">Phone Number</label>
                  <input type="email" name="email" value="{{ $user->phone_number }}" class="form-control" id="categoryName" placeholder="">
                </div>


                <div>
                  <button type="submit" class="btn btn-success">Submit <span style="position: relative; top:2px; left: 2px" ><ion-icon name="checkbox-outline"></ion-icon></span></button>
                </div>

            </div>
            
        </form>

      </div>
    </div>
  </div>


@endsection
