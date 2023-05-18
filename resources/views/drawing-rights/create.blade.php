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

    .budget-area {
      padding: 10px;
      background: #a5b4fc;
      border-radius: 0.25rem;
    }

    thead {
            border-top: 4px solid #5c6afe !important;
            background-color:#6571ff !important;
            color: black !important;
          
      }
   
  </style>
@endpush

@section('content')
<form  method="POST" action="{{route('drawing-rights.store')}}">

  @csrf
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('drawing-rights.create')}}">Add New Drawing rights</a></li>
  </ol>
  <div class="cancel">
    <div></div>
    <a href="{{ route('drawing-rights.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
        class="fa-solid fa-ban"></i></span></a>
  </div>
</nav>

<div id="alert-div">
  <div id="my-alersst" class="alert alert-danger" role="alert" >
    Your balance has depleted. Please top up to continue!
</div> 
</div>

@if (Session::has('errors'))
<div class="alert alert-danger" role="alert" id="danger">
  {{Session::get('errors')}}
</div>
@endif

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div style="display: flex; gap: 20px">
          <div>
            <h4 id="facility-name"></h4>
            <p class="mb-2"><span class="text-dark bold mb-2">END DATE:</span > <span id="facility-type">
              <input type="date" class="form-control" required name="end_date">
              {{-- hidden input for allocated budget ---}}
              <input type="hidden" name="allocated_budget" id="allocated_budget" value="{{$allocatedBudget->id}}">
              <input type="hidden" name="original_amount" id="original_amount" value="{{$budget_left}}">
            </span>
            </p>              
        </div>
        <div style="width: 35vw"></div>
        <div style="flex: 1 1 0%; text-align:end">
          <h4 class="card-title">Remaining Budget</h4>
            <div style="text-align: center; background: #f9fafb; border-radius:0.375rem;">
                <h5 class="p-2" ><span class="text-success">KSH</span> <span class="text-success" id="availableAmt">{{number_format($budget_left, 2)}}</span></h5>
            </div>              
        </div>
      </div>
      
      <div style="display: flex; gap: 20px">
          
      </div>

      <hr>       
          <div class="table-div-wrapper" >
            <table class="table scroll table-hover">
                <thead>
                <tr>
                    <th scope="col" style="color:#fff;">Facility</th>
                    <th scope="col" style="color:#fff;">Workload</th>
                    <th scope="col" style="color:#fff">Amount</th>
                    
                </tr>
                </thead>
                <tbody  id="table-body">
                  @foreach ($facilities as $facility)
                    <tr>                       
                        <td >
                         
                          <select class="form-select" name="facility[]" id="facility" required>
                            @foreach ($facilities as $facility)
                              <option value="{{$facility->id}}">{{$facility->name}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input id="worklaod" class="form-control " name="workload[]" type="text" aria-label="default input example" autocomplete="off" required>
                      </td>
                        <td>
                            <input id="amount" oninput="calcTotal()" class="form-control amt" name="amount[]" type="text" placeholder="0.00" aria-label="default input example" autocomplete="off" required>
                        </td>
                        
                    </tr>
                    @endforeach                    
                </tbody>               
            </table>
        
            <button type="submit" id="submit-btn" class="btn btn-success mt-3">Submit <span style="position: relative; top:2px; left: 2px" ><ion-icon name="checkbox-outline"></ion-icon></span></button>
        </div>
          {{---
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Financial Year</label>
                    <select class="form-select" name="age_select" id="finacial" required>
                     
                        <option value="{{$financialYear->id}}">{{$financialYear->name}}</option>
                      
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Facility</label>
                    <select class="form-select" name="age_select" id="facility" required>
                      @foreach ($facilities as $facility)
                        <option value="{{$facility->id}}">{{$facility->name}}</option>
                      @endforeach
                    </select>
                </div>
                
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Workload</label>
                    <input id="worload" class="form-control" name="worload" type="text" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Period</label>
                    <input id="period" class="form-control" name="period" type="text" autocomplete="off" required placeholder="period" value="{{getFinacialPeriod()}}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Amount</label>
                    <input id="amount" class="form-control" name="amount" type="text" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">End Date</label>
                    <div class="input-group flatpickr" id="flatpickr-date">
                        <input type="text" class="form-control" id="end_date" placeholder="Select date" data-input required>
                        <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                      </div>
                </div>
            </div>

            <input type="hidden" name="allocated_budget" id="allocated_budget" value="{{$allocatedBudget->id}}">
          
            <input class="btn  btn-primary" type="submit" value="Submit" id="submit">
            --}}
        
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
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>

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

  <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
  <script defer>
    
    /**
     * 
     * amount input on change decrease available balance amount
     * 
    */
    $('#my-alersst').hide();

    function removeCommas(str) {
        while (str.search(",") >= 0) {
            str = (str + "").replace(',', '');
        }
        return str;
    };

    

    

    // format number eg 0.00
    function format(num, fix) {
      var p = num.toFixed(fix).split(".");
      return p[0].split("").reduceRight(function(acc, num, i, orig) {
          if ("-" === num && 0 === i) {
              return num + acc;
          }
          var pos = orig.length - i - 1
          return  num + (pos && !(pos % 3) ? "," : "") + acc;
      }, "") + (p[1] ? "." + p[1] : "");
    }



    var alertTemplate = `
    <div id="my-alert" class="alert alert-danger" role="alert" >
        Your balance has depleted. Please top up to continue!
    </div> 
    `;
   
    var availableAmt = $('#availableAmt').text();

    var rmCommas = removeCommas(availableAmt) - 0;

    console.log(rmCommas);

    if (-1 < 0) {
      console.log('pere');
    }

    //check if available amount is zero
    function checkAvailableAmount(amt) {
     
      if (amt < 0) {
       
        $('#my-alersst').show();

        $('#submit-btn').hide('slow');
        
      } else {
        $('#my-alersst').hide();

        $('#submit-btn').show('slow');

      }

      
      
    }
    
    // Run it when page loads to ensure available is not zero
    //checkAvailableAmount(rmCommas);

    // Change available amount on input
    

   
    /**
     * 
     * add form inputs
     * 
    */
    

    // delete row
    function del(th) {
        $(th).parent().parent().remove();

    }

    //calculate total
    function calcTotal() {
      var total = 0;
      var amounts = document.querySelectorAll('.amt');

      for (let i = 0; i < amounts.length; i++) {
        total += amounts[i].value - 0;
      }

      var amt = rmCommas - total;
      $('#availableAmt').text(format(amt, 2));    
      

      var availableAmt = $('#availableAmt').text();

      var ava = removeCommas(availableAmt) - 0;

      checkAvailableAmount(ava);
      
    }
    

  </script>
@endpush