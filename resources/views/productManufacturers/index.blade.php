@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;

    }

    </style>
@endpush

@section('content')


<div class="row mb-3">
    <div class="col-sm-9">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('productManufacturers.index') }}">Product Manufacturers Table</a>
                {{-- <li class="breadcrumb-item active" aria-current="page">Create productManufacturer</li> --}}
            </ol>
        </nav>
    </div>
    <div class="col-sm-3 flex-end">
        <div class="create-productManufacturer">
            <a href="{{ route('productManufacturers.create') }}" style="width: 100%" class="btn btn-primary">Add New
                 Manufacturer <span style="position: relative; top:2px; left: 2px"><ion-icon name="add-circle-outline"></ion-icon></span>
            </a>
        </div>
    </div>
</div>

@if (session('status'))
<div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill" /></svg>
    <p class="text-success">
        {{ session('status') }}
    </p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTableExample">
                        <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Name</th>
                                <th class="pt-0">Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 1; ?>
                            @foreach ($productManufacturers as $productManufacturer)
                            <tr>
                                <td>{{ $number }}</td>
                                <?php $number++; ?>

                                <td>{{ $productManufacturer->name }}</td>

                                <td>{{ $productManufacturer->location }}</td>

                                <td>
                                    <div class="row">
                                        <div class="d-flex">
                                            <div style="padding-right:5px;">
                                                <a href="{{ url('productManufacturers/' .$productManufacturer->id . '/edit') }}">
                                                    Edit
                                                </a>
                                            </div>

                                            {{-- DISABLE MANUFACTURER --}}

                                            <div style="padding-right:5px;">
                                                <form role="form" method="post"
                                                    action="{{ url('disable/'.$productManufacturer->id .'/edit' )}}"
                                                    accept-charset="UTF-8">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ( $productManufacturer->disabled == true )
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-toggle="tooltip" data-placement="top" title="Enable">
                                                        Enable
                                                    </button>
                                                    @elseif ( $productManufacturer->disabled == false )
                                                    <button type="submit" class="btn btn-sm btn-warning"
                                                        data-toggle="tooltip" data-placement="top" title="Disable">
                                                        Disable
                                                    </button>
                                                    @endif


                                                </form>
                                            </div>

                                            {{-- END DISABLE MANUFACTURER --}}


                                            <form action="{{ url('productManufacturers/'.$productManufacturer->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete">

                                            </form>
                                        </div>
                                    </div>
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


@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function () {
            $('#dataTableExample').DataTable();
        });

    </script>
@endpush
