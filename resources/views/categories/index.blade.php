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
    grid-template-columns: 1fr 1fr !important;
    gap: 10px !important;
  }

 

  #category-delete:hover {
    cursor: pointer;
  }

  </style>
@endpush

@section('content')
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Categories Table</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('categories.create')}}"><button class="btn btn-primary">Add New Category <span><ion-icon style="position: relative; top:2px; left: 2px" name="add-circle-outline"></ion-icon></span></button></a>
  </div>
</nav>

@if (Session::has('success'))
<div class="alert alert-success" role="alert" id="success-al">
  {{Session::get('success')}}
</div>
@endif

@if (Session::has('unsuccess'))
<div class="alert alert-danger" role="alert" id="danger">
  {{Session::get('unsuccess')}}
</div>
@endif

<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Categories Table</h6>
        <div class="table-responsive ">
          <table id="dataTableExample" class="table table-bordered table-striped mt-3">
            <thead>
              <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

            <?php $number = 1; ?>

            @foreach ($categories as $category)
            <tr>
                <td>{{ $number }}</td>
                <?php $number++; ?>
                <td>{{ $category->category_name }}</td>
                <td>{{$category->type->name}}</td>
                <td class="my-td">
                
                    <a class="text-success" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                    <form id='cat'
                     action="{{ route('categories.destroy',$category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <span class="text-danger" id="category-delete">Delete</span>
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
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script defer>
    
    var del = document.getElementById('category-delete');
    var cat = document.getElementById('cat');
    del.addEventListener("click",function (e) {
        cat.submit();
    })
    
  </script>
@endpush