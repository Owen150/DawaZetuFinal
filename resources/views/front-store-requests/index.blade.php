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

  .my-td {
    display: grid !important;
    grid-template-columns: 1fr 1fr 1fr !important;
    gap: 10px !important;
  }

  #product-delete {
    color: rgb(235, 2, 2);
  }

  #product-delete:hover {
    cursor: pointer;
  }
  #show-details:hover {
    cursor: pointer;
  }
  </style>
@endpush

@section('content')
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Products Table</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('products.create')}}"><button class="btn btn-primary mb-1 mb-md-0">Add Product</button></a>
  </div>
</nav>

<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Products Table</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-bordered table-striped mt-3">
            <thead>
              <tr>
                <th>#</th>
                <th>Requesition No</th>
                <th>Facility</th>
                <th>Requester</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($products as $product)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->unit_of_measure }}</td>
                    <td>{{ $product->package_size }}</td>
                    <td>{{ $product->package_quantity }}</td>
                    <td>{{ $product->no_of_items_in_box }}</td>
                    <td class="my-td">
                      
                        <a class="text-success"  href="{{ route('products.edit', $product->id) }}">Edit</a>
                        <p class="text-warning" id="show-details" data-bs-toggle="modal" data-bs-target="#product_{{$product->id}}">Show</a>
                        <form id='frm'
                         action="{{ route('products.destroy',$product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <span id="product-delete">Delete</span>
                        </form>
                      
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


<!-- Modal -->
@foreach ($products as $product)
<div class="modal fade" id="product_{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLongTitle">{{ $product->product_name }} Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <p class="mb-1"><span class="text-muted">MANUFACTURER: </span> {{ $product->manufacturers }}</p>
          <p class="mb-1"><span class="text-muted">STRENGHT: </span> {{ $product->strength }}</p>
          <p class="mb-1"><span class="text-muted">CATEGORY: </span> {{ App\Models\Category::where('id','=', $product->category_id)->first()->category_name }}</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
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
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script defer>
    
    var del = document.getElementById('product-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush