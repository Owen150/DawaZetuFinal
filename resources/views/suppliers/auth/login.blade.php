@extends('layouts.master2')


@push('plugin-styles')
<style>
  .my-alerts {
    width: 50vw;
    margin: 0 auto;
  }
</style>
@endpush

@section('content')


@if (Session::has('unsuccess'))
<div class="my-alerts mt-2">
  <div class="alert alert-danger" role="alert" id="danger">
    {{Session::get('unsuccess')}}
  </div>
</div>  
@endif

<div class="page-content d-flex align-items-center justify-content-center">
  
  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('https://images.unsplash.com/photo-1581360742512-021d5b2157d8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=579&q=80') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">Supplier<span> Login</span></a>
              <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
              <form class="forms-sample" method="POST" action="{{ url('/supplierlogin') }}">
                @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">name</label>
                  <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" placeholder="Password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-check mb-3">
                  <input type="checkbox" class="form-check-input" id="authCheck">
                  <label class="form-check-label" for="authCheck">
                    Remember me
                  </label>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">Login</a>
                  {{--
                  <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="twitter"></i>
                    Login with twitter
                  </button>
                  --}}
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

