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
                {{ $name ?? 'Unknow' }}
            </h1>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="nav navbar-nav ml-auto">    

                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    <a type="button" class="btn btn-success ml-3" href="{{ route('admin.new', [$slug]) }}"><i class="fas fa-plus"></i> New {{ $name ?? '' }}</a> 

                </div>
            </div>
        </div>
    </nav>
    
@endsection

@section('content')

    <table class="table table-striped">
        
        @if ($fields != null)
       
        
        <thead>
            <tr>
                @foreach ($fields as $Field)  
                <th scope="col">{{ $Field['label'] }}</th>
                @endforeach
                <th scope="col">Gestion</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($fields[0]['id']); $i++)
            <tr>
                @foreach ($fields as $Field)  
                    <td>{{ $Field['value'][$i] }}</td>
                @endforeach
                <td>
                    <a class="btn btn-secondary" href="{{ route('admin.details', [$slug, $fields[0]['id'][$i]]) }}"><i class="fas fa-info-circle"></i></a> 
                    <a class="btn btn-secondary text-light" href="{{ route('admin.update', [$slug, $fields[0]['id'][$i]]) }}"><i class="far fa-edit"></i></a>
                    <button type="button" class="btn btn-secondary text-light" data-toggle="modal" data-target=".modalDelete{{ $fields[0]['id'][$i] }}" ><i class="far fa-trash-alt"></i></button>
                </td>
            </tr>

            <div class="modal fade modalDelete{{ $fields[0]['id'][$i] }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>

                        <div class="card-body">
                            Are you sure drop ?
                        </div>
                        <div class="card-footer">
                            <button  class="btn btn-secondary text-light" data-dismiss="modal">No</button>
                    
                            <a class="btn btn-danger text-light" href="{{ route('admin.delete', [$slug, $fields[0]['id'][$i]] )}}">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor

        </tbody>
        @endif
    </table>
    
    {{-- <img src="{{ Storage::disk('public')->url('images/1ZsO5NoQEAh0NFKhPnrVyDONu3sChZLFtiHtqeXz.jpeg') }}" alt=""> --}}

   
    
@endsection