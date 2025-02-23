@extends('layouts.default')
@section('page-title', 'Adicionar Usuário')

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

    <form action="{{ route('users.store') }}" method="POST" class="row g-3">
        @csrf

        <x-form-fields type="text" div="col-md-12" name="name" label="Nome Completo"/>
        <x-form-fields type="email" div="col-md-6" name="email" label="Email"/>
        <x-form-fields type="password" div="col-md-6" name="password" label="Password"/>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Adicionar Usuário</button>
        </div>
    </form>
@endsection
