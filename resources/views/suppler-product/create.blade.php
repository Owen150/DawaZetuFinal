@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <style>
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
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('suppler-products.index')}}">Supplier Product</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{ route('suppler-products.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
        class="fa-solid fa-ban"></i></span></a>
  </div>
</nav>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Supplier Product</h4>
        <p class="text-muted mb-4">Add supplier product by filling the form below</p>
        <form id="signupForm">
          

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="supplier" class="form-label">Supplier</label>
                    <select class="form-select" name="supplier" id="supplier" required>
                      @foreach ($suppliers as $supplier)
                        <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="product" class="form-label">Product</label>
                  <select class="form-select" name="product" id="product" required>
                    @foreach ($products as $product)
                      <option value="{{$product->id}}">{{$product->product_name}}</option>    
                    @endforeach
                </select>
              </div>
               
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="code" class="form-label">Product Code</label>
                    <input id="code" class="form-control" name="code" type="text" autocomplete="off" required >
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Price</label>
                    <input id="price" class="form-control" name="price" type="text" autocomplete="off" required >
              </div>
            </div>

            


            <input class="btn  btn-success" type="submit" value="Submit" id="submits">

        </form>
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
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/pickr.js') }}"></script>
  <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
  <script >
    $('#success').hide();

    $('#danger').hide();
    
    function postData() {
        
        
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('supplier',$('#supplier').find(":selected").val());
        data.append('product',$('#product').find(":selected").val());
        data.append('code',$('#code').val());
        data.append('price',$('#price').val());
        

        $.ajax({
            type: "POST",
            url: "{{ route('suppler-products.store') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
                console.log(response);

                if(response == 1) {
                  $("html, body").animate({ scrollTop: 0 }, "slow");

                  setTimeout(changeLoc, 1500);
                } else {
                  $('#danger').show();

                }  
                        
            }
        });
        
    }

   $('#submits').on('click', postData);

    function changeLoc() {
      location.href = '/suppler-products';   
    }
   
  </script>
@endpush