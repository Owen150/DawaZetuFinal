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
    <li class="breadcrumb-item"><a href="{{route('facility.index')}}">Facilities</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{ route('facility.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
        class="fa-solid fa-ban"></i></span></a>
  </div>
</nav>

<div class="alert alert-success" role="alert" id="success">
  Record was added successfully
</div>

<div class="alert alert-danger" role="alert" id="danger">
  Sytem error: Ensure all values are filled correctly
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add details</h4>
        <form id="signupForm">
          

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" class="form-control" name="name" type="text" autocomplete="off" required placeholder="Facility Name">
                </div>

                <div class="col-md-6">
                  <label for="" class="form-label">Level</label>
                  <select class="js-example-basic-single form-select" name="type" id="type" required>
                    <option selected >Level 1</option>
                    <option>Level 2</option>
                    <option>Level 3</option>
                    <option>Level 4</option>
                    <option>Level 5</option>
                    <option>Level 6</option>
                </select>
              </div>
               
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Address</label>
                    <input id="address" class="form-control" name="address" type="text" autocomplete="off" required placeholder="Facility Address">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Email</label>
                    <input id="email" class="form-control" name="email" type="email" autocomplete="off" required placeholder="facility@mail.com">
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                  <label for="contact_num" class="form-label">Contact Number</label>
                  <input id="contact_num" class="form-control" name="contact_num" type="text" autocomplete="off" required placeholder="Facility Contact Number">
              </div>

              <div class="col-md-6">
                <label for="contact_num" class="form-label">Sub County</label>
                <input id="sub_county" class="form-control" name="sub_county" type="text" autocomplete="off" required placeholder="Sub county">
              </div>
             
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                  <label for="ward" class="form-label">Ward</label>
                  <input id="ward" class="form-control" name="ward" type="text" autocomplete="off" required placeholder="Ward">
              </div>

              <div class="col-md-6">
                <label for="location" class="form-label">Location</label>
                <input id="location" class="form-control" name="location" type="text" autocomplete="off" required placeholder="Location">
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
        console.log('peter');
        
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('type',$('#type').find(":selected").val());
        data.append('name',$('#name').val());
        data.append('address',$('#address').val());
        data.append('email',$('#email').val());
        data.append('contact_num',$('#contact_num').val());
        data.append('sub_county',$('#sub_county').val());
        data.append('ward',$('#ward').val());
        data.append('location',$('#location').val());
        


        $.ajax({
            type: "POST",
            url: "{{ route('facility.store') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
              $("html, body").animate({ scrollTop: 0 }, "slow");
                
              $('#success').show();

              setTimeout(changeLoc, 1500);
            
                        
            }
        });
        
    }

   $('#submits').on('click', postData);

   function changeLoc() {
      location.href = '/facility';   
    }
   
  </script>
@endpush