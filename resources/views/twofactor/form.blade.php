@extends('layouts.master2')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
  <style>
    .center1{
    margin: auto;
}

.center3{
    display: flex;
    align-items: center;
    resize: both;
}

.two-step-div .two-title{
    font-size: 22px;
    font-weight: bold;
    color: #3c3c3c;
    margin-top: 15px;
}

.two-step-div .my-img{
    width: 140px;
    height: auto;
}

.two-step-div .two-p{
    font-size: 13px;
    margin-top: 15px;
    margin-bottom: 30px;
    color: #666666;
}

.two-step-div #form{
    direction: ltr;
}

.two-step-div #form input{
    border-color: transparent;
    background: transparent;
    border-bottom: 1.5px solid #cccccc;
    text-align: center;
    font-size: 20px;
    margin-right: 10px;
    margin-left: 10px;
}

.two-step-div #form input:focus{
    outline: 0px transparent !important;
    box-shadow: transparent !important;
    border-right: transparent !important;
    border-left: transparent !important;
    border-top: transparent !important;
    border-color: #00AEEF;
    animation: border-pulsate 1.5s infinite;
    -webkit-tap-highlight-color: transparent;
}

.two-step-div .not-first:disabled{
    background-color: transparent;
    border-bottom: 1px solid #cccccc !important;
}

@-moz-keyframes border-pulsate {
    0% {
        border-color: #00AEEF;
    }
    50% {
        border-color: rgba(0,0,0,0.3);
    }
    100% {
        border-color: #00AEEF;
    }
}
@-webkit-keyframes border-pulsate {
    0% {
        border-color: #00AEEF;
    }
    50% {
        border-color: rgba(0,0,0,0.3);
    }
    100% {
        border-color: #00AEEF;
    }
}
@-o-keyframes border-pulsate {
    0% {
        border-color: #00AEEF;
    }
    50% {
        border-color: rgba(0,0,0,0.3);
    }
    100% {
        border-color: #00AEEF;
    }
}
@keyframes border-pulsate {
    0% {
        border-color: #00AEEF;
    }
    50% {
        border-color: rgba(0,0,0,0.3);
    }
    100% {
        border-color: #00AEEF;
    }
}

.btn-verify{
    background: #00AEEF;
    color: #ffffff;
    border-color: transparent;
    border-radius: 7px;
    padding: 10px 25px;
    font-size: 14px;
    cursor: pointer;
    /*transition: all 0.5s;*/
    width: auto;
    position: relative;
    transition: 0.5s ease;

}

.btn-verify:hover {
    transform: translateY(-8px);

}

.btn-verify:disabled{
    background: rgba(103, 187, 209, 0.93);
    cursor: auto;
}

.btn-verify:disabled:hover{
    transform: none;

}

#here:hover {
    text-decoration: underline;
}
.my-alerts {
    width: 90vw;
    margin: 0 auto;
  }

  </style>
@endpush

@section('content')


@if (Session::has('success'))
<div class="my-alerts mt-2">
  <div class="alert alert-success" role="alert" id="success">
    {{Session::get('success')}}
  </div>
</div>  
@endif
@if (Session::has('unsuccess'))
<div class="my-alerts mt-2">
  <div class="alert alert-danger" role="alert" id="danger">
    {{Session::get('unsuccess')}}
  </div>
</div>  
@endif




<div class="container">
    <div class="row" >
    
    <div class="col-lg-12 grid-margin stretch-card two-step-div mt-5">
        <div class="card" >
        <div class="card-body text-center">
            <img class="my-img" src="https://icons-for-free.com/iconfiles/png/512/locked+login+password+privacy+private+protect+protection+safe-1320196167397530530.png">
            <p class="two-title">two step verification</p>
            <p class="two-p">You have received an email which contains two factor code.
            <br>If you haven't received it, press <a id="here" href="{{route('two_factor_resend')}}">here</a></p>
            <form id="form" action="{{route('two_factor_verify')}}" method="POST">
                @csrf
                <div>
                    <input id="1" type="password" maxLength="1"  name="first" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input id="2" class="not-first" type="password" name="second" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input id="3" class="not-first" type="password" name="third" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input id="4" class="not-first" type="password" name="fourth" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input id="5" class="not-first" type="password" name="fifth" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    <input id="6" class="not-first" type="password" name="sixth" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    
                </div>

                <input type="hidden" name="two_factor_code" id="two_factor_code">

                
                
                <button type="button" style="margin-top: 35px" class="btn btn-primary btn-embossed btn-verify">Verify</button>

            </form>
            
        </div>
        </div>
    </div>


    </div>
</div>

@endsection

@push('custom-scripts')

<script>
   


    $(document).ready(function () {

        $('.not-first').prop("disabled", true);

        $('.btn-verify').prop("disabled", true);

    });   

    $(function() {

        'use strict';

        var body = $('body');

        function goToNextInput(e) {
            var key = e.which,
                t = $(e.target),
                sib = t.next('input');

            if (key === 9) {
                return true;
            }

            if (!sib || !sib.length) {
                sib = body.find('input').eq(0);
                $('.btn-verify').prop("disabled", false);
            }

            sib.select().removeAttr('disabled');
            sib.select().focus();

        }

        function onFocus(e) {
            $(e.target).select();
        }

        body.on('keyup', 'input', goToNextInput);
        body.on('click', 'input', onFocus);

        $('.btn-verify').on('click', function(e) {

            e.preventDefault();


            var one = $('#1').val();
            var two = $('#2').val();
            var three = $('#3').val();
            var four = $('#4').val();
            var five = $('#5').val();
            var six = $('#6').val();

            var code = `${one}${two}${three}${four}${five}${six}`;

           $('#two_factor_code').val(code);

           $('#form').submit();
            
        });

    });
</script>
@endpush

