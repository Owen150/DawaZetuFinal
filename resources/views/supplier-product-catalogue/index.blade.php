@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
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

  .btn-div {
      display: flex;
      flex-direction: row-reverse;
      gap: 5px;
    }
  </style>
@endpush

@section('content')
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item"><a href="#">Supplier Products Catalogue</a></li>
    <li class="breadcrumb-item active" aria-current="page">Supplier Products Catalogue Table</li>
  </ol>

  <div class="btn-div">
    <button type="button" class="btn btn-success mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Export Excel <span class="ml-2 mt-2 pt-2"><ion-icon name="chevron-up-circle-outline"></ion-icon></span></button>     
    <button type="button" class="btn btn-warning mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#receiveModal">Import Excel <span class="ml-2 mt-2 pt-2"><ion-icon name="chevron-down-circle-outline"></ion-icon></span></button>
  </div>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Supplier Products Catalogue Table</h6>
        <div class="table-responsive">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
            
          <table class="table table-striped table-bordered" id="dataTableExample" >
            <thead>
              <tr>
                <th>#</th>
                <th>Supplier Name</th>
                <th>Product Code</th>
                <th>Available Amount</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($supplierProductCatalogue as $supplierProductCatalogue)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ App\Models\Supplier::where('id','=', $supplierProductCatalogue->supplier_id)->first()->name }}</td>
                    <td>{{ $supplierProductCatalogue->product_code }}</td>
                    <td>{{ $supplierProductCatalogue->available_amount }}</td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      
      <div class="modal-body">
        <form action="{{route('catalogue_download')}}" method="post">
          @csrf
        <label for="role" class="form-label">Select Supplier</label>
        <select class="form-select" name="supplier" id="supplier" required>
          @foreach ($suppliers as $supplier)
            <option  value="{{$supplier->id}}">{{$supplier->name}}</option>
          @endforeach
        </select>        
        <button id="download-excel" type="submit" class="btn btn-success mt-2">Download Excel</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="receiveModal" tabindex="-1" aria-labelledby="receiveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="receiveModalLabel">Select Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      
      <div class="modal-body">
        <form action="{{route('catalogue_upload')}}" method="post" enctype="multipart/form-data">
          @csrf
        <label for="role" class="form-label">Upload supplier product catalog excel file</label>
        
        <input type="file" id="myDropify" name="supplier_catalogue"/>
        
        <button  type="submit" class="btn btn-success mt-2">Import Excel</button>
      </form>
      </div>
    
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script defer>
    
    var del = document.getElementById('product-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush