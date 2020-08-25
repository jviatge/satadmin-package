@if ($section == 'new')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">
            <input name="{{ $fieldName }}" type="email" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" required autocomplete="{{ $fieldName }}" autofocus>

            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

@elseif ($section == 'update')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">
            <input value="{{ $value }}" name="{{ $fieldName }}" type="email" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" required autocomplete="{{ $fieldName }}" autofocus>

            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
@endif

