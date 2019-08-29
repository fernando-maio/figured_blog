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
                <form method="POST" action="{{ route('users.edit', array($user->id)) }}" class="text-center border border-light p-5" enctype="multipart/form-data">
                    @csrf
                    <p class="h4 mb-4">{{ __('Edit User') }}</p>
                    <input type="text" name="first_name" value="{{ $user->first_name }}" class="form-control mb-4" placeholder="{{ __('First Name') }}" required>
                    <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control mb-4" placeholder="{{ __('Last Name') }}" required>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-4" placeholder="{{ __('E-mail') }}" disabled>

                    <select name="active" class="form-control mb-4">
                        <option value="1">{{ __('Active') }}</option>
                        <option value="0" {!! !$user->active ? 'selected' : '' !!}>{{ __('Inactive') }}</option>
                    </select>
                    
                    @if(!empty($user->photo_path))
                        <img class="w-25 mb-1" src="{{ asset($user->photo_path) }}" alt="{{ $user->first_name }}">
                    @endif
                    
                    <input type="file" value="{{ $user->file }}" class="form-control mb-4" name="photo_path"/>

                    <div class="form-group">
                        <textarea name="biography" class="form-control rounded-0" rows="5" placeholder="{{ __('Biography') }}">{{ $user->biography }}</textarea>
                    </div>

                    <a class="col-sm-5 float-left" href="{{ route('users.index') }}" role="button">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-success col-sm-5 float-right">{{ __('Edit') }}</button>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection
