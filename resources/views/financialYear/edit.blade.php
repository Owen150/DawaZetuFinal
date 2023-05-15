@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('financialYear.index') }}">Financial Year</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Financial Year</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">Create Financial Year</h3>
                            <p class="text-muted">Fill out details to create new financial year</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('financialYear.index') }}" class="btn btn-md btn-danger">Cancel <span><i
                                        class="fa-solid fa-ban"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <form role="form" method="post" action="{{ url('financialYear/'.$financialYears->id)}}" accept-charset="UTF-8">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input required type="text" class="form-control" name="name" value="{{ $financialYears->name }}" placeholder="Enter your Address">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="start_date">Start Date</label>
                                <input required type="date" class="form-control" name="start_date" value="{{ $financialYears->start_date }}" placeholder="Enter your Start Date">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="end_date">End Date</label>
                                <input required type="date" class="form-control" name="end_date" value="{{ $financialYears->end_date }}" placeholder="Enter End Date">
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
