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
<div class="row">
    <div class="col-xl-12 main-content ps-xl-4 pe-xl-5">
        <h5>System Settings</h5>
        <p class="text-muted mt-2">Go through the tabs below to register/edit system settings</p>

        <div class="mt-2">
            <ul  class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">Add County</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="false">Add Subcounty</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab" aria-controls="contact" aria-selected="false">Add Ward</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" role="tab" aria-controls="email" aria-selected="false">Add Location</a>
              </li>
              
            </ul>
            <div class="tab-content mt-3" id="lineTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('settings.county')
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @include('settings.subcounty')
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                @include('settings.ward')
              </div>
              <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                @include('settings.location')
              </div>           
            </div>
          </div>

    </div>
</div>
<hr>

<div class="row mt-4">
  <div class="col-xl-12 main-content ps-xl-4 pe-xl-5">
    <h5>Financial Years</h5>

    <div class="mt-2">
        <ul  class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="center-tab" data-bs-toggle="tab" data-bs-target="#center" role="tab" aria-controls="center" aria-selected="false">Add Financial Year</a>
          </li>
        </ul>

        <div class="tab-content mt-3" id="lineTabContent">
          <div class="tab-pane fade show active" id="center" role="tabpanel" aria-labelledby="center-tab">
            @include('settings.financial-year')
          </div>
        </div>
    </div>

  </div>
</div>
<hr>

<div class="row mt-4">
  <div class="col-xl-12 main-content ps-xl-4 pe-xl-5">
    <h5>Roles</h5>

    <div class="mt-2">
        <ul  class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="role-tab" data-bs-toggle="tab" data-bs-target="#role" role="tab" aria-controls="role" aria-selected="false">Add New Role</a>
          </li>
        </ul>

        <div class="tab-content mt-3" id="lineTabContent">
          <div class="tab-pane fade show active" id="role" role="tabpanel" aria-labelledby="role-tab">
            @include('settings.role')
          </div>
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
@endpush