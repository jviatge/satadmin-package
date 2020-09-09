<div class="p-2">

  <h3 class="pt-3 pb-2">
    {{ $name ?? 'Unknow' }}
  </h3>
  
  
  <table class="table table-bordered table-sm shadow-sm">
          
    @if ($fields != null)
   
    
    <thead>
        <tr>
            @foreach ($fields as $Field)  
            <th scope="col" class="thPadding">{{ $Field['label'] }}</th>
            @endforeach
            <th scope="col" class="thPadding">Gestion</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count($fields[0]['id']); $i++)
        <tr>
            @foreach ($fields as $Field)  
                <td class="fieldValueSata">{{ $Field['value'][$i] }}</td>
            @endforeach
            <td class="gestionWith">
                <a class="btn btn-outline-secondary" href="{{ route('admin.details', [$slug, $fields[0]['id'][$i]]) }}"><i class="fas fa-info-circle"></i></a> 
                <a class="btn btn-outline-secondary" href="{{ route('admin.update', [$slug, $fields[0]['id'][$i]]) }}"><i class="far fa-edit"></i></a>
                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target=".modalDelete{{ $fields[0]['id'][$i] }}" ><i class="far fa-trash-alt"></i></button>
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
</div>




           