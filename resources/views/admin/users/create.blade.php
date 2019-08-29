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
            </div>
            <div class="card">
                <form method="POST" action="{{ route('users.create') }}" class="text-center border border-light p-5" enctype="multipart/form-data">
                    @csrf
                    <p class="h4 mb-4">{{ __('New User') }}</p>

                    <input type="text" name="first_name" class="form-control mb-4" placeholder="{{ __('First Name') }}" required>
                    <input type="text" name="last_name" class="form-control mb-4" placeholder="{{ __('Last Name') }}" required>
                    <input type="email" name="email" class="form-control mb-4" placeholder="{{ __('E-mail') }}" required>
                    <input type="password" name="password" class="form-control mb-4" placeholder="{{ __('Password') }}" required>
                    <input type="password" name="password_confirmation" class="form-control mb-4" placeholder="{{ __('Confirm Password') }}" required>
                    <input type="file" class="form-control mb-4" name="photo_path"/>

                    <div class="form-group">
                        <textarea name="biography" class="form-control rounded-0" rows="5" placeholder="{{ __('Biography') }}"></textarea>
                    </div>

                    <a class="col-sm-5 float-left" href="{{ route('users.index') }}" role="button">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-success col-sm-5 float-right">{{ __('Create') }}</button>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection
