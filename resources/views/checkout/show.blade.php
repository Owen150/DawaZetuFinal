@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="co">

                <!-- top search bar -->
                <div class="search-bar mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="product" class="js-example-basic-single form-select" data-width="100%">
                                <option value="">Select Medicine</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="" id="" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                </div>

                <!-- product catalogue -->
                <div class="product-catalogue">
                    <div class="row">
                        <!--- col for each product --->
                        <div class="col-md-4 mb-2">
                            <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                                <div class="item-image position-relative overflow-hidden">
                                    <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="panel-footer border-0 bg-white p-3">
                                    <h6 class="item-details-title">Napa(500)</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-2">
                            <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                                <div class="item-image position-relative overflow-hidden">
                                    <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="panel-footer border-0 bg-white p-3">
                                    <h6 class="item-details-title">Napa(500)</h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-2">
                            <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                                <div class="item-image position-relative overflow-hidden">
                                    <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="panel-footer border-0 bg-white p-3">
                                    <h6 class="item-details-title">Napa(500)</h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-2">
                            <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                                <div class="item-image position-relative overflow-hidden">
                                    <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="panel-footer border-0 bg-white p-3">
                                    <h6 class="item-details-title">Napa(500)</h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-2">
                            <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                                <div class="item-image position-relative overflow-hidden">
                                    <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="panel-footer border-0 bg-white p-3">
                                    <h6 class="item-details-title">Napa(500)</h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-2">
                            <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                                <div class="item-image position-relative overflow-hidden">
                                    <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="panel-footer border-0 bg-white p-3">
                                    <h6 class="item-details-title">Napa(500)</h6>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-2">
                            <div class="product-panel bg-white overflow-hidden border-0 shadow-sm">
                                <div class="item-image position-relative overflow-hidden">
                                    <img src="https://pharmacaredemo.bdtask-demo.com/pharmacare-9.4_demo/assets/dist/img/products/1613648757_2610e132926e221ae6a4.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="panel-footer border-0 bg-white p-3">
                                    <h6 class="item-details-title">Napa(500)</h6>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/checkout/in-house') }}" method="post">
                        @csrf

                        <div class="table">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prescription_details as $prescription_detail)
                                    <tr>
                                        <td>
                                            @foreach ($products as $product)
                                                @if ($prescription_detail->product == $product->id)
                                                    {{ $product->product_name }}
                                                @endif
                                            @endforeach

                                            <input hidden type="text" name="patient_number"
                                                value="{{ $prescription_detail->patient_number }}" class="form-control">
                                            <input hidden type="text" name="product_id[]"
                                                value="{{ $prescription_detail->product }}" class="form-control">


                                        </td>
                                        <td>
                                            {{ $prescription_detail->quantity }}
                                            <input type="text" name="quantity[]" hidden
                                                value="{{ $prescription_detail->quantity }}" class="form-control">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer">

                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-sm btn-primary">
                                            Confirm & Save
                                        </button>
                                        {{-- <a href="{{ url('/checkout/in-house') }}" class="btn btn-sm btn-primary
                                        m-2">
                                        Confirm & Save
                                        </a> --}}
                                        <a href="{{ url('/checkout/out') }}" class="btn btn-sm btn-info m-2">
                                            Release
                                        </a>

                                        <button class="btn btn-sm btn-danger m-2">
                                            Exit
                                            <ion-icon style="" name="exit-outline"></ion-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
