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
                        <div class="col-sm-6"><i class="fas fa-users"></i> {{ __('Users') }}</div>
                        <div class="col-sm-6">
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right" role="button"><i class="fas fa-plus"></i> {{ __('Add New') }}</a>
                        </div>
                    </div>
                </div>

                @if(count($users))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('First Name') }}</th>
                                <th scope="col">{{ __('Last Name') }}</th>
                                <th scope="col">{{ __('E-mail') }}</th>
                                <th scope="col">{{ __('Status') }}</th>
                                @if(Auth::user()->admin)
                                    <th scope="col">{{ __('Actions') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->active)
                                            <span class="text-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="text-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    @if(Auth::user()->admin)
                                        <td>
                                            <a href="{{ route('users.edit', array($user->id)) }}" id="btn-edit" class="btn btn-primary btn-sm btn-edit">
                                                <i class="fas fa-edit"></i> {{ __('Edit') }}
                                            </a>
                                            <a href="{{ route('users.remove', array($user->id)) }}" id="btn-remove" class="btn btn-danger btn-sm btn-danger" onclick="return confirm('{{ __('Do you really want to remove this user?') }}');">
                                                <i class="fas fa-trash-alt"></i> {{ __('Remove') }}                                            
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
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
