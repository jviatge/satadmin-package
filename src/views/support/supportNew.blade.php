@extends('satadmin::layout/layout')

@section('nav')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        {{-- <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Toggle Sidebar</span>
        </button> --}}


        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <h1>
            New {{ $name ?? 'Unknow' }}
        </h1>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="nav navbar-nav ml-auto">

                {{-- <button type="button" class="btn btn-success mr-3" href="{{ route('admin.user.new')}}">+ New {{ $name ?? '' }}</button> --}}
            
            </div>
        </div>
    </div>
</nav>
    
@endsection

@section('content')

    
<div class="card-body">
    <form action="{{ route('admin.add',[$slug]) }}" method="POST">

        @csrf
        
        @foreach ($fields as $Field)  

            {{ $Field }}

        @endforeach

        {{-- <input type="text" id="email" name="email"> --}}


        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Add {{ $name }}
                </button>
            </div>
        </div>

    </form>
</div>    


    
@endsection