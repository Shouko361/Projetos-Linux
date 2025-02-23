<div class="card">
    <form action="{{ route('users.updateInterest', $user->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-header">
            Interesses
        </div>
        <div class="card-body">
            <div class="form-check">
                @foreach(['futebol' => 'Futebol', 'formula_1' => 'Formula 1', 'games' => 'Games'] as $name => $item)
                    <x-form-fields type="checkbox" name="interest[][name]" label="{{ $item }}" div="col-md-12" value="{{ $name }}" isChecked="{{ in_array($name, $user->interest->pluck('name')->toArray()) }}"/>
                    @if($loop->last)
                        @error('interest[][name]')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    @endif
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Editar</button>
        </div>
    </form>
</div>
