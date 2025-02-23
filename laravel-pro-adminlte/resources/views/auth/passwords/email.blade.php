@extends('layouts.auth')
@section('body-class', 'login-page')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('login') }}"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Reset password
                </p>
                @session('status')
                    {{ $value }}
                @endsession
                <form action="{{ route('password.email') }}" method="post">
                    @csrf

                    <x-auth-input type="email" name="email" placeholder="Email" />

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Send me the link</button>
                    </div>

                </form>
                <div class="mt-2 text-center">
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center"> Back to login </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection




