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
                    <li class="breadcrumb-item"><a href="#">Subcounty Top Up Requests</a></li>
                </ol>
            </div>
        </div>
    </div>  
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Subcounty Top Up Requests</h6>
                {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> </p> --}}
                <div class="table-responsive m-3">

                    <table id="dataTableExample" class="table table-striped table-bordered">
                        <thead style="">
                            <tr>
                                <th>#</th>
                                <th>Facility</th>
                                <th>Ward</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="rights-tbody">
                            <?php $number = 1; ?>
                            @foreach ($topups as $topup)
                                <tr>
                                    <td>{{ $number }}</td>
                                    <?php $number++; ?> 
                                    <td>{{ App\Models\Facility::where('id', '=', $topup->facility_id)->first()->name; }}</td>
                                    <td>{{ App\Models\Ward::where('id', '=', $topup->ward_id)->first()->ward_name; }}</td>
                                    <td>{{ App\Models\Location::where('id', '=', $topup->location_id)->first()->location_name; }}</td>
                                    <td><p class="text-warning" id="show-details" data-bs-toggle="modal" data-bs-target="#topup_{{$topup->id}}">Process</a></td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach ($topups as $topup)
<div class="modal fade" id="topup_{{$topup->id}}" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLongTitle">{{ App\Models\Facility::where('id', '=', $topup->facility_id)->first()->name; }} Facility Products Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <p class="mb-1"><span class="text-muted">Facility Name: </span> {{ App\Models\Facility::where('id', '=', $topup->facility_id)->first()->name; }}</p><br>
          <p class="mb-1"><span class="text-muted">Facility Pharmacy: </span> {{ App\Models\Facility::where('id', '=', $topup->facility_id)->first()->name;}}</p><br>
          <p class="mb-1"><span class="text-muted">Contact: </span> {{ App\Models\Facility::where('id', '=', $topup->facility_id)->first()->contact;}}</p>
        </div>
        <br>

        <div class="table-responsive">
            <table id="dataTableExample" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product Name</th>
                  <th>Strength</th>
                  <th>Unit of Issue</th>
                  <th>Unit Size</th>
                  <th>Available Units</th>
                  <th>Requested Units</th>
                  <th>Facility Quantity</th>
                  <th>Quantity Allocated</th>
                </tr>
              </thead>
              <tbody>
                <?php $number = 1; ?>
                @foreach ($topups as $topup)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{$topup -> product_name}}</td>
                    <td>{{$topup -> strength}}</td>
                    <td>{{$topup -> unit_of_issue}}</td>
                    <td>{{$topup -> unit_size}}</td>
                    <td>{{$topup -> available_units}}</td>
                    <td>{{$topup -> requested_units}}</td>

                    <td>{{$topup -> product_name}}</td>
                    <td>{{$topup -> product_name}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Submit <span><ion-icon name="add-circle-outline"></ion-icon></span></button>
      </div>
    </div>
  </div>
</div>
@endforeach
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