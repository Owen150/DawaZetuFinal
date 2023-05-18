@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;

    }
    .mynav{
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  </style>
@endpush

@section('content')
  <div class="row d-flex h-100">
    <div class="col col-lg-12 mb-lg-0">
      <div class="card mb-3" style="border-radius: .5rem;">
        <div class="row g-0">
          <div class="col-md-4 gradient-custom text-center text-white"
            style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
              alt="Avatar" class="img-fluid my-5" style="width: 100px;" />
            <h5>Marie Horwitz</h5>
            <p>Web Designer</p>
            <i class="far fa-edit mb-5"></i>
          </div>
          <div class="col-md-8">
            <div class="card-body p-4 mt-2">
              <h6>Profile Information</h6>
              <hr class="mt-0 mb-4">
              <div class="row pt-1">
                <div class="col-6 mb-3">
                  <h6>User Name</h6>
                  <p class="text-muted">{{ $user->name }}</p>
                </div>
                <div class="col-6 mb-3">
                  <h6>Email Address</h6>
                  <p class="text-muted">{{ $user->email }}</p>
                </div>
              </div>
              <hr class="mt-0">
              <div class="row pt-1">
                <div class="col-6 mb-3">
                  <h6>Employee Number</h6>
                  <p class="text-muted">{{ $user->employee_number }}</p>
                </div>
                <div class="col-6 mb-3">
                  <h6>Role</h6>
                  <p class="text-muted">{{ $user->role }}</p>
                </div>
              </div>
              <hr class="mt-0">
              <div class="row pt-1">
                <div class="col-6 mb-3">
                  <h6>Phone Number</h6>
                  <p class="text-muted">{{ $user->phone_number }}</p>
                </div>
                <div class="col-6 mb-3">
                  <h6>Designation</h6>
                  <p class="text-muted">{{ $user->designation }}</p>
                </div>
              </div>            
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

{{-- 
  
  <nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item"><a href="#">Profiles</a></li>
    <li class="breadcrumb-item active" aria-current="page">Profile Details</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Profile Details</h6>
        <div class="table-responsive">

          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
            
          <table class="table table-bordered table-hover mt-3" id="dataTableExample" >
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email Address</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  --}}


@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script defer>
    
    var del = document.getElementById('prescription-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush