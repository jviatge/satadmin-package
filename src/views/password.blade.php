@if ($section == 'new')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">
            <input type="password" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" name="{{ $fieldName }}" required autocomplete="new-password">

            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <input type="text" value="{{ $fieldName }}" name="hash" hidden>
    </div>

@elseif ($section == 'update')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">
            <input type="password" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" name="{{ $fieldName }}">

            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <input type="text" value="{{ $fieldName }}" name="hash" hidden>
    </div>
    
@endif


