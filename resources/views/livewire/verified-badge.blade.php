<div class= 'inline-flex items-center bg-fogra-darkish rounded-xl shadow-lg p-1'>
    @foreach ($academicUnits as $academisUnit)
        @if ($academisUnit->id === $endorsementRequest->academic_units_id)
            @if ($academisUnit->image_logo === null || !file_exists(asset('images/logos/'.$academisUnit->image_logo)))
                <img class="h-6 w-6 ml-1 mr-2" src="{{ asset('images/logos/logo-uncoma-w.svg') }}" alt="">
            @else
                <img class="h-6 w-6 ml-1 mr-2" src="{{ asset('images/logos/'.$academisUnit->image_logo) }}" alt="">
            @endif
            <div class="text-white-ghost text-sm mr-2">
                <h2>Avalado</h2>
                <h3>{{$academisUnit->short_name}}</h3>
            </div>
        @endif
    @endforeach
</div>
