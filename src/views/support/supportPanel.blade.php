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

                <a type="button" class="btn btn-success mr-3" href="{{ route('admin.new', [$slug]) }}"><i class="fas fa-plus"></i> New {{ $name ?? '' }}</a> 
                
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
@endsection

@section('content')

    <table class="table table-striped">
        <thead>
          <tr>
            @foreach ( $fields as $field)
            <th scope="col">{{ $field }}</th>
            @endforeach
            <th scope="col">Gestion</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($listFields as $listField)  

            <tr>
            
                
                @foreach ($listField as $Field)  

                <td>{{ $Field }}</td>

                @endforeach


                <td>
             
                <a class="btn btn-secondary" href="{{ $ids[$loop->index]['id'] }}"><i class="fas fa-info-circle"></i></a> 
                <a class="btn btn-secondary text-light" href="{{ $ids[$loop->index]['id'] }}"><i class="far fa-edit"></i></a>
                <button type="button" class="btn btn-secondary text-light" data-toggle="modal" data-target=".modalDelete{{ $ids[$loop->index]['id'] }}" ><i class="far fa-trash-alt"></i></button>

                </td>

               
            </tr>
                    

                <div class="modal fade modalDelete{{ $ids[$loop->index]['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                           
                                <a class="btn btn-danger text-light" href="{{ route('admin.delete', [$slug, $ids[$loop->index]['id']] )}}">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>

          
            @endforeach

        </tbody>
      </table>    

     

   

    
@endsection