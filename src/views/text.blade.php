
@if (collect(request()->segments())->last() == 'new')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ __( $name ) }}</label>

        <div class="col-md-6">
            <input name="{{ $field }}" type="text" class="form-control @error('{{ $field }}') is-invalid @enderror" required autofocus>
    
            @error('{{ $field }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    

@else

    {{ $name }} 

@endif

{{-- {{ $field }} --}}


{{-- {{ Request::segment(count(Request::segment)) }} --}}

{{-- {{ collect(request()->segments())->last() }} --}}