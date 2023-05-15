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
    <li class="breadcrumb-item"><a href="{{route('category-type.index')}}">Category Type</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>

<div class="alert alert-success" role="alert" id="success">
  Record was updated
</div>

<div class="alert alert-danger" role="alert" id="danger">
  Sytem error: Ensure all values are filled correctly
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Category Type</h4>
        <p class="text-muted mb-4">Update category type details</p>
        <form id="signupForm">
          

          <div class="row mb-3">
              <div class="col-md-12">
                  <label for="name" class="form-label">Name</label>
                  <input id="name" class="form-control" name="name" type="text" autocomplete="off" required placeholder="Type Name" value="{{$type->name}}">
              </div>

              
            </div>
             
         



          <input class="btn  btn-primary" type="submit" value="Submit" id="submits">

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
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
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
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  <script defer>
    $('#success').hide();
    $('#danger').hide();

    function postData() {
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('_method','PATCH');
        data.append('name',$('#name').val());
      
        
        $.ajax({
            type: "POST",
            url: "/category-type/{{$type->id}}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
              $('#danger').show();
                console.log(err)
            },
            success: function (response) {
              if(response == 1) {
                $('#success').show();

                setTimeout(changeLoc, 1500);

              } else {
                  $('#danger').show();

              }


              
                    
                        
            }
        });
    }

    function changeLoc() {
      location.href = '/category-type';   
    }

    $('#submits').on('click', postData);
  </script>
@endpush