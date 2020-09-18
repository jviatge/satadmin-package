@if ($section == 'new')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>    
        <div class="col-md-6">
            <input value="{{ request()->input($fieldName, old($fieldName)) }}" name="{{ $fieldName }}" type="text" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" autofocus">
            
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
    </div>

@elseif ($section == 'update')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>
       
        <div class="col-md-6">
            <input value="{{ (request()->input($fieldName, old($fieldName))) ? request()->input($fieldName, old($fieldName)) : $value }}" name="{{ $fieldName }}" type="text" class="form-control @error('{{ $fieldName }}') is-invalid @enderror" autofocus">
    
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
    </div>
    
@endif

