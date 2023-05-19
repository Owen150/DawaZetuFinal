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
        <li class="breadcrumb-item active"><a href="{{ route('productManufacturers.create') }}">Add Product Manufacturer</a></li>
    </ol>
    <div class="cancel">
        <div></div>
        <a href="{{ route('productManufacturers.index') }}" class="btn btn-danger">Cancel <span><i
            class="fa-solid fa-ban"></i></span></a>
    </div>
</nav>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('/productManufacturers') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label class="form-label" for="name">Manufacturer Name</label>
                        <input required type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
                    </div><!-- Col -->

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <label class="form-label" for="location">Manufacturer Location</label>
                        <select class="form-select" aria-label="Default select example" required type="text" name="location">
                            <option selected value="local">Local</option>
                            <option value="foreign">Foreign</option>
                        </select>
                    </div><!-- Col -->
                </div><!-- Row -->
                <button type="submit" class="btn btn-success submit">Submit <span style="position: relative; top:2px; left: 2px" ><ion-icon name="checkbox-outline"></ion-icon></span></button>
            </form>
        </div>
    </div>
</div>
@endsection
