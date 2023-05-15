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
    <li class="breadcrumb-item"><a href="{{route('facility.index')}}">Drawing rights</a></li>
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
        <h4 class="card-title">Facility</h4>
        <p class="text-muted mb-4">Update facility details</p>
        <form id="signupForm">
          

          <div class="row mb-3">
              <div class="col-md-6">
                  <label for="name" class="form-label">Name</label>
                  <input id="name" class="form-control" name="name" type="text" autocomplete="off" required placeholder="Facility Name" value="{{$facility->name}}">
              </div>

              <div class="col-md-6">
                <label for="" class="form-label">Type</label>
              
                <select class="form-select" name="type" id="type" required>
                  <option @if($facility->type == 'Level 1') selected @endif>Level 1</option>
                  <option @if($facility->type == 'Level 2') selected @endif>Level 2</option>
                  <option @if($facility->type == 'Level 3') selected @endif>Level 3</option>
                  <option @if($facility->type == 'Level 4') selected @endif>Level 4</option>
                  <option @if($facility->type == 'Level 5') selected @endif>Level 5</option>
                  
              </select>
            </div>
             
          </div>

          <div class="row mb-3">
              <div class="col-md-6">
                  <label for="" class="form-label">Address</label>
                  <input id="address" class="form-control" name="address" type="text" autocomplete="off" required placeholder="Facility Address" value="{{$facility->address}}">
              </div>
              <div class="col-md-6">
                  <label for="" class="form-label">Email</label>
                  <input id="email" class="form-control" name="email" type="email" autocomplete="off" required placeholder="facility@mail.com" value="{{$facility->email}}">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
                <label for="contact_num" class="form-label">Contact Number</label>
                <input id="contact_num" class="form-control" name="contact_num" type="text" autocomplete="off" required placeholder="Facility Contact Number" value="{{$facility->contact_num}}">
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
        data.append('type',$('#type').find(":selected").val());
        data.append('name',$('#name').val());
        data.append('address',$('#address').val());
        data.append('email',$('#email').val());
        data.append('contact_num',$('#contact_num').val());

        $.ajax({
            type: "POST",
            url: "/facility/{{$facility->id}}",
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
      location.href = '/facility';   
    }

    $('#submits').on('click', postData);
  </script>
@endpush