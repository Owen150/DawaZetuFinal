@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('facilityProducts.index') }}">Facility Products</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Facility Products</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">ADD PRODUCTS TO FACILITY</h3>
                            <p class="text-muted">Fill out details to create new Facility Products</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('facilityProducts.index') }}" class="btn btn-md btn-danger">Cancel <span><i
                                        class="fa-solid fa-ban"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ url('/facilityProducts') }}">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="product_id">Product ID</label>
                                <select class="form-select" name="product_id" id="product" required>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="quantity">Quantity</label>
                                <input required type="text" class="form-control" name="quantity" placeholder="Enter Quantity">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class=",b-3">
                                <label class="form-label" for="reorder_level">Reorder Level</label>
                                <input required type="text" class="form-control" name="reorder_level" placeholder="Enter Reorder Level">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary submit">Submit form</button>
                </div>
            </form>
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
     $('#product').select2();
  </script>
@endpush