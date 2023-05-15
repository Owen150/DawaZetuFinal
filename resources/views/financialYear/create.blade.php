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
        <li class="breadcrumb-item"><a href="{{ route('financialYear.index') }}">Financial Year</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Financial Year</li>
    </ol>
    <div class="cancel">
        <div></div>
        <a href="{{ route('financialYear.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
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
                            <h3 class="card-title">Create Financial Year</h3>
                            <p class="text-muted">Fill out details to create new financial year</p>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ url('/financialYear') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="name">Year</label>
                                <input required type="text" class="form-control" name="name" placeholder="eg 2023/2024">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="start_date">Start Date</label>
                                <input required type="date" class="form-control" name="start_date" placeholder="Enter your Start Date">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="end_date">End Date</label>
                                <input required type="date" class="form-control" name="end_date" placeholder="Enter End Date">
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
