@extends('layouts.app')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<style>
    .my-nav {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

</style>
@endpush

@section('content')

<nav class="page-breadcrumb my-nav">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Prescription</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>

    <div style="display: flex; flex-direction: row-reverse;">
        <button class="btn btn-danger">Cancel</button>
    </div>
</nav>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Prescriptions</h4>
                <p class="text-muted mb-4">Create Prescriptions</p>

                <form method="POST" action="{{ route('prescriptions.store') }}">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label" for="patient_number">Patient Number</label>
                                    <input required type="text" class="form-control" placeholder="Patient Number"
                                        id="patient_number" name="patient_number">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label" for="patient_name">Patient Name</label>
                                    <input required type="text" class="form-control" name="patient_name"
                                        placeholder="Patient Name">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label" for="prescription_date">Prescription Date</label>
                                    <input required type="date" class="form-control" name="prescription_date">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        {{-- <hr> --}}
                        <h4 class="card-title mt-4">Prescriptions</h4>
                        <p class="text-muted mb-4">Add Medicines</p>

                        <div class="table-holder">
                            <table class="table table-responsive table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        
                                        <th>Quantity</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="product[]" class="js-example-basic-single form-select" data-width="100%">
                                                @foreach ($products as $product)
                                                <option value="">Select Medicine</option>
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantity[]" placeholder="Quantity" class="form-control">
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success" name="add" id="add">Add More</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


@endsection

@push('custom-scripts')

<script>
    var i = 0;
    $('#add').click(function () {

        ++i;
        $('#table').append(
            `<tr>
                <td>
                    <select name="product[]" class="js-example-basic-single form-select" data-width="100%">
                        <option value="">Select Medicine</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="quantity[]" placeholder="Quantity" class="form-control">
                </td>
                <td>
                    <a class="btn btn-sm btn-danger remove-table-row">Remove</a>
                </td>
            </tr>`
        );
    })

    $(document).on('click', '.remove-table-row', function () {
        $(this).parents('tr').remove();
    })

</script>

@endpush
