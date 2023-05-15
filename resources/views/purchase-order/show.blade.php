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

    </style>
@endpush

@section('content')
<nav class="page-breadcrumb my-nav">
  <ol class="breadcrumb" style="width: 100%">
    <li class="breadcrumb-item"><a href="#">Special pages</a></li>
    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
  </ol>

  <div class="cancel-btn">
    @if ($purchaseOrder->status != 'received' && Auth::user()->role == 'hfp')
    <a href="/purchase-order-receive/{{$purchaseOrder->id}}" class="btn btn-success">Receive <ion-icon  style="position: relative; font-size: 15px; top: 2.5px" name="caret-back-circle-outline"></ion-icon></a>
    @endif
    
    @if (Auth::user()->role == 'hfp')
    <a href="{{route('purchase-order.index')}}" class="btn btn-danger">back <ion-icon  style="position: relative; font-size: 15px; top: 2.5px" name="caret-back-circle-outline"></ion-icon></a>
    @else
    <a href="{{route('executives_purchase_order')}}" class="btn btn-danger">back <ion-icon  style="position: relative; font-size: 15px; top: 2.5px" name="caret-back-circle-outline"></ion-icon></a>
    @endif
   
  </div>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-3 ps-0">
            <a href="#" class="noble-ui-logo d-block mt-3">Proj<span>Trac</span></a>
            @if (Auth::user()->role !== 'hfp')
            <p class="mt-1 mb-1"><b>{{$purchaseOrder->facilities->name}}</b></p>
            <p>{{$purchaseOrder->facilities->location}},<br> {{$purchaseOrder->facilities->ward}},<br>{{$purchaseOrder->facilities->sub_county}}.</p>
            @endif
            @php
                $supplier = App\Models\Supplier::where('id','=',$purchaseOrder->supplier_id)->first();
            @endphp                 
            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
            <p>{{$supplier->name}},<br> {{$supplier->contract_number}},<br> {{$supplier->location}}.</p>
          </div>
          <div class="col-lg-3 pe-0">
            <h4 class="fw-bold text-uppercase text-end mt-4 mb-2">Purchase Order</h4>
            <h6 class="text-end  pb-4"># {{str_pad($purchaseOrder->id, 6, 0, STR_PAD_LEFT)}}</h6>
            
            <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">PO Date :</span> {{$purchaseOrder->created_at->toFormattedDateString()}}</h6>

          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Product</th>
                      <th class="text-end">Qty Ordered</th>
                      <th class="text-end">Price</th>
                      <th class="text-end">Batch</th>
                      <th class="text-end">Qty Received</th>
                      <th class="text-end">Exp Date</th>
                      
                      <th class="text-end">Total (ksh)</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                      $number = 1;
                  @endphp
                  @foreach ($purchaseOrder->purchaseorderdetails as $details)
                  <tr class="text-end">
                    <td class="text-start">
                      {{$number}}
                      @php
                          $number++;
                      @endphp
                    </td>
                    <td class="text-start">{{ App\Models\Product::where('id','=',$details->product_id)->first()->product_name }}</td>
                    <td>{{$details->qty_ordered}}</td>
                    <td>{{$details->price}}</td>
                    <td>
                      @if ($details->batch_number == 'null')
                      not delivered
                      @else
                      {{$details->batch_number}}
                      @endif
                    </td>
                    <td>
                      @if ($details->qty_received == 'null')
                      not delivered
                      @else
                      {{$details->qty_received}}
                      @endif
                    </td>
                    <td>
                      @if ($details->expiry_date == 'null')
                      not delivered
                      @else
                      {{$details->expiry_date}}
                      @endif
                    </td>
                   
                    <td>{{number_format($details->total, 2)}}</td>
                    
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
                          <td class="text-bold-800 text-end">ksh {{number_format($purchaseOrder->total, 2)}}</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection