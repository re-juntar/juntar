<div class="">
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="content">
            <div class="bg-white-ghost text-fogra-darkish pb-5">
                <h1 class="text-awesome">Elegí una Unidad Academica</h1>
                <div class="my-5">
                    <form method="POST" action="{{route('avales')}}" class="inline-block" enctype="multipart/form-data">
                        @csrf
                        <select id="academicUnit" name="academicUnit" class=" mt-1  border-[#ced4da] rounded-[0.375rem]">
                            <option disabled selected>elegir una opción</option>
                            <option value="1">Facultad de Informatica</option>
                            <option value="2">Facultad de Economía y Administración</option>
                            <option value="3">Facultad de Ingeniería</option>
                            <option value="4">Facultad de Humanidades</option>
                            <option value="5">Facultad de Ciencias del Ambiente y la Salud</option>
                            <option value="6">Facultad de Turismo</option>
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
