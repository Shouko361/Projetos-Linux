@extends('layouts.auth')
@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ route('login') }}"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <form action="{{ route('password.update') }}" method="post">
                    @csrf

                    <input type="hidden" name="token" value="{{ request()->token }}">
                    <x-auth-input type="email" name="email" placeholder="Email" value="{{ request()->email }}"/>
                    <x-auth-input type="password" name="password" placeholder="Password" />
                    <x-auth-input type="password" name="password_confirmation" placeholder="Password confirmation" />

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
