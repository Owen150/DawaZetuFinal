@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('profile.edit', $user->id) }}">Edit User Profile</a></li>
  </ol>
</nav>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">

                <div class="col-md-6 mb-3">
                  <label for="exampleInputUsername2" class="mb-2">Profile Picture</label>
                  <input type="file" name="" value="" class="form-control" id="categoryName" placeholder="">
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
