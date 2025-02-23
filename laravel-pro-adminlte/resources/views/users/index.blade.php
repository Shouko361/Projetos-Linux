@extends('layouts.default')
@section('page-title', 'Usuários')

@section('page-action')
    @can(auth()->user()->canOverride('view users'))
        <a href="{{ route('users.create') }}" class="btn btn-success">Adicionar</a>
    @endcan
@endsection

@section('content')
    Lista de Usuários

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

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Created at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d/m/Y') }} - {{ $user->created_at->format('H:i') }}</td>
                <td class="d-flex gap-3">
                    @can(auth()->user()->canOverride('view users'))
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i></a>
                    @endcan
                    @can(auth()->user()->canOverride('view users'))
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    @endcan
                    @can(auth()->user()->canOverride('view users'))
                        <form action="{{ route('users.destroy', $user->id) }}" class="ml-3" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
