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
                <li class="breadcrumb-item"><a href="{{ route('productManufacturers.index') }}">Manufacturers</a> / <span class="text-muted">Management</span></li>
                {{-- <li class="breadcrumb-item active" aria-current="page">Create productManufacturer</li> --}}
            </ol>
        </nav>
    </div>
    <div class="col-sm-3 flex-end">
        <div class="create-productManufacturer">
            <a href="{{ route('productManufacturers.create') }}" style="width: 100%" class="btn btn-primary">Add A New
                 Manufacturer <span class="ml-2 mt-2 pt-2"><ion-icon name="add-circle-outline"></ion-icon></span>
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
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="card-title col-sm-9">
                            
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="card-title">Product Manufacturers Table</h6>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTableExample">
                        <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Name</th>
                                <th class="pt-0">Location</th>
                                <th>More</th>
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
                                                <a href="{{ url('productManufacturers/' .$productManufacturer->id . '/edit') }}"
                                                    class="btn btn-sm btn-success mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path
                                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                    </svg>
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-check2-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                            <path
                                                                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                                        </svg>
                                                    </button>
                                                    @elseif ( $productManufacturer->disabled == false )
                                                    <button type="submit" class="btn btn-sm btn-warning"
                                                        data-toggle="tooltip" data-placement="top" title="Disable">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-x-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                        </svg>
                                                    </button>
                                                    @endif


                                                </form>
                                            </div>

                                            {{-- END DISABLE MANUFACTURER --}}


                                            <form action="{{ url('productManufacturers/'.$productManufacturer->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
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
