<div class="card">
    <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-header">
            Cargo
        </div>
        <div class="card-body">
            <div class="row">
                <x-form-fields type="select" div="col-md-12" name="role" label="Cargo" value="{{ $user->roles->first()->name ?? 'Selecione uma opção' }}" :options="$roles->pluck('name')->toArray()" />
            </div>
            @if(!empty($user->roles->first()->name))
                <br>
                <div class="mb-3">
                        <label class="form-label">Permissões herdadas de {{ $user->roles->first()->name }}</label>
                        @foreach($permissions as $action)
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $action}}"
                                    class="form-check-input"
                                    {{ $user->hasPermissionTo($action) ? 'checked' : '' }}
                                    disabled
                                >
                                <label class="form-check-label">{{ ucfirst($action) }}</label>
                            </div>
                        @endforeach
                </div>
            @endif
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Alterar Cargo</button>
        </div>
    </form>
</div>
