@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br />
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6"><i class="far fa-clipboard"></i> {{ __('Posts') }}</div>
                        <div class="col-sm-6">
                            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right" role="button"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
                        </div>
                    </div>
                </div>

                @if(count($posts))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Author') }}</th>
                                <th scope="col">{{ __('Category') }}</th>
                                <th scope="col">{{ __('Views') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                @if(Auth::user()->admin)
                                    <th scope="col">{{ __('Actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->author }}</td>
                                    <td>{{ $post->category }}</td>
                                    <td>{{ $post->views }}</td>
                                    <td>
                                        @if($post->active)
                                            <span class="text-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="text-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    @if(Auth::user()->admin)
                                        <td>
                                            <a href="{{ route('posts.edit', array($post->id)) }}" id="btn-edit" class="btn btn-primary btn-sm btn-edit">
                                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                                            </a>
                                            <a href="{{ route('posts.remove', array($post->id)) }}" id="btn-remove" class="btn btn-danger btn-sm btn-danger" onclick="return confirm('{{ __('Do you really want to remove this post?') }}');">
                                                <i class="fas fa-trash-alt"></i> {{ __('Remove') }}                                            
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="p-4">
                        {{ __('Any register was found') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
