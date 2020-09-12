@extends('satadmin::layout/layout')

@section('nav')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-group">
            <i class="fas fa-align-left fa-2x"></i>
        </button>


        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <h1 class="ml-3 mb-0">
            New {{ $name ?? 'Unknow' }}
        </h1>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="nav navbar-nav ml-auto">

                
            
            </div>
        </div>
    </div>
</nav>

<div class="mb-4">
    <a class="btn btn-groupe mr-3" href="{{ route('admin', [$slug]) }}"><i class="fas fa-arrow-left fa-lg mr-2"></i><span>Back</span></a>
</div>
    
@endsection

@section('content')

    
<div class="card-body">
    <form enctype="multipart/form-data" action="{{ route('admin.send.new',[$slug]) }}" method="POST" onsubmit="WYSIWYG()">

        @csrf
        
        @foreach ($fields as $Field)  

            {{ $Field }}

        @endforeach


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Add {{ $name }}
                </button>
            </div>
        </div>

        <script>
            let editor          = document.getElementsByClassName('editor');
            let inputFieldEdit  = document.getElementsByClassName('inputFieldEdit');
            let toolbarOptions  = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike', 'link'],   
                [{ 'color': [] }, { 'background': [] }],  
                [{ 'align': [] }],   
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],          
            ];
    
            for (let i = 0; i < inputFieldEdit.length; i++) {

                let quill = new Quill(editor[i], {
                modules: {
                    toolbar: toolbarOptions
                },
                    theme: 'snow'
                });


                function WYSIWYG()
                {
                    for (let i = 0; i < inputFieldEdit.length; i++) {
                        let data = editor[i].childNodes[0].innerHTML
                        if(data != '<p><br></p>'){
                            inputFieldEdit[i].value = data
                        }
                    }
                }              
            }
        </script>

    </form>
</div>    


    
@endsection