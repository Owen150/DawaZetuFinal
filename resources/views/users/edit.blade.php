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
        <h4 class="card-title">User</h4>
        <p class="text-muted mb-4">Update user details</p>
        <form id="signupForm">
          

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" class="form-control" name="name" type="text" autocomplete="off" required placeholder="Full Name" value="{{$user->name}}">
                </div>

                
               
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="employee_number" class="form-label">Employee Number</label>
                <input id="employee_number" class="form-control" name="employee_number" type="text" autocomplete="off" required placeholder="Employee Number" value="{{$user->employee_number}}">
              </div>

              <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input id="phone_number" class="form-control" name="phone_number" type="text" autocomplete="off" required placeholder="+25471000000" value="{{$user->phone_number}}">
              </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Designation</label>
                    <input id="designation" class="form-control" name="designation" type="text" autocomplete="off" required placeholder="User Designation" value="{{$user->designation}}">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Email</label>
                    <input id="email" class="form-control" name="email" type="email" autocomplete="off" required placeholder="user@mail.com" value="{{$user->email}}">
              </div>
            </div>

            <div class="row mb-3">
              

              <div class="col-md-6">
                <label for="role" class="form-label">Sytem Role</label>
                <select class="form-select" name="role" id="role" required>
                    
                    <option @if($user->role == 'admin') selected @endif   value="admin">Admin</option>
                    
                    
                      
                      <option @if($user->role == 'cp') selected @endif  value="cp">{{strtolower('COUNTY PHARMACIST')}}</option>
                      <option @if($user->role == 'cd') selected @endif  value="cd">{{strtolower('MEDICAL DEPARTMENT DIRECTOR')}}</option>
                      <option @if($user->role == 'co') selected @endif  value="co">{{strtolower('MEDICAL DEPARTMENT CHIEF OFFICER')}}</option>
                      <option @if($user->role == 'ee') selected @endif  value="ee">{{strtolower('EXECUTIVE')}}</option>
                      <option @if($user->role == 'hfp') selected @endif  value="hfp">{{strtolower('HEALTH FACILITIES PHARMACIST')}}</option>
                      <option @if($user->role == 'scp') selected @endif  value="scp">{{strtolower('SUB-COUNTY PHARMACIST')}}</option>
                     
                  
                </select>
              </div>
             
              @if ($user->facility_id)
              <div class="col-md-6">
                <label for="facility" class="form-label">Select User Facility</label>
                <select class="form-select" name="facility" id="facility" required>
                    @foreach ($facilities as $facility)
                        <option @if($facility->id == $user->facility_id) selected @endif  value="{{$facility->id}}">{{$facility->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            @endif

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
        data.append('employee_number',$('#employee_number').val());
        data.append('designation',$('#designation').val());
        data.append('email',$('#email').val());
        data.append('role',$('#role').val());
        data.append('phone_number',$('#phone_number').val());
        data.append('facility',$('#facility').find(":selected").val());

        $.ajax({
            type: "POST",
            url: "/users/{{$user->id}}",
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
                $("html, body").animate({ scrollTop: 0 }, "slow");

                $('#success').show('slow');

                setTimeout(changeLoc, 1500);

              } else {
                  $('#danger').show();

              }    
                        
            }
        });
    }

    function changeLoc() {
      location.href = '/users';   
    }

    $('#submits').on('click', postData);
  </script>
@endpush