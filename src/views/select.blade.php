@if ($section == 'new')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">
            <select class="form-control" name="{{ $fieldName }}">
                <option disabled selected>None</option>
                @foreach ($arr as $key => $value)
                    <option value="{{ $value }}">{{ $key }}</option>
                @endforeach
            </select>
        </div>
    </div>

@elseif ($section == 'update')

    <div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
    
        <div class="col-md-6">
            <select class="form-control" name="{{ $fieldName }}" required>
                {{-- <option disabled selected value>None</option> --}}
                @foreach ($arr as $key => $myValue)
                    @if($value == $myValue)
                        <option value="{{ $myValue }}" selected>{{ $key }}</option>
                    @else
                        <option value="{{ $myValue }}">{{ $key }}</option>
                    @endif 
                @endforeach
            </select>
        </div>
    </div>
    
@endif

