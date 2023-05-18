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
    <li class="breadcrumb-item active"><a href="{{route('drawing-rights.index')}}">Update Drawing Rights</a></li>
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
        <form id="signupForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Financial Year</label>
                    <input id="worload" class="form-control" name="worload" type="text" autocomplete="off" value="{{ App\Models\FinancialYear::where('id','=', $right->finacial_year_id)->first()->name }}">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Facility</label>
                    <input id="worload" class="form-control" name="worload" type="text" autocomplete="off" value="{{ App\Models\Facility::where('id','=', $right->facility_id)->first()->name }}">
                </div>                
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Workload</label>
                    <input id="worload" class="form-control" name="worload" type="text" autocomplete="off" value="{{$right->workload}}">
                </div>
                <div class="col-md-6">
  
                    <label for="" class="form-label">Period</label>
                    <select class="js-example-basic-single form-select" name="age_select" id="period">
                        <option @if($right->facility_id == 'Quanter 1') selected @endif >Quanter 1</option>
                        <option @if($right->facility_id == 'Quanter 2') selected @endif>Quanter 2</option>
                        <option @if($right->facility_id == 'Quanter 3') selected @endif>Quanter 3</option>
                        <option @if($right->facility_id == 'Quanter 4') selected @endif>Quanter 4</option>
                        <option @if($right->facility_id == 'Quanter 5') selected @endif>Quanter 5</option>
                        <option @if($right->facility_id == 'Quanter 6') selected @endif>Quanter 6</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Amount</label>
                    <input id="amount" class="form-control" name="amount" type="text" autocomplete="off" value="{{$right->amount}}">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">End Date</label>
                    <div class="input-group flatpickr" id="flatpickr-date">
                        <input type="text" class="form-control" id="end_date" placeholder="Select date" data-input value="{{$right->end_date}}">
                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                      </div>
                </div>
            </div>
          
          <input class="btn  btn-success" type="submit" value="Submit" id="submit">

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
        data.append('finacial_year',$('#finacial').find(":selected").val());
        data.append('facility',$('#facility').find(":selected").val());
        data.append('worload',$('#worload').val());
        data.append('period',$('#period').find(":selected").val());
        data.append('amount',$('#amount').val());
        data.append('end_date',$('#end_date').val());

        $.ajax({
            type: "POST",
            url: "/drawing-rights/{{$right->id}}",
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
      location.href = '/drawing-rights';   
    }

    $('#submit').on('click', postData);
  </script>
@endpush