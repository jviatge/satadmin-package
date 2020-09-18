@if ($section == 'new')

    {{-- npm install quill --}}

    <div class="form-group row sectionQuill">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>

        <div class="col-md-6">

            <input type="hidden" class="inputFieldEdit" name="{{ $fieldName }}">
        {{-- <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea> --}}

            <!-- Create the toolbar container -->
            <div class="toolbar">
            
            </div>

            <!-- Create the editor container -->
            <div class="editor">
                {{ request()->input($fieldName, old($fieldName)) }}
            </div>
        </div>
       
    </div>
    <div class="form-group row"> 

        <div class="col-md-4"></div>
        <div class="col-md-6">
            
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


    <div class="form-group row sectionQuill">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }} {{ ($required) ? '*' : null }}</label>

        <div class="col-md-6">

                <input type="hidden" class="inputFieldEdit" name="{{ $fieldName }}">
            {{-- <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea> --}}

                <!-- Create the toolbar container -->
                <div class="toolbar">
                
                </div>

                <!-- Create the editor container -->
                <div class="editor">
                    {!! (request()->input($fieldName, old($fieldName))) ? request()->input($fieldName, old($fieldName)) : $value !!}
                </div>
            
        </div>
    </div>
    <div class="form-group row"> 

        <div class="col-md-4"></div>
        <div class="col-md-6">
            
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


