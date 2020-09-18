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
                        <input class="form-control mr-sm-2"  id="formSearchTable" type="search" placeholder="Search" aria-label="Search">
                        {{-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> --}}
                    </form>

                    <a type="button" class="btn btn-success ml-3" href="{{ route('admin.new', [$slug]) }}"><i class="fas fa-plus"></i> New {{ $name ?? '' }}</a> 

                </div>
            </div>
        </div>
    </nav>
    
@endsection

@section('content')
<form action="{{ route('admin.delete.multi', [$slug])}}" method="POST" id="formMultiDel">
    @csrf
    <table class="table table-bordered table-sm shadow-sm" id="tablePanel" cellspacing="0" width="100%">
        
        @if ($fields != null)
        <thead>
            <tr class="h-25">
                <th scope="col" class="checkWith"><input class="masterCheck" type="checkbox"></th>
                @foreach ($fields as $Field)  
                <th scope="col" class="thPadding nameFields">{{ $Field['label'] }}</th>
                @endforeach
                <th scope="col" class="thPadding gestionWith">Gestion</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($fields[0]['id']); $i++)
            <tr>
                <td class="checkWith" ><input class="slaveCheck" type="checkbox" name="check[]" value="{{ $fields[0]['id'][$i] }}"></td>
                @foreach ($fields as $Field)  
                    <td class="fieldValueSata">{{ $Field['value'][$i] }}</td>
                @endforeach
                <td class="gestionWith">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.details', [$slug, $fields[0]['id'][$i]]) }}"><i class="fas fa-info-circle"></i></a> 
                    <a class="btn btn-outline-secondary" href="{{ route('admin.update', [$slug, $fields[0]['id'][$i]]) }}"><i class="far fa-edit"></i></a>
                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target=".modalDelete{{ $fields[0]['id'][$i] }}" >
                        <i class="far fa-trash-alt"></i>
                    </button>
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
</form>


    <div class="modal fade modalDeleteMore" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <button onclick="sendMultiDel()" class="btn btn-danger text-light">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function sendMultiDel(){
            document.getElementById("formMultiDel").submit();
        }
    </script>

    <script type="text/javascript">
        

        // DATATABLE        
        $(document).ready(function () {

            let htmlBtn = '<button type="button" id="btnRemoveMulti" class="btn btn-outline-secondary mb-2 mr-3" data-toggle="modal" data-target=".modalDeleteMore" disabled><i class="far fa-trash-alt"></i></button>'

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            let colunmGestion = document.getElementsByTagName('th').length - 1;

            $('#tablePanel').DataTable({
                "dom" : '<"top"<"row px-3 mb-2 justify-content-start align-items-center text-center"<"#removeBtn"><l>><"clear">>t<"bottom"<"row"<"col-sm-4"><"col-sm-4"f><"col-sm-4 mb-3"p>>>',
                "info": false,
                "columnDefs": [
                    { "orderable": false, "targets": [0] },
                    { "orderable": false, "targets": [colunmGestion] }
                ]
            });
            $('.dataTables_length').addClass('bs-select');

            $('#removeBtn').append(htmlBtn)
            
        });
    
        window.addEventListener('load', function () {

            let checkWith           =   document.getElementsByClassName('checkWith')
            let gestionWith         =   document.getElementsByClassName('gestionWith')
            let tablePanel          =   document.getElementById('tablePanel')
            let tablePanel_filter   =   document.getElementById('tablePanel_filter')

            tablePanel_filter.parentElement.style.display = "none"; 
            tablePanel_filter.parentElement.style.display = "block"; 
            
            tablePanel_filter.style.display = "none"
            tablePanel.classList.remove("dataTable");
            for (let i = 0; i < checkWith.length; i++) {
                checkWith[i].classList.remove("sorting_asc");
                gestionWith[i].classList.remove("sorting");
            }

            let formSearchTable     =   document.getElementById('formSearchTable')
            let event = new Event('input');

        
            formSearchTable.addEventListener('input', function (evt) {
                
                tablePanel_filter.childNodes[0].children[0].value = this.value
                tablePanel_filter.childNodes[0].children[0].dispatchEvent(event);

            });
        })     

    </script>
   
    
@endsection