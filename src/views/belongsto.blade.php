@if ($section == 'new')
<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>
    <div class="col-md-6">

        <select class="form-control" name="{{ $fieldName }}_id">
            <option disabled selected>None</option>
            @foreach ($value as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
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
    <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
    <div class="col-md-6">
        <select class="form-control" name="{{ $fieldName }}_id" required>
            @foreach ($value as $key => $myValue)
                @if($id[0][$fieldName . '_id'] == $key)
                    <option value="{{ $key }}" selected>{{ $myValue }}</option>
                @else
                    <option value="{{ $key }}">{{ $myValue }}</option>
                @endif 
            @endforeach
        </select>
    </div>
</div> 
@elseif ($section == 'panel')

    @if ($value != null)
    @php
        $class = 'App\Satadmin\\' . $classSeg;
    @endphp
        <a href="{{ route('admin.details', [$data['fieldName'], $value['id']]) }}">
            {{ $value[$class::fieldSearch()] }}
        </a>      
    @endif

@elseif ($section == 'details')

    @if ($value != null)
    @php
        $class = 'App\Satadmin\\' . $classSeg;
    @endphp
        <a href="{{ route('admin.details', [$data['fieldName'], $value['id']]) }}">
            {{ $value[$class::fieldSearch()] }}
        </a>      
    @endif
    
@endif

