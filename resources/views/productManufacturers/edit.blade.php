@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Product Manufacturers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Product Manufacturers Details</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">Edit Product Manufacturers Details</h3>
                            <p class="text-muted">Fill out details to update Product Manufacturers</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('productManufacturers.index') }}" class="btn btn-md btn-danger">Cancel
                                <span><i class="fa-solid fa-ban"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <form role="form" method="post" action="{{ url('productManufacturers/'.$productManufacturers->id)}}"
                accept-charset="UTF-8">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input required type="text" class="form-control" placeholder="Enter Name" id="name"
                                    value="{{ $productManufacturers->name }}" name="name">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="location">Location</label>
                                <select class="form-select" aria-label="Default select example" required type="text"
                                    name="location">
                                    <option selected value="{{ $productManufacturers->location }}">
                                        {{ $productManufacturers->location }}</option>

                                    @if ( $productManufacturers->location == 'foreign' )
                                        <option value="local">Local</option>
                                    @elseif ( $productManufacturers->location == 'local' )
                                        <option value="foreign">Foreign</option>
                                    @endif
                                </select>

                            </div>
                        </div>
                    </div><!-- Row -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
