@if ($section == 'new')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>
        <div class="col-md-6">

            <select class="form-control" name="{{ $fieldName }}">
                <option disabled selected>None</option>
                    @foreach ($arr as $key => $value)
                        @if (request()->input($fieldName, old($fieldName)) == $key)    
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                        @else
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endif
                    @endforeach
            </select>
         
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
            <select class="form-control" name="{{ $fieldName }}">
                {{-- <option disabled selected value>None</option> --}}
                @foreach ($arr as $key => $myValue)
                    @if (request()->input($fieldName, old($fieldName)))
                        @if (request()->input($fieldName, old($fieldName)) == $key)
                            <option value="{{ $myValue }}" selected>{{ $key }}</option>
                        @else
                            <option value="{{ $myValue }}">{{ $key }}</option>
                        @endif 
                    @else
                        @if($value == $myValue)
                            <option value="{{ $myValue }}" selected>{{ $key }}</option>
                        @else
                            <option value="{{ $myValue }}">{{ $key }}</option>
                        @endif 
                    @endif 
                @endforeach
            </select>

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

