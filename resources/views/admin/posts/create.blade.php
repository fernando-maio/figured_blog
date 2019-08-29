@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">        
        <div class="col-md-10">
            <div class="messages">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br />
                        @endforeach
                    </div>
                @endif

                @if (!count($categories))
                    <div class="alert alert-warning">
                        {{ __('No categories registered. You need to register a category to create a post.') }}
                    </div>
                @endif
            </div>
            <div class="card">
                <form method="POST" action="{{ route('posts.create') }}" class="text-center border border-light p-5" enctype="multipart/form-data">
                    @csrf
                    <p class="h4 mb-4">{{ __('New Post') }}</p>

                    <input type="text" name="title" class="form-control mb-4" placeholder="{{ __('Title') }}" required>
                    
                    <select name="category" class="form-control mb-4">
                        <option value="" selected disabled>{{ __('Select a Category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <select name="active" class="form-control mb-4">
                        <option value="1" selected>{{ __('Active') }}</option>
                        <option value="0">{{ __('Inactive') }}</option>
                    </select>

                    <input type="text" name="slug" class="form-control mb-4" placeholder="{{ __('URL') }}" required>
                    <input type="file" class="form-control mb-4" name="img_path">
                    
                    <div class="form-group">
                        <textarea name="body" class="form-control rounded-0" rows="5"  placeholder="{{ __('Post text') }}"></textarea>
                    </div>

                    <a class="col-sm-5 float-left" href="{{ route('posts.index') }}" role="button">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-success col-sm-5 float-right">{{ __('Create') }}</button>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection
