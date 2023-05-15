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
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{ route('categories.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
        class="fa-solid fa-ban"></i></span></a>
  </div>
</nav>

  <div class="col-md-12">
    <div class="card ">
      <div class="card-body">

        <h6 class="card-title">Add Category</h6>

        <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-xs-6 col-sm-6 col-md-6">
                
                    <label>Category Name</label>
                    <input type="text" name="category_name" class="form-control mt-2" placeholder="Enter Category Name" required>
               
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                
              <label class="form-label">Category Type</label>
              <select class="form-select" name="type_id" id="type" required>
                @foreach ($types as $type)
                <option  value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
                
                
              </select>
         
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-success me-2">Submit</button>
        </div>

@endsection
