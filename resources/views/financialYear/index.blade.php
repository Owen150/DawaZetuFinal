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
        <li class="breadcrumb-item"><a href="{{ route('financialYear.index') }}">Financial Year</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Create year</li> --}}
    </ol>
    <div class="cancel">
        <div></div>
        <a  href="{{ route('financialYear.create') }}" class="btn btn-primary">Create New
            Financial Year <ion-icon style="position: relative; top:2px; left: 2px" name="add-circle-outline"></ion-icon>
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
          <h6 class="card-title">Staff Table</h6>
          <p class="text-muted mb-3"></p>
          <div class="table-responsive">
              
            <table id="dataTableExample" class="table table-striped table-bordered">
              <thead style="">
                <tr>
                    <th class="pt-0">#</th>
                    <th class="pt-0">Name</th>
                    <th class="pt-0">Start Date</th>
                    <th class="pt-0">End Date</th>
                    <th>More</th>
                </tr>
              </thead>
              <tbody >
                
                    <?php $number = 1; ?>
                    @foreach ($financialYears as $financialYear)
                    <tr>
                        <td>{{ $number }}</td>
                        <?php $number++; ?>

                        <td>{{ $financialYear->name }}</td>

                        <td>{{ $financialYear->start_date }}</td>

                        <td>{{ $financialYear->end_date }}</td>

                        <td>
                            <div class="row">
                                <div class="d-flex">
                                    <div style="padding-right:10px;">
                                        <a href="{{ url('financialYear/' .$financialYear->id . '/edit') }}"
                                            class="text-success mr-3">
                                            Edit
                                        </a>
                                    </div>
                                    <form action="{{ url('financialYear/'.$financialYear->id) }}" method="post" id="deleteFyear">
                                        @csrf
                                        @method('DELETE')
                                        <p class="text-danger" id="delete-btn" onclick="submitForm()">Delete</p>
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
@endpush
