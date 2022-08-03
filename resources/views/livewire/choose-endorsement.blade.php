<div class="">
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="content">
            <div class="bg-white-ghost text-fogra-darkish pb-5">
                <h1 class="text-awesome">Elegí una Unidad Academica</h1>
                <div class="my-5">
                    <form method="POST" action="{{route('avales')}}" class="inline-block" enctype="multipart/form-data">
                        @csrf
                        <select id="academicUnit" name="academicUnit" class=" mt-1  border-[#ced4da] rounded-[0.375rem]">
                            <option disabled selected> Seleccione una unidad academica </option>
                            @isset($academicUnits)
                                @foreach ($academicUnits as $academicUnit)
                                    <option value="{{ $academicUnit->id }}" {{ old('academicUnit') == $academicUnit->id ? 'selected' : '' }}>
                                        {{ $academicUnit->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                        <input type="hidden" for="eventId" name="eventId" id="eventId" value="{{$event->id}}">
                        <x-button class="h-full hover:bg-fogra-darkish" type=submit> Solicitar aval
                        </x-button>
                    </form>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
