@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('profomas.index') }}">Proforma Invoices</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Invoice</li>
  </ol>
</nav>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <h3 class="card-title">Edit Invoice</h3>

        <form action="{{ route('profomas.update', $invoice_proforma->id) }}" method="POST">
            @csrf
            @method('PUT')

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Financial Year</label>
              <select class="form-select" name="financial_year_id" id="financial_years">
                @foreach ($financial_years as $financialYear)
                <option @if ($financialYear->id == $invoice_proforma->financial_year_id)
                    selected
                @endif value="{{ $financialYear->id }}">{{ $financialYear->financial_year_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Facility</label>
                <select class="form-select" name="facility_id" id="facilities">
                    @foreach ($facilities as $facility)
                    <option @if ($facility->id == $invoice_proforma->facility_id)
                        selected
                    @endif value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                    @endforeach
                </select>            
            </div>

            <div class="col-md-6">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Total</label>
                <input type="number" name="total" value="{{ $invoice_proforma->total }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Status</label>
                <input type="text" name="status" value="{{ $invoice_proforma->status }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">LPO</label>
                <input type="text" name="lpo" value="{{ $invoice_proforma->lpo }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-md-6">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Approved</label>
                <input type="text" name="approved_for_supply" value="{{ $invoice_proforma->approved_for_supply }}" class="form-control" id="categoryName" placeholder="">
            </div>

          </div>

          <div><button type="submit" class="btn btn-success mt-2">Update Invoice</button></div>
        </form>

      </div>
    </div>
  </div>


@endsection
