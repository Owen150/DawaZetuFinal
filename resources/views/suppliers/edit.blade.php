@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Suppliers</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Supplier Details</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">Edit Supplier Details</h3>
                            <p class="text-muted">Fill out details to update supplier</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-md btn-danger">Cancel <span><i
                                        class="fa-solid fa-ban"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <form role="form" method="post" action="{{ url('suppliers/'.$suppliers->id)}}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input required type="text" class="form-control" placeholder="Enter Name" id="name"
                                    value="{{ $suppliers->name }}" name="name">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="license">License</label>
                                <input required type="text" class="form-control" value="{{ $suppliers->license }}"
                                    name="license" placeholder="Enter License Code">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row"><!-- Row -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="location">Location</label>
                                <input required type="text" class="form-control" value="{{ $suppliers->location }}"
                                    name="location" placeholder="Enter your Address">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="location">Rank</label>
                                <input required type="text" class="form-control" value="{{ $suppliers->rank }}"
                                    name="rank" autocomplete="off">
                                    <select class="form-select" name="rank" id="rank" required>
                    
                                        <option @if($suppliers->rank == 1) selected @endif value="1">One</option>
                                        <option @if($suppliers->rank == 2) selected  @endif  value="2">Two</option>
                                        <option @if($suppliers->rank == 3) selected  @endif  value="3">Three</option>
                                        <option @if($suppliers->rank == 4) selected  @endif  value="4">Four</option>
                                        <option @if($suppliers->rank == 5) selected  @endif value="5">Five</option>
                                        <option @if($suppliers->rank == 6) selected  @endif value="6">Six</option>
                                        <option @if($suppliers->rank == 7) selected  @endif value="7">Seven</option>
                                       
                                    </select>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row"><!-- Row -->
                       
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="contracts">Contracts</label>
                                <input required type="text" class="form-control" value="{{ $suppliers->contracts }}"
                                    name="contracts" placeholder="Enter your Contracts">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="contract_number">Contract Number</label>
                                <input required type="text" class="form-control"
                                    value="{{ $suppliers->contract_number }}" name="contract_number"
                                    placeholder="Enter contract number">
                            </div>
                        </div><!-- Col -->
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
