<div class="{{ $div }} @if($type == 'password') position-relative @endif">
    @if($type === 'text')
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        <input
            type="text"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name) ?? $value }}"
            class="form-control @error($name) is-invalid @enderror"
        >
    @elseif($type === 'email')
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        <input
            type="email"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name) ?? $value }}"
            class="form-control @error($name) is-invalid @enderror"
        >
    @elseif($type === 'password')
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        <div class="input-group">
            <input
                type="password"
                id="{{ $name }}"
                name="{{ $name }}"
                class="form-control @error($name) is-invalid @enderror"
            >
            <button class="btn btn-secondary toggle-password" type="button" data-target="{{ $name }}">
                <i class="bi bi-eye-slash"></i>
            </button>
            <button class="btn btn-success border-0 generate-password" type="button" data-target="{{ $name }}">
                <i class="bi bi-shuffle"></i>
            </button>
            @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    @elseif($type === 'tel')
        {{--fazer campo telefone--}}
    @elseif($type === 'textarea')
        {{--fazer campo textArea--}}
    @elseif($type === 'select')
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
        <select id="{{ $name }}" name="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
            <option value="">Selecione uma opção</option>
            @foreach($options as $key => $option)
                <option value="{{ $option }}" {{ (old($name) ?? $value) == $option ? 'selected' : '' }}>
                    {{ $option }}
                </option>
            @endforeach
        </select>
    @elseif('checkbox')
        <input
            class="form-check-input @error($name) is-invalid @enderror"
            type="checkbox"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value ?? '' }}"
            @checked($isChecked)
        />
        <label class="form-check-label" for="{{ $name }}">
            {{ $label }}
        </label>
    @else
        <input
            type="text"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name) ?? $value }}"
            placeholder="{{ $placeholder }}"
            class="form-control @error($name) is-invalid @enderror"
        />
    @endif
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

