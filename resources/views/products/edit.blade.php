@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
  </ol>
</nav>

  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <h3 class="card-title">Edit Product</h3>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Product Name</label>
            <div class="col-sm-9">
              <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Manufacturer</label>
            <div class="col-sm-9">
              <input type="text" name="manufacturers" value="{{ $product->manufacturers }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Strength</label>
            <div class="col-sm-9">
              <input type="number" name="strenth" value="{{ $product->strength }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Unit of Measure</label>
            <div class="col-sm-9">
              <input type="text" name="unit_of_measure" value="{{ $product->unit_of_measure }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Package Size</label>
            <div class="col-sm-9">
              <input type="text" name="package_size" value="{{ $product->package_size }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Package Quantity</label>
            <div class="col-sm-9">
              <input type="number" name="package_quantity" value="{{ $product->package_quantity }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>

          <div class="row mb-3">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Number of Items in Box</label>
            <div class="col-sm-9">
              <input type="number" name="no_of_items_in_box" value="{{ $product->no_of_items_in_box }}" class="form-control" id="categoryName" placeholder="">
            </div>
          </div>
          
          <div class="text-center"><button type="submit" class="btn btn-primary mt-2">Update Product</button></div>
        </form>

      </div>
    </div>
  </div>


@endsection
