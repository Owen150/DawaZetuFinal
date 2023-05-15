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
    <li class="breadcrumb-item"><a href="{{ route('profomas.index') }}">Proforma Invoices</a></li>
    <li class="breadcrumb-item active" aria-current="page">Proforma Invoices Table</li>
  </ol>

  <div class="cancel">
    <div></div>
    @if (Auth::user()->role == 'cp')
    <a class="btn btn-success mb-1 mb-md-0" href="{{route('consolidate')}}" >Consolidate</a>
    @endif
  </div>
</nav>
@if (Session::has('success'))
    <div class="alert alert-success" role="alert" >
        {{Session::get('success')}}
    </div> 
@endif

@if (Session::has('unsuccess'))
    <div class="alert alert-danger" role="alert" >
        {{Session::get('unsuccess')}}
    </div> 
@endif
<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Proforma Invoices Table</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-bordered table-striped mt-3">
            <thead>
              <tr>
                <th>#</th>
                <th>Inv Num</th>
                <th>Financial Year</th>
                <th>period</th>
                <th>Supplier</th>
                <th>Amount (KSH)</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($invoiceProforma as $invoiceProforma)
                @if (Auth::user()->role == 'co')
                  @if ($invoiceProforma->status_director == 1)
                  <tr>
                  
                      
                  
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ str_pad($invoiceProforma->id, 6, 0, STR_PAD_LEFT) }}</td>
                    <td>{{ App\Models\FinancialYear::where('id','=', $invoiceProforma->financial_year_id)->first()->name }}</td>
                    <td>Quarter {{$invoiceProforma->period}}</td>
                    <td>{{ App\Models\Supplier::where('id','=', $invoiceProforma->supplier_id)->first()->name }}</td>
                    <td>{{number_format($invoiceProforma->amount, 2)}}</td>
                    <td>{{ $invoiceProforma->created_at->toFormattedDateString() }}</td>
                    <td>
                      @if (Auth::user()->role == 'cd')
                        @if ($invoiceProforma->status_director == 0)
                          <span class="badge bg-warning text-dark">pending</span>
                        @else
                          <span class="badge bg-success">Approved</span>
                        @endif   
                      @endif
  
                      @if (Auth::user()->role == 'co')
                        @if ($invoiceProforma->status_co == 0)
                          <span class="badge bg-warning text-dark">pending</span>
                        @else
                          <span class="badge bg-success">Approved</span>
                        @endif
                      @endif
  
                      @if (Auth::user()->role == 'cp' || Auth::user()->role == 'admin')
                        @if ($invoiceProforma->status_co == 0 && $invoiceProforma->status_director == 0)
                          <span class="badge bg-warning text-dark">pending co & cd</span>
                        @endif
  
                        @if ($invoiceProforma->status_co == 1 && $invoiceProforma->status_director == 0)
                          <span class="badge bg-warning text-dark">pending cd</span>
                        @endif
  
                        @if ($invoiceProforma->status_co == 0 && $invoiceProforma->status_director == 1)
                        <span class="badge bg-warning text-dark">pending co</span>
                        @endif
  
                        @if ($invoiceProforma->status_co == 1 && $invoiceProforma->status_director == 1)
                        <span class="badge bg-success">Approved</span>
                        @endif
                      @endif
                    </td>
                    <td style="display: flex; gap: 10px">
                      
                        <a href="{{route('profomas.show', $invoiceProforma->id)}}"><span class="text-success">Show Details</span></a>
                        {{--
                        <form id='frm'
                         action="{{ route('profomas.destroy', $invoiceProforma->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <span id="profoma-delete" class="text-danger">Delete</span>
                        </form>
                        --}}
                    </td>
                </tr>  
                  @endif
                @else
                <tr>
                  
                      
                  
                  <td>{{ $number }}</td>
                  <?php $number++; ?>
                  <td>{{str_pad($invoiceProforma->id, 5, 0, STR_PAD_LEFT) }}</td>
                  <td>{{ App\Models\FinancialYear::where('id','=', $invoiceProforma->financial_year_id)->first()->name }}</td>
                  <td>Quarter {{$invoiceProforma->period}}</td>
                  <td>{{ App\Models\Supplier::where('id','=', $invoiceProforma->supplier_id)->first()->name }}</td>
                  <td>{{number_format($invoiceProforma->amount, 2)}}</td>
                  <td>{{ $invoiceProforma->created_at->toFormattedDateString() }}</td>
                  <td>
                    @if (Auth::user()->role == 'cd')
                      @if ($invoiceProforma->status_director == 0)
                        <span class="badge bg-warning text-dark">pending</span>
                      @else
                        <span class="badge bg-success">Approved</span>
                      @endif   
                    @endif

                    @if (Auth::user()->role == 'co')
                      @if ($invoiceProforma->status_co == 0)
                        <span class="badge bg-warning text-dark">pending</span>
                      @else
                        <span class="badge bg-success">Approved</span>
                      @endif
                    @endif

                    @if (Auth::user()->role == 'cp' || Auth::user()->role == 'admin')
                      @if ($invoiceProforma->status_co == 0 && $invoiceProforma->status_director == 0)
                        <span class="badge bg-warning text-dark">pending co & cd</span>
                      @endif

                      @if ($invoiceProforma->status_co == 1 && $invoiceProforma->status_director == 0)
                        <span class="badge bg-warning text-dark">pending cd</span>
                      @endif

                      @if ($invoiceProforma->status_co == 0 && $invoiceProforma->status_director == 1)
                      <span class="badge bg-warning text-dark">pending co</span>
                      @endif

                      @if ($invoiceProforma->status_co == 1 && $invoiceProforma->status_director == 1)
                      <span class="badge bg-success">Approved</span>
                      @endif
                    @endif
                  </td>
                  <td style="display: flex; gap: 10px">
                    
                      <a href="{{route('profomas.show', $invoiceProforma->id)}}"><span class="text-success">Show Details</span></a>
                      {{--
                      <form id='frm'
                       action="{{ route('profomas.destroy', $invoiceProforma->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <span id="profoma-delete" class="text-danger">Delete</span>
                      </form>
                      --}}
                  </td>
                </tr> 
                @endif
                
                
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <form action="{{route('consolidate')}}" method="post">
    
  <div class="modal-dialog modal-dialog-centered">
    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        @csrf

        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="period">Invoice Number</label>
            <input type="text" name="inv_number" class="form-control" placeholder="Inv Num" required>
          </div>
          <div class="col-md-12 mb-3">
            <label for="period">Select supplier</label>
            <select class="form-select" name="supplier" id="period" required>
              @foreach ($suppliers as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
               
               
            </select>
          </div>
          <div class="col-md-12">
            <label for="period">Period</label>
            <input type="text" id="period" name="period" class="form-control" value="{{getFinacialPeriod()}}" required>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Consolidate</button>
      </div>
    </form>
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
    
    var del = document.getElementById('profoma-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush