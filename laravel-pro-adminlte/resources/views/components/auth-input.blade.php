<div class="input-group mb-3">
    @if($type === 'text')
            <div class="input-group-text"><span class="bi bi-person"></span></div>
            <input
                type="text"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ old($name) ?? $value }}"
                placeholder="{{ $placeholder }}"
                class="form-control @error($name) is-invalid @enderror"
            />
    @elseif($type === 'email')
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
            <input
                type="email"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ old($name) ?? $value }}"
                placeholder="{{ $placeholder }}"
                class="form-control @error($name) is-invalid @enderror"
            />
    @elseif($type === 'password')
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            <input
                type="password"
                id="{{ $name }}"
                name="{{ $name }}"
                placeholder="{{ $placeholder }}"
                class="form-control @error($name) is-invalid @enderror"
            />
    @elseif($type === 'tel')
        {{--fazer campo telefone--}}
    @elseif($type === 'textarea')
        {{--fazer campo textArea--}}
    @else
            <div class="input-group-text"><span class="bi bi-person"></span></div>
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
