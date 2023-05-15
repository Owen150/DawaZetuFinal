@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
    <div class="col-xl-12 main-content ps-xl-4 pe-xl-5">
        <h5 class="page-title">System Settings</h5>
        <p class="text-muted">Go through the tabs below to register/edit system settings</p>

        <br>

        <div class="">
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
@endsection