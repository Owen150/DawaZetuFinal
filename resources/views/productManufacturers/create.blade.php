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
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('productManufacturers.index') }}">Product Manufacturers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Product Manufacturer</li>
    </ol>
    <div class="cancel">
        <div></div>
        <a href="{{ route('productManufacturers.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
            class="fa-solid fa-ban"></i></span></a>
    </div>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">Create Product Manufacturers</h3>
                            <p class="text-muted">Fill out details to create new Product Manufacturer</p>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ url('/productManufacturers') }}">
                <div class="card-body">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input required type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="location">Location</label>
                                <select class="form-select" aria-label="Default select example" required type="text" name="location">
                                    <option selected value="local">Local</option>
                                    <option value="foreign">Foreign</option>
                                  </select>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
