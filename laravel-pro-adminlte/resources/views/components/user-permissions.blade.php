<form action="{{ route('users.updatePermissions', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-header">
            Definir Permissões do usuário
        </div>
        <div class="card-body">
            @foreach(['users'] as $entity)
                <div class="mb-3">
                    <label class="form-label">{{ ucfirst($entity) }}</label>
                        @foreach($permission as $action)
                            <div class="form-check">
                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $action->name }}"
                                        class="form-check-input"
                                        {{ $user->canOverride($action->name) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label">{{ ucfirst($action->name) }}</label>
                            </div>
                        @endforeach
                </div>
            @endforeach
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Atualizar Permissões</button>
        </div>
    </div>
</form>
