@extends('layouts.app')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('topup.index') }}">Store Top Up</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Top Up</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">Create Top Up</h3>
                            <p class="text-muted">Fill out details to create new Top Up</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('storetopup.index') }}" class="btn btn-md btn-danger">Cancel <span><i
                                        class="fa-solid fa-ban"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="requested_by">Requested By:</label>
                                <input required disabled type="text" class="form-control"
                                    value="{{ $topups->requested_by }}" placeholder="Enter Name" id="requested_by"
                                    name="requested_by">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="request_date">Date</label>
                                <input required disabled type="date" class="form-control"
                                    value="{{ $topups->request_date }}" name="request_date" placeholder="Enter Date">
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->


                    <div class="row">
                        <div class="col-md-12 stretch-card">
                            <div class="card">

                                <div class="card-body">

                                    <h6 class="card-title">Top Up Table</h6>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="dataTableExample">
                                            <thead>
                                                <tr>
                                                    <th class="pt-0">#</th>
                                                    <th class="pt-0">Product Name</th>
                                                    <th class="pt-0">Strength</th>
                                                    <th class="pt-0">Unit of Issue</th>
                                                    <th class="pt-0">Unit Size</th>
                                                    <th class="pt-0">Available Units</th>
                                                    <th class="pt-0">Requested Units</th>
                                                    <th class="pt-0">Allocated Units</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $number = 1; ?>
                                                @foreach ($topupDetails as $topupDetail)

                                                <tr>
                                                    <td>{{ $number }}</td>
                                                    <?php $number++; ?>

                                                    @foreach ($products as $product)     
                                                    <td>
                                                        <div class="form-group hidden">
                                                            <input hidden type="text" name="product_name[]" 
                                                            value="{{ $topupDetail->product_id }}" class="form-control">
                                                        </div>
                                                        @if ( $topupDetail->product_id = $product->id)
                                                            {{ $product->product_name }}
                                                        @endif
                                                    </td>
                                                    @endforeach


                                                    <td>
                                                        <div class="form-group hidden">
                                                            <input hidden type="text" name="strength[]"
                                                                value="{{ $topupDetail->strength }}"
                                                                class="form-control">
                                                        </div>
                                                        {{ $topupDetail->strength }}
                                                    </td>

                                                    <td>
                                                        <div class="form-group hidden">
                                                            <input hidden type="text" name="unit_of_issue[]"
                                                                value="{{ $topupDetail->unit_of_issue }}"
                                                                class="form-control">
                                                        </div>
                                                        {{ $topupDetail->unit_of_issue }}
                                                    </td>

                                                    <td>
                                                        <div class="form-group hidden">
                                                            <input hidden type="text" name="unit_size[]"
                                                                value="{{ $topupDetail->unit_size }}"
                                                                class="form-control">
                                                        </div>
                                                        {{ $topupDetail->unit_size }}
                                                    </td>

                                                    <td>
                                                        <div class="form-group hidden">
                                                            <input hidden type="text" name="available_units[]"
                                                                value="{{ $topupDetail->available_units }}"
                                                                class="form-control">
                                                        </div>
                                                        {{ $topupDetail->available_units }}
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <input hidden type="number" name="requested_units[]"
                                                                class="form-control"
                                                                value="{{ $topupDetail->requested_units }}">
                                                        </div>
                                                        {{ $topupDetail->requested_units }}
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input hidden type="number" name="allocated_units[]"
                                                                class="form-control"
                                                                value="{{ $topupDetail->allocated_units }}">
                                                        </div>
                                                        {{ $topupDetail->allocated_units }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection



@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/js/inputmask.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/typeahead.js') }}"></script>
<script src="{{ asset('assets/js/tags-input.js') }}"></script>
<script src="{{ asset('assets/js/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script src="{{ asset('assets/js/pickr.js') }}"></script>
<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush
