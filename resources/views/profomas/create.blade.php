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
    <li class="breadcrumb-item"><a href="{{ route('profomas.index') }}">Proforma Invoice</a></li>
    <li class="breadcrumb-item active" aria-current="page">Generate Invoice</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('profomas.index')}}"><button class="btn btn-danger mb-1 mb-md-0">Cancel</button></a>
  </div>
</nav>

  <div class="col-md-12">
    <div class="card ">
      <div class="card-body">

        <h6 class="card-title">Generate Invoice</h6>

        <form action="{{ route('profomas.store') }}" method="POST">
        @csrf

        <div class="row">

          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="exampleInputUsername2">Financial Year</label>
              <select class="form-select" name="financial_year_id" id="financial_years">
                  @foreach ($financialYears as $financialYear)
                  <option value="{{ $financialYear->id }}">{{ $financialYear->financial_year_name }}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputUsername2">Facility</label>
              <select class="form-select" name="facility_id" id="facilities">
                  @foreach ($facilities as $facility)
                  <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Total</label>
            <input type="number" name="total" class="form-control" placeholder="Total" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Status</label>
            <input type="text" name="status" class="form-control" placeholder="Status" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">LPO</label>
            <input type="number" name="lpo" class="form-control" placeholder="LPO" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Approved for Supply</label>
            <input type="text" name="approved_for_supply" class="form-control" placeholder="Approved for Supply" required>
          </div>

        </div>

        <div>
          <button type="submit" class="btn btn-success mt-3">Add Invoice</button>
        </div>
        </form>

      </div>
    </div>
  </div>

@endsection
