@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">        
        <div class="col-md-10">
            <div class="messages">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br />
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="card">
                <form method="POST" action="{{ route('posts.edit', array($post->id)) }}" class="text-center border border-light p-5" enctype="multipart/form-data">
                    @csrf
                    <p class="h4 mb-4">{{ __('Edit Post') }}</p>
                    
                    <input type="text" name="title" value="{{ $post->title }}" class="form-control mb-4" placeholder="{{ __('Title') }}" required>

                    <select name="category" class="form-control mb-4">
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}" {!! $post->category == $category->name ? 'selected' : '' !!}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <select name="active" class="form-control mb-4">
                        <option value="1">{{ __('Active') }}</option>
                        <option value="0" {!! !$post->active ? 'selected' : '' !!}>{{ __('Inactive') }}</option>
                    </select>

                    <input type="hidden" name="prevSlug" value="{{ $post->slug }}">
                    <input type="text" name="slug" value="{{ $post->slug }}" class="form-control mb-4" placeholder="{{ __('URL') }}" required>
                    
                    @if(!empty($post->img_path))
                        <img class="w-25 mb-1" src="{{ asset($post->img_path) }}" alt="{{ $post->first_name }}">
                    @endif
                    
                    <input type="file" value="{{ $post->file }}" class="form-control mb-4" name="img_path"/>
                    
                    <div class="form-group">
                        <textarea name="body" class="form-control rounded-0" rows="5" placeholder="{{ __('Post text') }}">{{ $post->body }}</textarea>
                    </div>
                    
                    <a class="col-sm-5 float-left" href="{{ route('posts.index') }}" role="button">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-success col-sm-5 float-right">{{ __('Edit') }}</button>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection