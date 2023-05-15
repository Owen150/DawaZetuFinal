@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">County Top Up Requests</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-3 ps-0">
            <a href="#" class="noble-ui-logo d-block mt-3">Proj<span>Trac</span></a>                 
            
          </div>
          <div class="col-lg-3">
            <h6 class="mt-4 text-end fw-normal"><span class="text-muted">Request Date: </span>2023-05-12</h6>
          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Strength</th>
                    <th>Unit of Issue</th>
                    <th>Unit Size</th>
                    <th>Available Units</th>
                    <th>Requested Units</th>
                    <th>Facility</th>
                    <th>Quantity Allocated</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $number = 1; ?>
                  <tr>
                      <td>{{ $number }}</td>
                      <?php $number++; ?>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>    
        <div class="container-fluid w-100">
          <form action="{{ route('approvedRequest', $topups->id) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success float-end mt-4 ms-2">Approve <span ><ion-icon name="add-circle-outline" style="position: relative; top:2px; left: 2px"></ion-icon></span></button>
          </form>
          <a class="btn btn-primary float-end mt-4" id="show-details" data-bs-toggle="modal" data-bs-target="#topup">Ammend <span ><ion-icon name="add-circle-outline" style="position: relative; top:2px; left: 2px"></ion-icon></span></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<form action="{{ route('appendComment', $topups->id) }}" method="post">
  @csrf
  <div class="modal fade" id="topup" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLongTitle">{{ App\Models\Facility::where('id', '=', $topups->facility_id)->first()->name; }} Facility Product Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <h5>Comments</h5>
            <textarea name="comment" id="comment" cols="63" rows="5"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Ammend <span ><ion-icon name="add-circle-outline" style="position: relative; top:2px; left: 2px"></ion-icon></span></button>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection