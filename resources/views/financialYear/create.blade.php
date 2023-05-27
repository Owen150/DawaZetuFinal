@extends('layouts.app')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

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
        <li class="breadcrumb-item"><a href="{{ route('financialYear.index') }}">Add New Financial Year</a></li>
    </ol>
    <div class="cancel">
        <div></div>
        <a href="{{route('financialYear.index')}}"><button class="btn btn-warning"><span><ion-icon style="position: relative; top:2px; right: 3px" name="arrow-back-outline"></ion-icon></span> Go Back</button></a>
    </div>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            
            <form method="POST" action="{{ url('/financialYear') }}">
                <div class="card-body">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Financial Year</label>
                            <input required type="text" class="form-control" name="financial_year" placeholder="eg 2023/2024">
                        </div><!-- Col -->
                        <div class="col-md-6">
                            <label class="form-label">Year</label>
                            <input required type="text" class="form-control" name="year" placeholder="eg 2023">
                        </div><!-- Col -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Start Date</label>
                            <input required type="date" class="form-control" name="start_date" placeholder="Enter your Start Date">
                        </div><!-- Col -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">End Date</label>
                            <input required type="date" class="form-control" name="end_date" placeholder="Enter End Date">
                        </div><!-- Col -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Status</label>
                            <select class="js-example-basic-single form-select" name="status" type="text" required>
                              <option selected >Active</option>
                              <option>Inactive</option>
                            </select>
                        </div>
                    </div><!-- Row -->
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success submit">Submit <span style="position: relative; top:2px; left: 2px" ><ion-icon name="checkbox-outline"></ion-icon></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush
