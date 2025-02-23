@extends('layouts.auth')
@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ route('login') }}"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <x-auth-input type="text" name="name" placeholder="Full name" />
                    <x-auth-input type="email" name="email" placeholder="Email" />
                    <x-auth-input type="password" name="password" placeholder="Password" />
                    <x-auth-input type="password" name="password_confirmation" placeholder="Password confirmation" />

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
                <p class="mb-0 text-center">
                    <a href="{{ route('login') }}" class="text-center"> I already have a membership </a>
                </p>
            </div>
        </div>
    </div>
@endsection
