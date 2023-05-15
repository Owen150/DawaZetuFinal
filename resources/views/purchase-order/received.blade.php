@extends('layouts.app')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<style>
    .my-nav {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .table-div-wrapper {}

    #input {
        outline: none !important;
        border: none !important;
        border: 1px solid #e5e7eb !important;
        height: 36px !important;
        width: 100% !important;
        background: #fff;
        border-radius: 0.25rem;
        padding-left: 10px !important;
        color: rgb(68, 68, 68);
    }

    table {
        border-top: 4px solid rgb(107 33 168) !important;
        border-bottom: 1px solid rgb(148 163 184);
        border-right: 1px solid rgb(148 163 184);
        border-left: 1px solid rgb(148 163 184);
        table-layout: auto;
        width: 100% !important;
    }

    table tbody {

        
        height: 60vh;
        overflow-y: scroll;
        overflow-x: auto;
    }

    table td {
        margin: 0 !important;
        padding: 1px !important;
        border: none !important;
        height: 36px !important;
    }

    thead {
        background-color: rgb(147 51 234) !important;
        color: black !important;
        
    }

    .my-flex {
        display: flex;
    }

    #add:hover {
        cursor: pointer;
    }

    .deletes:hover {
        cursor: pointer;
    }

</style>
@endpush

@section('content')


<div class="alert alert-success" role="alert" id="success">
    Record was added successfully
</div>

<div class="alert alert-danger" role="alert" id="danger">
    Sytem error: Ensure all values are filled correctly
