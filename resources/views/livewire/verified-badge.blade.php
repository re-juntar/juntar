<div class= 'inline-flex items-center bg-fogra-darkish rounded-xl shadow-lg p-1'>    
    @foreach ($academicUnits as $academicUnit)
        @if ($academicUnit->id === $endorsementRequest->academic_unit_id)
            @if ($academicUnit->image_logo != null && file_exists('images/logos/'.$academicUnit->image_logo))
                <img class="h-6 w-6 ml-1 mr-2" src="{{ asset('images/logos/'.$academicUnit->image_logo) }}" alt="">            
            @else
                <img class="h-6 w-6 ml-1 mr-2" src="{{ asset('images/logos/logo-uncoma-w.svg') }}" alt="">
            @endif
            <div class="text-white-ghost text-sm mr-2">
                <h2>Avalado</h2>
                <h3>{{$academicUnit->short_name}}</h3>
            </div>
        @endif
    @endforeach
</div>
