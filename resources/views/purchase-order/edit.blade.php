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

    .table-div-wrapper {
           
        }

        #input  {
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
            border-top: 1px solid rgb(148 163 184) !important;
            border-bottom: 1px solid rgb(148 163 184);
            border-right: 1px solid rgb(148 163 184);
            border-left: 1px solid rgb(148 163 184);
            table-layout: auto;
            width: 100% !important;
        }

        table tbody {
           
            display: block !important;
            height: 60vh;
            overflow-y: scroll;
            overflow-x: auto;
        }

        table td {
            margin: 0 !important;
            padding: 1px !important;
            border: none !important;
        }

        thead {
            border-top: 4px solid #5c6afe !important;
            background-color:#6571ff !important;
            color: black !important;
            display: block;
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


        table tr {
            width: 100%;
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

<div class="alert alert-danger" role="alert" id="exauted">
    Exausted available balance
  </div>
<form method="POST" action="{{route('purchase-order.update', $purchaseOrder->id)}}" id="purchase_form">
    @csrf
    @method('PUT')
    {{--- input for supplier id ---}}
    <input type="hidden" name="supplier_id" value="{{$purchaseOrder->supplier_id}}">
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card mb-3">
        <div class="card-header">
            <h5 style="width: 20vw">Generate Purchase Order</h5>
        </div>
        <div class="card-header my-flex">
            <div>
                <p style="width:300px" class="mb-1"><span class="text-muted">Supplier: </span><span style="font-weight: bold">{{App\Models\Supplier::where('id','=', $purchaseOrder->supplier_id)->first()->name}}</span></p>
                <p style="position: absolute;" class=""><span class="text-muted">Balance :</span> <span style="font-weight: bold">ksh <span id="balan">{{number_format($rightsAmt, 2)}}</span></span></p>
               
            </div>
           

            <div class="my-flex" style="width: 100%; flex-direction: row-reverse; gap: 10px">
                <button type="button" class="btn btn-danger">cancel</p>
                <button type="button" id="send_order" class="btn btn-success">Send Order</p>
                <button type="button" id="save_draft" class="btn btn-warning">Save to Draft</p>
            </div>
        </div>
        <div class="card-body">
            
                

              <div class="table-div-wrapper" >
                <table class="table scroll table-hover" >
                    <thead>
                    <tr>
                        
                        <th scope="col" style="color:#fff;">Medicine</th>
                        <th scope="col" style="color:#fff">Price</th>

                        <th scope="col" style="color:#fff">Code</th>
                        <th scope="col" style="color:#fff">Qty Ordered</th>
                       
                        <th scope="col" style="color:#fff">Total </th>

                        <th scope="col" style="color:#fff">#</th>
                    </tr>
                    </thead>
                    <tbody  id="table-body">
                        @foreach ($purchaseOrder->purchaseorderdetails as $order)
                       
                        <tr>
                            
                            <td style="width: 13vw; border: 1px solid rgb(148 163 184);">
                                <input readonly class="form-control" type="text"  id="" value="{{App\Models\Product::where('id','=', $order->product_id)->first()->product_name}}">
                                <input type="hidden" name="product[]" value="{{$order->product_id}}">
                                <input type="hidden" name="order_details_id[]" value="{{$order->id}}">
                                
                            </td>
                            <td >
                                <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" value="{{$order->price}}">
                            </td>
                            <td >
                                <input class="code" name="code[]" id="input" readonly type="text" placeholder="code" aria-label="default input example" autocomplete="off" value="{{$order->code}}">
                                
                            </td>
                            <td >
                                <input onkeyup="getQty(this)"  name="qty_ordered[]" id="input" class="qty" type="text" placeholder="0" aria-label="default input example" autocomplete="off">
                            </td>
                            
                            <td >
                                <input id="input" readonly class="rowTotal" name="rowtotal[]" type="text" placeholder="Default input" aria-label="default input example" autocomplete="off">
                            </td>
                            <td>
                                
                                
                            </td>
                            
                        </tr>

                        @endforeach
                        
                            
                        <tr>
                        
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                           
                           
                            
                            <th scope="col" >Sub Total</th>
                            <th scope="col" colspan="2">
                                <input id="subtotal" readonly class="subTotal" type="text" placeholder="Default input" aria-label="default input example">
                            </th>
                            
                            <th style="padding: 0; margin: 0;">
                                
                                <div id="add" style="background: #bbf7d0; border-radius:0.15rem; border: 0.7px solid #4ade80; margin-top: 15px" class="text-center pt-1"><i class="fa-solid fa-plus" style="color: #4ade80; font-size: 18px; "></i></div>
                            </th>

                        </tr>
                       
                       
                        <tr>
                        
                            <th scope="col" ></th>
                            
                            <th scope="col" ></th>
                            
                            
                            <th scope="col" >Grand Total</th>
                            <th scope="col" colspan="2">
                                <input id="grand"   class="grand_total" name="grand_total" readonly type="text" placeholder="Default input" aria-label="default input example" required>
                            </th>
                            <th scope="col"></th>
                           
                            {{--- status input ---}}
                            <input type="hidden" name="status" id="status">
                        </tr>
                        
                    </tbody>
                    
                </table>
            
            </div>
        </div>
    </div>
  </div>
  
</div>
</form>


<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Kemsa look up</h5>
        </div>
        <div class="modal-body">
            <div id="check">
                <div  class="spinner-border text-warning mr-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div><span class="text-dark" style="font-size:20px; padding-left: 10px;position: relative;top:-7px">Please wait as we check product availability</span>
            </div>
            
            <p style="font-size:20px;" id="success-check"><ion-icon class="text-success" name="logo-tableau"></ion-icon><span style="padding-left: 10px;">Product is available</span></p>
            <p id="error-check">Product is not available</p>

            <button  type="button" id="close-modal" class="btn btn-primary mt-3" data-bs-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
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
    $('#exauted').hide();
    $('#success-check').hide();
    $('#error-check').hide();

    let requestResponse;
  
    var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

    // Adjust the width of thead cells when window resizes
    $(window).resize(function() {
        // Get the tbody columns width array
        colWidth = $bodyCells.map(function() {
            return $(this).width();
        }).get();

        console.log(colWidth);
        
        // Set the width of thead columns
        $table.find('thead tr').children().each(function(i, v) {
            console.log(i)
            $(v).css('width',colWidth[i]);
        });    
    }).resize(); // Trigger resize handler

  

    
    function changeSele() {
        $(".my-select-two").each(function(i) {
            $(this).select2();
        })
    }


    /**
     * on click delete button remove row
    */
    function del(th) {
        $(th).parent().parent().remove();

        calTotal();
    }
    /**
     * get product data from supplier product table
    
    function getData(th) {
        var data = new FormData;
        data.append('_token','{{csrf_token()}}');
        data.append('supplier',1);
        data.append('product',$(th).val());

        //impliment request to kemsa to check for availability
        //if product is not found add to Unvavaliable Products
        //this is a mock
        //we show modal
        $('#myModal').modal('show');

        //alter the status depending on response
        function changeStatus() {        
            $('#check').hide('slow');
            $('#success-check').show('slow');

            requestResponse = 'success';
        }

        setTimeout(changeStatus, 1000);

        $('#close-modal').on('click', function(){

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
                    var thisParent = $(th).parent().parent();

                    var priceInput = $(".price", thisParent);

                    var codeInput = $(".code", thisParent);

                    priceInput.val(response.product_price);

                    codeInput.val(response.suplier_product_code);         
                    
                    $('#check').show('slow');
                    $('#success-check').hide();
                    $('#error-check').hide();
                }
            })
        });
    }
    */
    /**
     * change in qty adjust total
    */ 
    function getQty(th) {
        var qty = $(th).val();

        if (!qty) {
           return 
        }
        
        var parent =  $(th).parent().parent();

        var price = $(".price", parent).val();

        var total = qty * price;
        
        $(".rowTotal", parent).val(total);

        var available = removeCommas($('#balan').text());

        var totalInput = document.querySelectorAll('.rowTotal');

        var totals = 0;

        for (let i = 0; i < totalInput.length; i++) {
            totals += totalInput[i].value - 0;    
        }

        if (totals > available) {
            $('#exauted').show('slow');

            $('#send_order').hide('slow');
            $('#save_draft').hide('slow');

            $('#add').hide('slow');           

            $("html, body").animate({ scrollTop: 0 }, "slow");
           
            $('.subTotal').val(totals);

            $('.grand_total').val(totals);

            return;
        } else {
            $('#add').show('slow');

            $('#exauted').hide('slow');

            $('#send_order').show('slow');
            $('#save_draft').show('slow');
        }

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

        $('.grand_total').val(total);  


        var available = removeCommas($('#balan').text());
        if (total > available) {
            $('#exauted').show('slow');

            $('#send_order').hide('slow');
            $('#save_draft').hide('slow');

            $('#add').hide('slow');           

            $("html, body").animate({ scrollTop: 0 }, "slow");
           
            $('.subTotal').val(totals);

            $('.grand_total').val(totals);

            return;
        } else {
            $('#add').show('slow');

            $('#exauted').hide('slow');

            $('#send_order').show('slow');
            $('#save_draft').show('slow');
        }

    }
   
    function removeCommas(str) {
        while (str.search(",") >= 0) {
            str = (str + "").replace(',', '');
        }
        return str;
    };
    /**
     * 
     * change status before submitting when draft is clicked
    */
    $('#save_draft').on('click', function(e) {
        e.preventDefault();
       
        $('#status').val('draft');

        $('#purchase_form').trigger('submit');
    });

    /**
     * 
     * change status before submitting when send is clicked
    */
    $('#send_order').on('click', function(e) {
        e.preventDefault();
       
        $('#status').val('pending approval');

        $('#purchase_form').trigger('submit');
    });

    
  </script>
@endpush