</div>
<form method="POST" action="{{route('orderFacility', $order->id)}}" id="purchase_form" enctype="multipart/form-data">
    @csrf
    {{-- {{ url('purchase-order/'.$order->id) }} --}}
    @method('PUT')
    
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card mb-3">
                <div class="card-header" style="display: flex">
                    <h5 style="width: 20vw">Peter</h5>

                    <div style="display: flex;width: 100%; flex-direction: row-reverse; gap: 10px">
                        <button type="button" id="save-order" class="btn btn-success">Save Order</button>
                        <button type="button" id="reject" class="btn btn-danger">Reject</button>
                        <button type="button" id="change" class="btn btn-warning">Change Order</button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="form-label">Order Number</label>
                            <input id="designation" class="form-control" name="order_number" type="text"
                                autocomplete="off" required placeholder="Order Number" required value="{{str_pad($order->id, 6, 0, STR_PAD_LEFT)}}">
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Facility</label>
                            <select onChange="getData(this)" name="facility" class="form-select" data-width="100%">
                               

                                <option value="{{$order->facility_id}}">{{App\Models\Facility::where('id','=',$order->facility_id)->first()->name}}</option>
                             

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Finacial Year</label>
                            <select onChange="getData(this)" name="finacial_year" class="form-select" data-width="100%">
                                @foreach ($finacialyears as $finacialyear)

                                <option value="{{$finacialyear->id}}">{{$finacialyear->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="delivered_by" class="form-label">Delivered By</label>
                            <input id="designation" class="form-control" name="delivered_by" type="text"
                                autocomplete="off"  placeholder="Delivery By" required value="{{ $order->delivered_by }}">
                        </div>
                        <div class="col-md-6">
                            <label for="delivery_vehicle_num" class="form-label">Delivery Vehicle Number</label>
                            <input id="designation" class="form-control" name="delivery_vehicle_num" type="text"
                                autocomplete="off"  placeholder="Delivery Vehicle Number" required value="{{ $order->delivery_vehicle_num }}">
                        </div>
                    </div>

                    

                    <hr>


                    <div class="table-div-wrapper">
                        <table class="table scroll table-hover">
                            <thead>
                                <tr>

                                    <th scope="col" style="color:#fff;">Medicine</th>
                                    
                                    <th scope="col" style="color:#fff">Batch Id</th>
                                    <th scope="col" style="color:#fff">Qty Received</th>

                                    <th scope="col" style="color:#fff">Expiry Date</th>
                                    
                                    

                                   
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($purchaseOrder as $details)
                                <tr>

                                    <td style="border: 1px solid rgb(148 163 184);">
                                        <select onChange="getData(this)" name="product[]"
                                            class="js-example-basic-single" data-width="100%">
                                            @foreach ($products as $product)
                                            <option value="">Select Medicine</option>
                                            <option @if($details->product_id == $product->id) selected @endif
                                                value="{{$product->id}}">{{$product->product_name}}</option>
                                            @endforeach

                                        </select>
                                        <input type="hidden" name="details_id[]" value="{{$details->id}}">
                                    </td>
                                   
                                    <td>
                                        <input id="input" type="text" name="batch[]" placeholder="batch id"
                                            aria-label="default input example" autocomplete="off" value="{{ $details->batch_number ?? '' }}">
                                    </td>
                                    <td>
                                        <input id="input" type="text" name="qty_received[]" placeholder="0"
                                            aria-label="default input example" autocomplete="off" value="{{ $details->qty_received ?? '' }}">
                                    </td>
                                    <td>
                                        <input id="input" type="date" name="exp_date[]" placeholder="Default input"
                                            aria-label="default input example" autocomplete="off" value="{{ $details->expiry_date ?? '' }}">
                                    </td>
                                   
                                    
                                </tr>

                                @endforeach
                               
                                
                                
                                <tr>

                                   
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        
                                    </th>
                                    {{--- status input ---}}
                                    <input type="hidden" name="status" id="status">
                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" for="file">Attach Signed Delivery Note</label>
                                <input required type="file" class="form-control" name="file" id="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>

@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/form-validation.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/js/inputmask.js') }}"></script>



<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
<script defer>
    if ($(".js-example-basic-single").length) {
        $(".js-example-basic-single").select2();
    }

    $('#success').hide();

    $('#danger').hide();

  



    $('#add').on('click', function () {

        var tableData = `
        <tr>
                            
            <td style="width: 13vw; border: 1px solid rgb(148 163 184);">
                <select name="product[]" onChange="getData(this)" class="my-select-two" data-width="100%">
                    @foreach ($products as $product)
                        <option value="">Select Medicine</option>
                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                    @endforeach
                    
                    </select>
            </td>
            <td >
                <input id="input" name="price[]" class="price" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off">
            </td>
            <td >
                <input id="input" name="code[]" class="code" readonly type="text" placeholder="code" aria-label="default input example" autocomplete="off">
                
            </td>
            <td >
                <input  oninput="getQty(this)" name="qty_ordered[]" id="input"  type="text" placeholder="0" aria-label="default input example" autocomplete="off">
            </td>
            <td >
                <input id="input"  type="text" name="batch[]" placeholder="batch id" aria-label="default input example" autocomplete="off">
            </td>
            <td >
                <input id="input"  type="text" name="qty_recived[]" placeholder="0" aria-label="default input example" autocomplete="off">
            </td>
            <td >
                <input id="input"  type="date" name="exp_date[]" placeholder="Default input" aria-label="default input example" autocomplete="off">
            </td>
            <td >
                <input class="rowTotal"  id="input" name="rowtotal[]" readonly  type="text" placeholder="Default input" aria-label="default input example" autocomplete="off">
            </td>
            
        </tr>
        `;

        var tbodyLength = $('tbody').children().length - 4;

        $(tableData).insertAfter(`table > tbody > tr:nth-child(${tbodyLength })`);

        changeSele();

    });



    function changeSele() {
        $(".my-select-two").each(function (i) {
            $(this).select2();
        })
    }


    /**
     * on click delete button remove row
     */
    function del(th) {

        $(th).parent().parent().remove()

    }
    /**
     * get product data from supplier product table
     */
    function getData(th) {
        console.log($(th).val());

        var data = new FormData;
        data.append('_token', '{{csrf_token()}}');
        data.append('supplier', 1);
        data.append('product', $(th).val());

        $.ajax({
            type: "POST",
            url: "{{route('suppler_products_details')}}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
                console.log(response);

                var thisParent = $(th).parent().parent();

                var priceInput = $(".price", thisParent);

                var codeInput = $(".code", thisParent);

                priceInput.val(response.product_price);

                codeInput.val(response.suplier_product_code);

                console.log(priceInput);

            }
        });
    }

    /**
     * change in qty adjust total
     */
    function getQty(th) {
        var qty = $(th).val();
        if (!qty) {
            return
        }


        var parent = $(th).parent().parent();

        var price = $(".price", parent).val();

        var total = qty * price;

        $(".rowTotal", parent).val(total);

        calTotal();
    }
    /**
     * calulate total for all rows
     */

    function calTotal() {
        var total = 0;

        var totalInput = document.querySelectorAll('.rowTotal');

        for (let i = 0; i < totalInput.length; i++) {
            total += totalInput[i].value - 0;

        }

        $('.subTotal').val(total);
        $('#grand_total').val(total);

    }
    /**
     * 
     * change status before submitting when save is clicked
    */
    $('#save-order').on('click', function(e) {
        e.preventDefault();
       
        $('#status').val('delivered');

        $('#purchase_form').trigger('submit');
    });

    /**
     * 
     * change status before submitting when reject is clicked
    */
    $('#reject').on('click', function(e) {
        e.preventDefault();
       
        $('#status').val('rejected');

        $('#purchase_form').trigger('submit');
    });

    /**
     * 
     * change status before submitting when change is clicked
    */
    $('#change').on('click', function(e) {
        e.preventDefault();
       
        $('#status').val('change');

        $('#purchase_form').trigger('submit');
    });

</script>


@endpush
