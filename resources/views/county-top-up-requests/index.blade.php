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
                    <li class="breadcrumb-item"><a href="#">County Top Up Requests</a></li>
                </ol>
            </div>
        </div>
    </div>  
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">County Top Up Requests</h6>
                {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> </p> --}}
                <div class="table-responsive m-3">

                    <table id="dataTableExample" class="table table-striped table-bordered">
                        <thead style="">
                            <tr>
                                <th>#</th>
                                <th>Requested By</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="rights-tbody">
                            <?php $number = 1; ?>
                            @foreach ($topups as $topup)
                                <tr>
                                    <td>{{ $number }}</td>
                                    <?php $number++; ?> 
                                    <td>{{ $topup->requested_by }}</td>
                                    <td>{{ $topup->request_date }}</td>
                                    <td>{{ $topup->status }}</td>
                                    <td><a class="text-warning" href ="{{ route('showProcessed', $topup->id) }}">Approve</a></td>                                    
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