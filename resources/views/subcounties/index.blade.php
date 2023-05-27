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
    <li class="breadcrumb-item active"><a href="{{ route('subcounties.index') }}">Sub-counties Table</a></li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{route('subcounties.create')}}"><button class="btn btn-primary mb-1 mb-md-0">Add Sub-county <span><ion-icon style="position: relative; top:2px; left: 2px" name="add-circle-outline"></ion-icon></span></button></a>
  </div>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
            
          <table class="table table-bordered table-hover mt-3" id="dataTableExample" >
            <thead>
              <tr>
                <th>#</th>
                <th>SUBCOUNTY NAME</th>
                <th>STATUS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($subcounties as $subcounty)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ $subcounty->subcounty_name }}</td>
                    <td>{{ $subcounty->status }}</td>
                    <td style="display: flex; gap: 10px">
                        <a href="{{ route('subcounties.edit', $subcounty->id) }}" data-toggle="tooltip" data-placement="right" title="Enable Subcounty"><button class="btn btn-sm btn-success">Enable <span><ion-icon style="position: relative; top:2px; left: 2px" name="checkmark-outline"></ion-icon></span></button></a>
                        <form id='frm'
                         action="{{ route('subcounties.destroy', $subcounty->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" id="subcounty-delete" class="text-danger" data-toggle="tooltip" data-placement="left" title="Disable Subcounty">Disable <span><ion-icon style="position: relative; top:2px; left: 2px" name="close-outline"></ion-icon></span></button>
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
  <script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush