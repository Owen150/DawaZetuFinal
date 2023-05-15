@extends('layouts.app')

@push('plugin-styles')
  <style>
    .my-nav {
       display: flex;
    }

    .cancel-btn {
        width: 100%;
        text-align: end;
        
    }
    .click-here:hover {
      cursor: pointer;
      text-decoration: underline;
    }
    </style>
@endpush

@section('content')
<nav class="page-breadcrumb my-nav">
  <ol class="breadcrumb" style="width: 100%">
    <li class="breadcrumb-item"><a href="#">Invoice Profoma</a></li>
    <li class="breadcrumb-item active" aria-current="page">Show</li>
  </ol>

  <div class="cancel-btn">
    <a href="{{route('profomas.index')}}" class="btn btn-danger">Cancel</a>
  </div>
</nav>

@php
    $userRole = Auth::user()->role;
@endphp

@if ($userRole == 'cd' && $invoiceProforma->status_director == 0)
<div class="alert alert-warning" role="alert" id="approval">
  This document needs your approval
</div>

<div class="alert alert-warning" role="alert" id="approval-co">
  Wait for COUNTY MEDICAL DEPARTMENT CHIEF OFFICER to approve
</div>
@endif

@if ($userRole == 'co' && $invoiceProforma->status_co == 0)
<div class="alert alert-warning" role="alert" id="approval">
  This document needs your approval
</div>
@endif


<div class="alert alert-success" role="alert" id="success">
  Your have approved this document
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-3 ps-0">
            <a href="#" class="noble-ui-logo d-block mt-3">Noble<span>UI</span></a>                 
            <p class="mt-1 mb-1"><b>NobleUI Themes</b></p>
            <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p>
            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
            <p>{{$invoiceProforma->supplier->name}},<br> {{$invoiceProforma->supplier->location}},<br> {{$invoiceProforma->supplier->contract_number}}.</p>
          </div>
          <div class="col-lg-3 pe-0">
            <h4 class="fw-bold text-uppercase text-end mt-4 mb-2">invoice</h4>
            <h6 class="text-end mb-5 pb-4"># {{str_pad($invoiceProforma->id, 6, 0, STR_PAD_LEFT)}}</h6>
            <p class="text-end mb-1">Total</p>
            @php
                $amt = 0;

                foreach ($colls as $item) {
                    $purchaseOrder = App\Models\PurchaseOrder::where('id','=',$item)->first();

                    $amt += $purchaseOrder->total;
                }
            @endphp
            <h4 class="text-end fw-normal">ksh {{number_format($amt, 2)}}</h4>
            <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date :</span> {{$invoiceProforma->created_at->toFormattedDateString()}}</h6>
            
          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Facility</th>
                      <th class="text-end">Total</th>
                      
                    </tr>
                </thead>
                <tbody>
                 
                    <?php $number = 1; ?>  
                   @foreach ($colls as $item)
                   @php
                        
                        $purchaseOrder = App\Models\PurchaseOrder::where('id','=',$item)->first();
                        $facility = App\Models\Facility::where('id','=',$purchaseOrder->facility_id)->first();
                   @endphp
                   <tr class="text-end">
                    <td class="text-start">
                        {{ $number }}
                        
                    </td>
                    <?php $number++; ?>
                    <td class="text-start">
                        {{$facility->name}}
                    </td>
                    
                    <td>ksh {{number_format($purchaseOrder->total, 2)}}</td>
                   
                  </tr>

                   @endforeach
                  
              
                </tbody>
              </table>
            </div>
        </div>
        <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6 ms-auto">
                <div class="table-responsive">
                  <table class="table">
                      <tbody>
                        
                        <tr class="bg-light">
                          <td class="text-bold-800">Total Amount</td>
                          <td class="text-bold-800 text-end">ksh {{number_format($amt, 2)}}</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
                <br>
                <!-- approvals -->
                <div class="table-responsive">
                    <h6 class="mb-2">Approvals</h6>
                    
                    <table class="table">
                        <tbody>
                          
                          <tr class="">
                            <td class="text-bold-800">COUNTY DIRECTOR</td>
                            <td class="text-bold-800 text-end">
                                @if ($invoiceProforma->status_director == 1)
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                          </tr>

                          <tr class="">
                            <td class="text-bold-800">CHIEF OFFICER</td>
                            <td class="text-bold-800 text-end">
                              @if ($invoiceProforma->status_co == 1)
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                          </tr>

                          
                        </tbody>
                    </table>
                  </div>
            </div>
          </div>
        </div>
        <div class="container-fluid w-100">
          @if ($userRole == 'cd' && $invoiceProforma->status_director == 0)
            <a href="#" class="btn btn-primary float-end mt-4 ms-2" onclick="saveApproval()"><i data-feather="send" class="me-3 icon-md"></i>Approve Document</a>
          @endif
          @if ($userRole == 'co' && $invoiceProforma->status_co == 0)
            <a href="#" class="btn btn-primary float-end mt-4 ms-2" onclick="saveApproval()"><i data-feather="send" class="me-3 icon-md"></i>Approve Document</a>
          @endif
          
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
    $('#success').hide();

    $('#approval-co').hide();

    var userRole = '{{$userRole}}';

      function saveApproval() {
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('profoma','{{$invoiceProforma->id}}');
        data.append('user','{{Auth::user()->id}}');
        
        $.ajax({
            type: "POST",
            url: "{{ route('approve') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
              if(response == 1) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                
                $('#success').show('slow');
                
                $('#approval').hide('slow');

                setTimeout(changeLocation, 1500);
              } 
              if(response == 0) {
                  $('#danger').show();
              } 
              if(response == 2) {
                $("html, body").animate({ scrollTop: 0 }, "slow");

                $('#approval').hide('slow');

                $('#approval-co').show('slow');
              }  
               
                      
            }
        });
      }

      function changeLocation() {
        location.href = '/profomas'
      }
    
  </script>
@endpush