@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <form role="form" method="post" action="{{ url('prescriptions/'.$prescription->id) }}" accept-charset="UTF-8">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Prescriptions</h4>
                    <p class="text-muted mb-4">Update Prescription Details</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="patient_number">Patient Number</label>
                                <input required type="text" class="form-control"
                                    value="{{ $prescription->patient_number }}" placeholder="Patient Number"
                                    id="patient_number" name="patient_number">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="patient_name">Patient Name</label>
                                <input required type="text" class="form-control" name="patient_name"
                                    value="{{ $prescription->patient_name }}" placeholder="Patient Name">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="prescription_date">Prescription Date</label>
                                <input required type="date" class="form-control"
                                    value="{{ $prescription->prescription_date }}" name="prescription_date">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="prescription_cost">Prescription Cost</label>
                                <input required type="number" class="form-control"
                                    value="{{ $prescription->prescription_cost }}" name="prescription_cost">
                            </div>
                        </div><!-- Col -->
                    </div>

                    <div class="row m-3">
                        <h4 class="card-title">Prescription Details</h4>
                        <p class="text-muted mb-4">Update Prescriptions</p>

                        <div class="table-holder">
                            <table class="table table-responsive table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescription_details as $prescription_detail)
                                    <tr>
                                        <td>
                                            {{-- @foreach ($products as $product)
                                                    <option value="">Select Medicine</option>
                                                    <option value="{{ $product->id }}">{{ $product->product_name }}
                                            </option>
                                            @endforeach --}}
                                            <input type="text" name="product[]" placeholder="" class="form-control"
                                                value="{{ $prescription_detail->product }}">
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" placeholder="Quantity"
                                                class="form-control" value="{{ $prescription_detail->quantity }}">
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="save">
                        <button class="btn btn-sm btn-success">Update Details</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('custom-scripts')

@endpush
