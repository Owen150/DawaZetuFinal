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
        <li class="breadcrumb-item"><a href="{{route('allocated-budget.index')}}">Allocated Budget</a></li>
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

                <form method="POST" action="{{ url('/storetopup') }}">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label" for="requested_by">Requested By</label>
                                    <input required type="text" class="form-control" placeholder="Requested By"
                                        id="requested_by" name="requested_by">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label" for="request_id">Request ID</label>
                                    <input required type="text" class="form-control" name="request_id"
                                        placeholder="Request ID">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label" for="facility_id">Facility</label>
                                    <select name="facility_id" id="" class="form-select">
                                        @foreach ($facilities as $facility)
                                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label" for="request_date">Date</label>
                                    <input required type="date" class="form-control" name="request_date">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        {{-- <hr> --}}
                        <h4 class="card-title mt-4">Request Medicines</h4>
                        <p class="text-muted mb-4">Add Medicines</p>

                        <div class="table-holder">
                            <table class="table table-responsive table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th class="pt-0">#</th>
                                        <th class="pt-0">Product Name</th>
                                        <th class="pt-0">Strength</th>
                                        <th class="pt-0">Unit of Issue</th>
                                        <th class="pt-0">Unit Size</th>
                                        <th class="pt-0">Available Units</th>
                                        <th class="pt-0">Requested Units</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $number = 1; ?>
                                    <tr>
                                        <td>{{ $number }}</td>
                                        <?php $number++; ?>
                                        <td>
                                            <select name="product_name[]" class="js-example-basic-single form-select" data-width="100%">
                                                <option value="">Select Medicine</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="strength[]" placeholder="Strength" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="unit_of_issue[]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="unit_size[]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="available_units[]" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" name="requested_units[]" class="form-control">
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
                    <?php $number = 1; ?>
                        {{ $number }}
                    <?php $number++; ?>
                <td>
                    <select name="product_name[]" class="js-example-basic-single form-select" data-width="100%">
                        <option value="">Select Medicine</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" name="strength[]" placeholder="Strength" class="form-control">
                </td>
                <td>
                    <input type="number" name="unit_of_issue[]" class="form-control">
                </td>
                <td>
                    <input type="number" name="unit_size[]" class="form-control">
                </td>
                <td>
                    <input type="number" name="available_units[]" class="form-control">
                </td>
                <td>
                    <input type="number" name="requested_units[]" class="form-control">
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