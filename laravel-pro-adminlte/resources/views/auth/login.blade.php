@extends('layouts.auth')
@section('body-class', 'login-page')

@section('content')
    <div class="login-box">
        <div class="login-l ogo">
            <a href="{{ route('login') }}"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <x-auth-input type="email" name="email" placeholder="Email" />
                    <x-auth-input type="password" name="password" placeholder="Password" />

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                </form>
                <div class="mt-2 text-center">
                <p class="mb-1"><a href="{{ route('password.request') }}">I forgot my password</a></p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center"> Register a new membership </a>
                </p>
                </div>
            </div>
        </div>
    </div>
@endsection




