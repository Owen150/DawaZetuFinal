@extends('layouts.app')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
  </ol>
</nav>

  <div class="col-md-12">
    <div class="card ">
      <div class="card-body">

        <h6 class="card-title">Edit Category</h6>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

          <div class="row mb-3">
            
            <div class="col-sm-12 col-md-12">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Category Name</label>
              <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control" id="categoryName" placeholder="">
            </div>

            <div class="col-xs-6 col-sm-12 col-md-6">
                
              <label>Category Type</label>
              <select class="form-select" name="type" id="type" required>
                @foreach ($types as $type)
                <option @if($type->id == $category->type_id) selected @endif  value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
                
                
              </select>
         
          </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary me-2">Update Category</button>
          </div>
          
        </form>

      </div>
    </div>
  </div>


@endsection
