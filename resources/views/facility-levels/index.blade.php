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
    #delete-btn:hover {
        cursor: pointer;
    }
  </style>
@endpush

@section('content')
<nav class="mynav page-breadcrumb">
    <ol class="breadcrumb" style="flex-none">
        <li class="breadcrumb-item"><a href="{{ route('facility-levels.index') }}">Facility Levels</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Create year</li> --}}
    </ol>
    <div class="cancel">
        <div></div>
        <a  href="{{ route('facility-levels.create') }}" class="btn btn-primary">Add Facility Level <ion-icon style="position: relative; top:2px; left: 2px" name="add-circle-outline"></ion-icon>
        </a>
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
          <p class="text-muted mb-3"></p>
          <div class="table-responsive">
              
            <table id="dataTableExample" class="table table-striped table-bordered">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Facility Level</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody >
                
                    <?php $number = 1; ?>
                    @foreach ($facilityLevels as $facilityLevel)
                    <tr>
                        <td>{{ $number }}</td>
                        <?php $number++; ?>

                        <td>{{ $facilityLevel->level }}</td>

                        <td><span class="text-success">{{ $facilityLevel->status }}</span></td>

                        <td style="display: flex; gap: 10px">
                            <a href="" data-toggle="tooltip" data-placement="right" title="Enable Facility Level"><button class="btn btn-sm btn-success">Enable <span><ion-icon style="position: relative; top:2px; left: 2px" name="checkmark-outline"></ion-icon></span></button></a>
                            <form id='frm'
                             action="{{ route('products.destroy',$facilityLevel->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" id="product-delete" class="text-danger" data-toggle="tooltip" data-placement="left" title="Disable Facility Level">Disable <span><ion-icon style="position: relative; top:2px; left: 2px" name="close-outline"></ion-icon></span></button>
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
<script defer>
    $('#dataTableExample').DataTable({
        "aLengthMenu": [
            [10, 30, 50, -1],
            [10, 30, 50, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
            search: ""
        }
    });

    $('#dataTableExample').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
    });

    function submitForm() {
        $('#deleteFyear').submit();
    }
</script>
<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush
