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
              Details {{ $name ?? 'Unknow' }} 
            </h1>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="nav navbar-nav ml-auto">

                <a type="button" class="btn btn-outline-secondary mr-3" href="{{ route('admin.update', [$slug, $id]) }}"><i class="far fa-edit"></i> Edit</a> 
                
                </div>
            </div>
        </div>
    </nav>

    <div class="mb-4">
      <a class="btn btn-groupe mr-3" href="{{ route('admin', [$slug]) }}"><i class="fas fa-arrow-left fa-lg mr-2"></i><span>Back</span></a>
    </div>

@endsection

@section('content')

@php
    if (isset($fields[count($fields) - 1]['extend']))
    {
      $extend = $fields[count($fields) - 1]['extend'];
      unset($fields[count($fields) - 1]);
    }
@endphp

<table class="table">
    {{-- <thead>
      <tr>
        <th scope="col">Column</th>
        <th scope="col">Value</th>
      </tr>
    </thead> --}}
    <tbody>
      @foreach ($fields as $Field)  

      <tr>
        <th scope="row">{{ $Field['label'] }}</th>
        <td class="fieldValueSataDetails">{{ $Field['value'][0] }}</td>
      </tr>
  
      @endforeach

    </tbody>
  </table>

  @if(isset($extend))
    {{ $extend }}
  @endif
  



@endsection



           