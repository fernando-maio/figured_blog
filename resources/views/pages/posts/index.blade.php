@extends('layouts.blog')

@section('content')
    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">{{ __('Figured Blog') }}</h1>

        @if(count($posts))
            <!-- Blog Post -->
            @foreach($posts as $post)
                <div class="card mb-4">
                    @if(!empty($post->img_path))
                        <img class="card-img-top" src="{{ $post->img_path }}" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{ $post->title }}</h2>
                        <p class="card-text">{!! substr($post->body, 0, 150) !!} {!! strlen($post->body) > 150 ? '...' : '' !!}</p>
                        <a href="{{ route('blog.post.single', array($post->slug)) }}" class="btn btn-primary">{{ __('Read More') }} &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                        Posted on {{ $post->created_at->format('M d, Y') }} by {{ $post->author }}
                        <span class="float-right"><i class="fas fa-eye mr-1"></i>{{ $post->views }}</span>
                    </div>
                </div>
            @endforeach

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="p-4">
                {{ __('Any register was founded :(') }}
            </div>
        @endif
        
    </div>

    <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
            <h5 class="card-header">{{ __('Search') }}</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" id="box-search" class="form-control" placeholder="{{ __('Search by title...') }}">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" id="btn-search" type="button">{{ __('Go') }}</button>
                    </span>
                </div>
            </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header">{{ __('Categories') }}</h5>
            <div class="card-body">
                @foreach($categories as $category)
                    <span class="col-lg-6"><a href="{{ url('/?category=' . $category->name) }}">{{ $category->name }}</a></span>
                @endforeach
            </div>
        </div>

        <!-- Author Widget -->
        <div class="card my-4">
            <h5 class="card-header">{{ __('Authors') }}</h5>
            <div class="card-body">
                @foreach($users as $user)
                    <span class="col-lg-6"><a href="{{ url('/?author=' . $user->first_name . ' ' . $user->last_name) }}">{{ $user->first_name }} {{ $user->last_name }}</a></span>
                @endforeach
            </div>
        </div>
    </div>
@endsection
        