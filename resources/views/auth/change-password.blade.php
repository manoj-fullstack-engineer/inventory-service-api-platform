@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
                    <!-- Display Success or Error Messages -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Change Password Form -->
                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>

                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 text-center">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Change Password') }}
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-danger ml-2">
                                    {{ __('Dashboard') }}
                                </a>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
