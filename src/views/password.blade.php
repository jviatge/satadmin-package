@if ($section == 'new')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>

        <div class="col-md-6">
            <input type="password" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" name="{{ $fieldName }}" autocomplete="new-password">

            @if ($errors->any())
                @foreach($errors->getMessages() as $key => $message)
                    @if ($key == $fieldName)
                        @foreach ($message as $error)
                            <div class="alert alert-danger p-0 m-0">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>

        <input type="text" value="{{ $fieldName }}" name="hash" hidden>
    </div>

@elseif ($section == 'update')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>

        <div class="col-md-6">
            <input type="password" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" name="{{ $fieldName }}">

            @if ($errors->any())
                @foreach($errors->getMessages() as $key => $message)
                    @if ($key == $fieldName)
                        @foreach ($message as $error)
                            <div class="alert alert-danger p-0 m-0">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>

        <input type="text" value="{{ $fieldName }}" name="hash" hidden>
    </div>
    
@endif


