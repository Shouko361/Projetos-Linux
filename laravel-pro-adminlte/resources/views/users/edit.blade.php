@extends('layouts.default')
@section('page-title', 'Editar Usuário')

@section('content')

    @if (session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif

    <x-basic-details :user="$user"/>
    <br>
    <x-user-profile :user="$user"/>
    <br>
    <x-user-interest :user="$user"/>
    <br>
    <x-user-roles :user="$user" :roles="$roles" :permissions="$rolePermissions"/>
    <br>
    <x-user-permissions :user="$user" :permission="$permissions"/>
@endsection
