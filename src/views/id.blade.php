
@if (collect(request()->segments())->last() != 'new')

    {{ $name }} 

@endif
