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
            border-top: 4px solid rgb(107 33 168) !important;
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
            background-color: rgb(147 51 234) !important;
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

       
  </style>
@endpush

@section('content')


<div class="alert alert-success" role="alert" id="success">
  Record was added successfully
</div>

<div class="alert alert-danger" role="alert" id="danger">
  Sytem error: Ensure all values are filled correctly
</div>
<form method="POST" action="{{route('purchase-order.store')}}">
    @csrf
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card mb-3">
        <div class="card-header">
            <h5>Peter</h5>

            <div style="text-align:end">
                <button type="submit" class="btn btn-success">Save Purchase Order</p>
            </div>
        </div>
        <div class="card-body">
            
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="form-label">Order Number</label>
                        <input id="designation" class="form-control" name="order_number" type="text" autocomplete="off" required placeholder="Order Number" required>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Facility</label>
                        <select onChange="getData(this)" name="facility" class="form-select" data-width="100%">
                            @foreach ($facilities as $facility)
                               
                                <option  value="{{$facility->id}}">{{$facility->name}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Finacial Year</label>
                        <select onChange="getData(this)" name="finacial_year" class="form-select" data-width="100%">
                            @foreach ($finacialyears as $finacialyear)
                               
                                <option  value="{{$finacialyear->id}}">{{$finacialyear->name}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label">Delivery Note</label>
                        <textarea name="delivery_note" id="maxlength-textarea" class="form-control" id="defaultconfig-4" maxlength="100" rows="4" placeholder="This textarea has a limit of 100 chars."></textarea>
                    </div>
                </div>
                
              
              
              <hr>


              <div class="table-div-wrapper" >
                <table class="table scroll table-hover" >
                    <thead>
                    <tr>
                        
                        <th scope="col" style="color:#fff;">Medicine</th>
                        <th scope="col" style="color:#fff">Price</th>

                        <th scope="col" style="color:#fff">Code</th>
                        <th scope="col" style="color:#fff">Qty Ordered</th>
                        <th scope="col" style="color:#fff">Butch Id</th>
                        <th scope="col" style="color:#fff">Qty Received</th>
                       
                        <th scope="col" style="color:#fff">Expiry Date</th>
                        <th scope="col" style="color:#fff">Total</th>

                        <th scope="col" style="color:#fff">#</th>
                    </tr>
                    </thead>
                    <tbody  id="table-body">
                        <tr>
                            
                            <td style="width: 13vw; border: 1px solid rgb(148 163 184);">
                                <select onChange="getData(this)" name="product[]" class="js-example-basic-single" data-width="100%">
                                    @foreach ($products as $product)
                                        <option value="">Select Medicine</option>
                                        <option  value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                    
                                </select>
                            </td>
                            <td >
                                <input id="input" class="price" name="price[]" readonly type="text" placeholder="0.00" aria-label="default input example" autocomplete="off">
                            </td>
                            <td >
                                <input class="code" name="code[]" id="input" readonly type="text" placeholder="code" aria-label="default input example" autocomplete="off">
                                
                            </td>
                            <td >
                                <input oninput="getQty(this)" name="qty_ordered[]" id="input" class="qty" type="text" placeholder="0" aria-label="default input example" autocomplete="off">
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
                                <input id="input" readonly class="rowTotal" name="rowtotal[]" type="text" placeholder="Default input" aria-label="default input example" autocomplete="off">
                            </td>
                            <td style="padding: 0; margin: 0;" >
                                
                                
                            </td>
                            
                        </tr>

                        
                            
                        <tr>
                        
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" >Sub Total</th>
                            <th scope="col" >
                                <input id="input" readonly class="subTotal" type="text" placeholder="Default input" aria-label="default input example">
                            </th>
                            <th style="padding: 0; margin: 0;">
                                
                                <div id="add" style="background: #bbf7d0; border-radius:0.15rem; border: 0.7px solid #4ade80; margin-top: 15px" class="text-center pt-1"><i class="fa-solid fa-plus" style="color: #4ade80; font-size: 18px; "></i></div>
                            </th>
                        </tr>
                       
                       
                        <tr>
                        
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" ></th>
                            <th scope="col" >Grand Total</th>
                            <th scope="col" >
                                <input id="grand_total" name="grand_total" readonly type="text" placeholder="Default input" aria-label="default input example">
                            </th>
                            <th scope="col"></th>
                        </tr>
                        
                    </tbody>
                    
                </table>
            
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

  

    $('#add').on('click', function() {
       
    
        
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
                            <td style="padding: 0; margin: 0;" >
                                <div onClick="del(this)" style="background: #fca5a5; border-radius:0.15rem; border: 0.7px solid #ef4444; " class="text-center pt-1"><i class="fa-solid fa-trash-can" style="color: #ef4444; font-size: 18px; "></i></div>
                                
                            </td>
                            
                        </tr>
        `;
        
        var tbodyLength = $('tbody').children().length - 2;

       
        $(tableData).insertAfter(`table > tbody > tr:nth-child(${tbodyLength })`);

        changeSele();
        
    });
   
    

    function changeSele() {
        $(".my-select-two").each(function(i) {
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
    
        var data = new FormData;
        data.append('_token','{{csrf_token()}}');
        data.append('supplier',1);
        data.append('product',$(th).val());

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
        

        var parent =  $(th).parent().parent();

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
   
   
  </script>
@endpush