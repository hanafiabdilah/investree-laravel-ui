@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h1 class="card-title fw-bold">Create Article</h1>
        </div>
        <div class="card-body">
          <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
              @error('title')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea type="text" class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5">{{ old('content') }}</textarea>
              @error('content')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input type="file" class="form-control form-control-file @error('image') is-invalid @enderror" name="image" id="image" accept=".jpg,.jpeg,.png,.gif">
              @error('image')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <select name="category" id="category" class="form-control">
                <option value="" disabled selected>Pilih Category</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              @error('category')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="mb-3">
              <button class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h1 class="card-title fw-bold">Article</h1>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>User</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($articles->count() > 0)
                @foreach($articles as $article)
                  <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $article->title }}</td>
                    <td class="align-middle">{{ $article->category->name }}</td>
                    <td class="align-middle"><img src="{{ asset('images/article') }}/{{ $article->image }}" height="100"></td>
                    <td class="align-middle">{{ $article->user->name ?? 'Deleted User' }}</td>
                    <td class="align-middle">
                      <div class="d-flex">
                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-sm btn-primary me-2">Show</a>
                        <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                        <form action="{{ route('article.destroy', $article->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @else 
                  <tr>
                    <td colspan="5">Article tidak tersedia</td>
                  </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection