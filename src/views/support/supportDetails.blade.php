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
                {{ $name ?? 'Unknow' }}
            </h1>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="nav navbar-nav ml-auto">

                    <a type="button" class="btn btn-success mr-3" href="{{ route('admin.user.new')}}">+ New {{ $name ?? '' }}</a>
                
                </div>
            </div>
        </div>
    </nav>
    
@endsection

@section('content')


@if ($user)

<table class="table">
    <thead>
      <tr>
        <th scope="col">Column</th>
        <th scope="col">Data</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">ID</th>
        <td>{{ $user->id }}</td>
      </tr>
      <tr>
        <th scope="row">Name</th>
        <td>{{ $user->name }}</td>
      </tr>
      <tr>
        <th scope="row">Email</th>
        <td>{{ $user->email }}</td>
      </tr>
      <tr>
        <th scope="row">Created at</th>
        <td>{{ $user->created_at }}</td>
      </tr>
      <tr>
        <th scope="row">Updated at</th>
        <td>{{ $user->updated_at }}</td>
      </tr>
    </tbody>
  </table>

    
    

@endif

@endsection



           