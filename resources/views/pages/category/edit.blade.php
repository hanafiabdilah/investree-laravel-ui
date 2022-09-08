@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h1 class="card-title fw-bold">Edit Category</h1>
        </div>
        <div class="card-body">
          <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $category->name }}">
              @error('name')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <button class="btn btn-warning">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection