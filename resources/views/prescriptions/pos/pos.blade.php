@extends('layouts.app')

@section('content')

<form action="" method="">
    @csrf

    <div class="row" style="padding: 20px">

        <div class="col-md-4">

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

        <div class="col-md-8" style="background: #fff;border-radius:0.25rem">
            <!-- patient input -->
            <div class="p-2 patient-input-div">
                <div></div>
                <div>
                    <input data-bs-toggle="modal" data-bs-target="#exampleModalCenter" placeholder="Patient Name"
                        class="patient-input" type="text" name="" id=""><span class="icon-add-span bg-success"
                        style="width: 10px;padding:7.5px; font-size: 18px;">
                        <ion-icon data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="icon-add"
                            name="add-circle-outline"></ion-icon>
                    </span>
                </div>
            </div>
            <hr>
            <div class="container-fluid mt-2 d-flex justify-content-center w-100">
                <div class="table-responsive w-100">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th class="text-end">Batch</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="mb-3">
                            <tr class="">
                                <td class="text-start">1</td>
                                <td class="text-start">
                                    <input id="description" class="description" name="description[]" readonly type="text"
                                        placeholder="0.00" aria-label="default input example" autocomplete="off"
                                        style="width:150px">
                                </td>
                                <td>
                                    <input id="batch" class="batch" name="batch[]" readonly type="text"
                                        placeholder="0.00" aria-label="default input example" autocomplete="off"
                                        style="width:100px">
                                </td>
                                <td>
                                    <input id="price" class="price" name="price[]" readonly type="text"
                                        placeholder="0.00" aria-label="default input example" autocomplete="off"
                                        style="width:80px">
                                </td>
                                <td>
                                    <input id="quantity" class="quantity" name="quantity[]" readonly type="text"
                                        placeholder="0.00" aria-label="default input example" autocomplete="off"
                                        style="width:80px">
                                </td>
                                <td>
                                    <input id="total" class="total" name="total[]" readonly type="text"
                                        placeholder="0.00" aria-label="default input example" autocomplete="off"
                                        style="width:100px">
                                </td>
                                <td class="p-1">
                                    <div style="width: 20px;background: #fca5a5; border-radius:0.15rem; border: 0.7px solid #ef4444; "
                                        class="text-center"><i class="fa-solid fa-trash-can"
                                            style="color: #ef4444; font-size: 10px; "></i></div>
                                </td>
                            </tr>
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

                                    <tr class="bg-white" style="border-radius: 0.25rem;">
                                        <td class="text-bold-800">Total</td>
                                        <td class="text-bold-800 text-end">$ 12,000.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payment-end row d-flex mt-5">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="d-flex">
                        <button class="btn btn-success m-2" data-bs-toggle="modal"
                            data-bs-target="#mpesa">Mpesa</button>
                        <button class="btn btn-warning m-2" data-bs-toggle="modal" data-bs-target="#cash">Cash</button>
                        <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#bank">Bank</button>
                        <button class="btn btn-danger m-2">Exit <ion-icon style="" name="exit-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                {{-- <div class="col-sm-1"></div> --}}
            </div>
        </div>

    </div>

    <!-- Modal patient records -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Patient Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" class="form-control" name="name" type="text" autocomplete="off" required
                                placeholder="Patient Name">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" class="form-control" name="email" type="email" autocomplete="off" required
                                placeholder="patient@mail.com">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input id="phone_number" class="form-control" name="phone_number" type="text"
                                autocomplete="off" required placeholder="+254700000000">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" class="form-control" name="address" type="text" autocomplete="off"
                                required placeholder="Enter Address">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Patient</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Mpesa Payment -->
    <div class="modal fade" id="mpesa" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Mpesa Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2">
                            <label for="mpesa_amount" class="form-label">Amount Paid</label>
                            <input id="mpesa_amount" class="form-control" name="mpesa_amount" type="text"
                                autocomplete="off" required placeholder="0.00">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save Payment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cash Payment -->
    <div class="modal fade" id="cash" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Cash Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2">
                            <label for="cash_amount" class="form-label">Amount Paid</label>
                            <input id="cash_amount" class="form-control" name="cash_amount" type="text"
                                autocomplete="off" required placeholder="0.00">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Save Payment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bank Payment -->
    <div class="modal fade" id="bank" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Bank Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2">
                            <label for="bank_amount" class="form-label">Amount Paid</label>
                            <input id="bank_amount" class="form-control" name="bank_amount" type="text"
                                autocomplete="off" required placeholder="0.00">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Payment</button>
                </div>
            </div>
        </div>
    </div>
</form>


@endsection
