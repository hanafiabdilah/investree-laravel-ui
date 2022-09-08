@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h1 class="card-title fw-bold">Edit Category</h1>
        </div>
        <div class="card-body">
          <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $article->title }}">
              @error('title')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5">{{ $article->content }}</textarea>
              @error('content')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <img src="{{ asset('images/article') }}/{{ $article->image }}" style="width: 100%" class="mb-2">
              <input type="file" class="form-control form-control-file @error('image') is-invalid @enderror" name="image" id="image" accept=".jpg,.jpeg,.png,.gif">
              @error('image')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <select name="category" id="category" class="form-control">
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $article->category_id === $category->id ? 'selected' : '' }}>{{ $category->name}}</option>
                @endforeach'
              </select>
              @error('category')<small class="text-danger">{{ $message }}</small>@enderror
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