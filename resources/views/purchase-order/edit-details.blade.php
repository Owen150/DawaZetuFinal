@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb" style="display: flex;">
    <ol class="breadcrumb" style="width: 100%">
        <li class="breadcrumb-item"><a href="#">Order Details</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Create order</li> --}}
    </ol>


    <div style="text-align:end;">
        <a href="" class="btn btn-danger" style="display: flex">
            <span style="position: relative; top: 3px; right: 3px;"><ion-icon name="hand-right-outline"></ion-icon></span>
            <span>Cancel</span> 
        </a>
    </div>
</nav>

{{-- @include('alert') --}}

<div class="container">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <form role="form" method="post" action="{{route('receiveOrder', $orderDetails->id)}}" >
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card mb-3">
                           
                            <div class="card-body">
                                <div class="card-header">
                                   <div class="row">
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="product_id">Medicine</label>
                                        @foreach ($products as $product)
                                            @if($orderDetails->product_id == $product->id)
                                            <input required type="text" class="form-control" name="product_id"
                                                placeholder="Enter Code" value="{{ $orderDetails->product_id }}" hidden>
                                            <input required type="text" class="form-control" name="product_id"
                                                placeholder="Enter Code" value="{{ $product->product_name }}" disabled>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="mb-3 col-sm-6">
                                        <label class="form-label" for="code">Code</label>
                                            <input required type="text" class="form-control" name="code"
                                                placeholder="Enter Code" value="{{$orderDetails->code}}" diabled>
                                            <input required type="text" class="form-control" name="code"
                                                placeholder="Enter Code" value="{{$orderDetails->code}}" hidden>
                                    </div>
                                   </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="batch_number">Batch No.</label>
                                            <input required type="text" class="form-control" name="batch_number"
                                                placeholder="Enter Code" value="{{ $orderDetails->batch_number }}">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="qty_ordered">Quantity Ordered</label>
                                            <input required type="number" class="form-control" name="qty_ordered"
                                                placeholder="Enter Quantity" value="{{ $orderDetails->qty_ordered }}">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label for="qty_received" class="form-label">Quantity Received</label>
                                            <input type="number" class="form-control" name="qty_received" onchange="totalAmt()" id="qty_received" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label for="expiry_date" class="form-label">Expiry Date</label>
                                            <input type="date" name="expiry_date" class="form-control" value="{{ $orderDetails->expiry_date }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="price">Price</label>
                                            <input required type="text" class="form-control" name="price" id="price"
                                                value="{{ $orderDetails->price }}" onchange="totalAmt()">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="total">Total</label>
                                            <p class="total form-control" id="total">
                                                0
                                                <input required type="number" class="form-control" name="total" id="total"
                                                    value="" hidden>
                                            </p>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div >
                                    <button type="submit" class="btn btn-success">Save Purchase Order</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('custom-scripts')

<script>

    function totalAmt() {
        let qty_received, price, total, totalAmt;
    
        qty_received = Number(document.getElementById('qty_received').value);
        price = Number(document.getElementById('price').value);
        total = document.getElementById('total');
        
        totalAmt = qty_received * price;

        total.innerHTML = totalAmt;
    }

</script>

@endpush