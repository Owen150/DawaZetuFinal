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

<nav class="page-breadcrumb rights-nav">
    
    <div class="row">
        <div class="col-sm-9">
            <div class="flex-initial">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Facility Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Facility Products</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-3">
            <div>
                <a href="{{route('facilityProducts.create')}}"><button type="button" class="btn btn-primary mb-1 mb-md-0"
                        style="width: 100%">Create Facility Products</button></a>
        
            </div>
        </div>
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
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Facility Products</h6>
                {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> </p> --}}
                <div class="table-responsive m-3">

                    <table id="dataTableExample" class="table table-striped table-bordered">
                        <thead style="">
                            <tr>
                                <th>#</th>
                               
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Reorder Level</th>
                            </tr>
                        </thead>
                        <tbody id="rights-tbody">
                            <?php $number = 1; ?>
                            @foreach ($facilityProducts as $facilityProduct)
                                <tr>
                                    <td>{{ $number }}</td>
                                    <?php $number++; ?>
                                    <td>
                                        @php
                                            
                                            $productName = App\Models\Product::where('id', '=', $facilityProduct->product_id)->first()->product_name;
                                        @endphp
                                        {{$productName}}
                                    </td>
                                    <td>
                                        @if ($facilityProduct->quantity > $facilityProduct->reorder_level)
                                            <p class="text-success">{{$facilityProduct->quantity}}</p>
                                        @else
                                            <p class="text-danger">{{$facilityProduct->quantity}}</p>
                                        @endif
                                    </td>
                                    <td>{{$facilityProduct->reorder_level}}</td>
                                   
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