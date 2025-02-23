<div class="card">
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-header">
            Dados básicos
        </div>
        <div class="card-body">
            <x-form-fields type="text" div="col-md-12 mb-3" name="name" label="Nome Completo" value="{{ $user->name }}"/>
            <div class="row">
                <x-form-fields type="email" div="col-md-6" name="email" label="Email" value="{{ $user->email }}"/>
                <x-form-fields type="password" div="col-md-6" name="password" label="Password" value=""/>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
