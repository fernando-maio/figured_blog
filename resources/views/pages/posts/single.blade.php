@extends('layouts.blog')

@section('content')

<div class="mb-4 col-md-10 mx-auto">
    <h2 class="card-title mt-5">{{ $post->title }}</h2>
    <img class="card-img-top" src="{{ $post->img_path }}" alt="{{ $post->title }}">
    <div class="card-footer text-muted">
        <small>Posted on {{ $post->created_at->format('M d, Y') }} by {{ $post->author }}</small>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $post->body }}</p>
    </div>
    <div class="my-4">
        <h6 class="card-header">{{ __('Category') }}</h6>
        <div class="p-4">{{ $post->category }}</div>                
    </div>
</div>
@endsection