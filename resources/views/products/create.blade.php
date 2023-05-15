@extends('layouts.app')

@push('plugin-styles')
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
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{ route('products.index') }}" class="btn btn-danger mb-md-0">Cancel <span><i
        class="fa-solid fa-ban"></i></span></a>
  </div>
</nav>

  <div class="col-md-12">
    <div class="card ">
      <div class="card-body">

        <h6 class="card-title">Create Product</h6>

        <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputUsername2">Category</label>
              <select class="form-select" name="category_id" id="categories">
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Product Name</label>
            <input type="text" name="product_name" class="form-control" placeholder="product name" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Manufacturers</label>
            <input type="text" name="manufacturers" class="form-control" placeholder="manufacturers" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Strength</label>
            <input type="number" name="strength" class="form-control" placeholder="strength" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Unit of Measure</label>
            <input type="text" name="unit_of_measure" class="form-control" placeholder="unit of measure" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Package Size</label>
            <input type="text" name="package_size" class="form-control" placeholder="package size" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Package Quantity</label>
            <input type="number" name="package_quantity" class="form-control" placeholder="package quantity" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="exampleInputUsername2">Number of Items in Box</label>
            <input type="number" name="no_of_items_in_box" class="form-control" placeholder="Items in box" required>
          </div>

        </div>

        <div>
          <button type="submit" class="btn btn-success mt-3">Submit</button>
        </div>
        </form>

      </div>
    </div>
  </div>

@endsection
