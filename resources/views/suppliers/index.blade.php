@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;

    }
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
        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Suppliers Table</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Create Supplier</li> --}}
    </ol>
    <div class="cancel">
        <div></div>
        <a href="{{route('suppliers.create')}}"><button class="btn btn-primary">Add A New Supplier <span><ion-icon style="position: relative; top:2px; left: 2px" name="add-circle-outline"></ion-icon></span></button></a>
    </div>
</nav>

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
            <div class="card-body">             
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTableExample">
                        <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Name</th>
                                <th class="pt-0">License</th>
                                <th class="pt-0">Location</th>
                                <th class="pt-0">Rank</th>
                                <th class="pt-0">Contact No.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $number = 1; ?>
                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $number }}</td>
                                <?php $number++; ?>

                                <td>{{ $supplier->name }}</td>

                                <td>{{ $supplier->license }}</td>

                                <td>{{ $supplier->location }}</td>

                                <td>{{ $supplier->rank }}</td>

                                <td>{{ $supplier->contract_number }}</td>

                                <td>
                                    <div class="row">
                                        <div class="d-flex">
                                            <div style="padding-right:5px;">
                                                <a href="{{ url('suppliers/' .$supplier->id . '/edit') }}">Edit</a>
                                            </div>
                                            <form action="{{ url('suppliers/'.$supplier->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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