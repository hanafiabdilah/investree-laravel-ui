@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h1 class="card-title fw-bold">Create Category</h1>
        </div>
        <div class="card-body">
          <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
              @error('name')<small class="text-danger">{{ $message }}</small>@enderror
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
          <h1 class="card-title fw-bold">Category</h1>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>User</th>
                <th>Articles</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($categories->count() > 0)
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->user->name ?? 'Deleted User' }}</td>
                    <td>{{ $category->articles->count() }}</td>
                    <td class="d-flex">
                      <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                      <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              @else 
                  <tr>
                    <td colspan="5">Category tidak tersedia</td>
                  </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection