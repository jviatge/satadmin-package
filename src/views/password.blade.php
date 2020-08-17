
@if (collect(request()->segments())->last() == 'new')
    
    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ __( $name ) }}</label>

        <div class="col-md-6">
            <input type="password" class="form-control @error('{{ $field }}') is-invalid @enderror" name="{{ $field }}" required autocomplete="new-password">

            @error('{{ $field }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    {{-- <div class="form-group row">
        <label for="{{ $field }}-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm ' . $name ) }}</label>

        <div class="col-md-6">
        <input id="{{ $field }}-confirm" type="password" class="form-control" name="{{ $field }}_confirmation" required autocomplete="new-{{ $field }}">
        </div>
    </div> --}}

@endif
