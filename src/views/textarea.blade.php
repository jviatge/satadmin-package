@if ($section == 'new')

{{-- npm install quill --}}

    <div class="form-group row sectionQuill">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">

                <input type="hidden" id="input" name="{{ $fieldName }}">
            {{-- <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea> --}}

                <!-- Create the toolbar container -->
                <div id="toolbar">
                
                </div>

                <!-- Create the editor container -->
                <div id="editor">
               
                </div>
    
            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

           
        </div>
    </div>





<!-- Initialize Quill editor -->
<script>
let toolbarOptions = [
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline', 'strike', 'link'],   
    [{ 'color': [] }, { 'background': [] }],  
    [{ 'align': [] }],   
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'indent': '-1'}, { 'indent': '+1' }],          
];

let quill = new Quill('#editor', {
    modules: {
        toolbar: toolbarOptions
    },
    theme: 'snow'
});

let editor = document.getElementById('editor');
let input = document.getElementById('input');


function WYSIWYG()
{
    let data = editor.childNodes[0].innerHTML
    if(data != '<p><br></p>'){
        input.value = data
    }
}
// btn.addEventListener('click', function(){
    
// })
</script>

@elseif ($section == 'update')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>

        <div class="col-md-6">

            <textarea name="{{ $fieldName }}" class="form-control" id="exampleFormControlTextarea1" rows="4">{{ $value }}</textarea>
    
            @error('{{ $fieldName }}')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
@endif


