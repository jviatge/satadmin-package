@if ($section == 'new')

<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>

    <div class="col-md-6">

        <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ request()->input($fieldName, old($fieldName)) }}</textarea>

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

        <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ (request()->input($fieldName, old($fieldName))) ? request()->input($fieldName, old($fieldName)) : $value }}</textarea>

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


