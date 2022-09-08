@extends('layouts.app')

@section('content')
  <div class="card">
    <div class="card-body">
      <img src="{{ asset('images/article') }}/{{ $article->image }}" style="width: 100%; max-height: 500px; object-fit: cover">
      <small>Oleh : {{ $article->user->name ?? 'Deleted User' }} | {{ $article->created_at->format('D, d M Y') }} | {{ $article->category->name }}</small>
      <div class="content mt-3">
        <h1>{{ $article->title }}</h1>
        <article>
          {{ $article->content }}
        </article>
      </div>
    </div>
  </div>
@endsection