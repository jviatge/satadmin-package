@if ($section == 'new')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
        <div class="col-md-6">
            <div class="custom-file mb-2">

                <label for="{{ $fieldName }}" class="label-file btn"><i class="fas fa-upload"></i> Upload image</label><span class="ml-2 nameImgUpload"></span>

                <input type="file" class="p-0 input-file imgInp" id="{{ $fieldName }}" name="{{ $fieldName }}">

            </div>    
            <div class="frame-img rounded">

                <img class="rounded mx-auto d-block img-upload"/>

            </div>
        </div>
    </div>

@elseif ($section == 'update')

    <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">{{ $label }}</label>
        <div class="col-md-6">
            <div class="custom-file mb-2">

                <label for="{{ $fieldName }}" class="label-file btn"><i class="fas fa-upload"></i> Upload image</label><span class="ml-2 nameImgUpload">{{ $value }}</span>

                <input type="file" class="p-0 input-file imgInp" id="{{ $fieldName }}" name="{{ $fieldName }}">

            </div>    
            <div class="frame-img rounded">

            <img class="rounded mx-auto d-block img-upload" src="{{ Storage::disk('public')->url('images/' . $value) }}"/>

            </div>
        </div>
    </div>

@elseif ($section == 'panel')

    @php $id = preg_replace("/[^a-zA-Z]/", "", $value ) @endphp
    @if ($value != null)

        <a href="{{ Storage::disk('public')->url('images/' . $value) }}" data-toggle="modal" data-target="#{{ $id }}">
            <img src="{{ Storage::disk('public')->url('images/' . $value) }}" class="imgPanel">
        </a>

        <div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-center">
                    <img src="{{ Storage::disk('public')->url('images/' . $value) }}" class="imgPanelModal">
                </div>
            </div>
            </div>
        </div>
        
    @endif

@elseif ($section == 'details')

    @php $id = preg_replace("/[^a-zA-Z]/", "", $value ) @endphp
        @if ($value != null)

        <a href="{{ Storage::disk('public')->url('images/' . $value) }}" data-toggle="modal" data-target="#{{ $id }}">
            <img src="{{ Storage::disk('public')->url('images/' . $value) }}" class="imgDetails">
        </a>

        <div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-center">
                    <img src="{{ Storage::disk('public')->url('images/' . $value) }}" class="imgPanelModal">
                </div>
            </div>
            </div>
        </div>
            
    @endif

@endif