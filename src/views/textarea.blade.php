@if ($section == 'new')

<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

    <div class="col-md-6">

        <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>

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

        <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ $value }}</textarea>

        @error('{{ $fieldName }}')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
    
@endif


