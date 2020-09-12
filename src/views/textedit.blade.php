@if ($section == 'new')

    {{-- npm install quill --}}

    <div class="form-group row sectionQuill">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">

                <input type="hidden" class="inputFieldEdit" name="{{ $fieldName }}">
            {{-- <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea> --}}

                <!-- Create the toolbar container -->
                <div class="toolbar">
                
                </div>

                <!-- Create the editor container -->
                <div class="editor">
                
                </div>

            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            
        </div>
    </div>

@elseif ($section == 'update')


    <div class="form-group row sectionQuill">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">

                <input type="hidden" class="inputFieldEdit" name="{{ $fieldName }}">
            {{-- <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea> --}}

                <!-- Create the toolbar container -->
                <div class="toolbar">
                
                </div>

                <!-- Create the editor container -->
                <div class="editor">
                    {!! $value !!}
                </div>

            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            
        </div>
    </div>
@elseif ($section == 'panel')
    
    <!-- Large modal -->
    {{ $value }}
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".{{ $data }}">Large modal</button>

    <div class="modal fade {{ $data }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! $value !!}
        </div>
    </div>
    </div> --}}
@elseif ($section == 'details')
    {!! $value !!}
@endif


