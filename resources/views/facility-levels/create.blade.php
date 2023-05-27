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
    <li class="breadcrumb-item"><a href="{{ route('facility-levels.create') }}">Add Facility Level</a></li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('facility-levels.index')}}"><button class="btn btn-warning"><span><ion-icon style="position: relative; top:2px; right: 3px" name="arrow-back-outline"></ion-icon></span> Go Back</button></a>
  </div>
</nav>

<div class="col-md-12">
    <div class="card ">
        <div class="card-body">
            <form action="{{ route('facility-levels.store') }}" method="POST">
            @csrf
            <div class="row  mb-3">
                <div class="col-md-6">
                    <label for="exampleInputUsername2">Facility Level</label>
                    <input type="text" name="level" class="form-control mt-2" placeholder="Enter Facility Level" required>
                </div>
            

                <div class="col-md-6 mb-3">
                    <label for="" class="form-label">Status</label>
                    <select class="js-example-basic-single form-select" name="status" type="text" required>
                      <option selected >Active</option>
                      <option>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit <span style="position: relative; top:2px; left: 2px" ><ion-icon name="checkbox-outline"></ion-icon></span></button>
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