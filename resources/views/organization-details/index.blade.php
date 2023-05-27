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
    <li class="breadcrumb-item"><a href="{{ route('organization-details.index') }}">Organization Details</a></li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('subcounties.create')}}"><button class="btn btn-success mb-1 mb-md-0">Add Sub-county</button></a>
  </div>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Sub-counties Table</h6>
        <div class="table-responsive">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
            
          <table class="table table-bordered table-hover mt-3" id="dataTableExample" >
            <thead>
              <tr>
                <th>ID</th>
                <th>COUNTY ID</th>
                <th>CONSTITUENCY NAME</th>
                <th>WARD</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                                    
                @foreach ($subcounties as $subcounty)
                <tr>
                    <td>{{ $subcounty->id }}</td>
                    <td>{{ App\Models\County::where('id','=', $subcounty->county_id)->first()->id }}</td>
                    <td>{{ $subcounty->constituency_name }}</td>
                    <td>{{ $subcounty->ward }}</td>
                    <td style="display: flex; gap: 10px">
                        <a href="{{ route('subcounties.edit', $subcounty->id) }}"><span class="text-success">Edit</span></a>
                        <form id='frm'
                         action="{{ route('subcounties.destroy', $subcounty->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <span id="subcounty-delete" class="text-danger">Delete</span>
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
    
    var del = document.getElementById('subcounty-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush