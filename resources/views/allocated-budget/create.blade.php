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

<nav class="mynav page-breadcrumb" >
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('allocated-budget.index')}}">Allocated Budget</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{ route('allocated-budget.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
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
        <form id="signupForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Financial Year</label>
                    <select class="js-example-basic-single form-select" name="financial_year" id="financial_year" required>
                    
                        <option  value="{{$finacialYear->id}}">{{$finacialYear->name;}}</option>
                        
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="period" class="form-label">Period/Quarter</label>
                    <select class="js-example-basic-single form-select" id="period" name="period" required >
                      <option  value="{{$finacialYear->id}}">{{getFinacialPeriod()}}</option>
                    </select>
                  </div>
    
               
            </div>

            <div class="row mb-3">
             
              <div class="col-md-6">
                <label for="budget" class="form-label">Budget (KSH)</label>
                <input id="budget" class="form-control" name="budget" type="text" autocomplete="off" required placeholder="budget">
              </div>
            </div>
            <a class="btn btn-success" type="submit" value="Submit" id="submits">Submit <span style="position: relative; top:2px; left: 2px" ><ion-icon name="checkbox-outline"></ion-icon></span></a>

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
    
    $('#facility-div').hide();

    $('#success').hide();

    $('#danger').hide();

    $('#role').on('change', function() {

      var role = $('#role').find(":selected").val();
        
      if (role == 'cp' || role == 'cd' || role == 'co'|| role == 'admin') {
        $('#facility-div').hide('slow');
      } else {
        $('#facility-div').show('slow');
      }

    });
    
    function postData() {

        
        var data = new FormData;
        data.append('_token','{{ csrf_token() }}');
        data.append('financial_year',$('#financial_year').find(":selected").val());
        data.append('period',$('#period').val());
        data.append('budget',$('#budget').val());
        
        
        

        $.ajax({
            type: "POST",
            url: "{{ route('allocated-budget.store') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: data,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
              if(response == 1) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                
                $('#success').show('slow');

                

                setTimeout(changeLoc, 1500);

              } else {
                  $('#danger').show('slow');

              }  
                        
            }
        });
        
    }

   $('#submits').on('click', postData);

    function changeLoc() {
      location.href = '/allocated-budget';   
    }
   
  </script>
@endpush