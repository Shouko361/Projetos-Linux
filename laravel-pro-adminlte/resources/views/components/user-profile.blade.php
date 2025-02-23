<div class="card">
    <form action="{{ route('users.updateProfile', $user->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-header">
            Perfil do usuário
        </div>
        <div class="card-body">
            <div class="row">
                <x-form-fields type="text" div="col-md-8" name="address" value="{{ $user->profile->address ?? '' }}" label="Endereço"/>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
