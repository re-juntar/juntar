<x-jet-dialog-modal wire:model="open">
    <x-slot name="content">
        <div class="bg-white-ghost text-fogra-darkish p-5">
            <h1>Elegí una Unidad Academica</h1>
            <div class="my-5">
                <form method="POST" action="{{route('user-academic-units')}}" class="inline-block" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-center">
                        <div>
                            @if($userAcademicUnits)
                                <input type="number" hidden name="user_id" value="{{ $user->id }}">
                                @foreach ($academicUnits as $academicUnit)
                                    <div class="form-check">
                                        <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            type="checkbox"
                                            value="{{ $academicUnit->id }}"
                                            name="academicUnits[]"
                                            {{ array_reduce($userAcademicUnits->toArray(), fn($current, $usr_AU) => $current ? $current : ($usr_AU['academic_unit_id'] == $academicUnit->id ? $academicUnit->id : null) ) === $academicUnit->id ? 'checked' : '' }}
                                            id="checkbox-{{ $academicUnit->name }}">

                                        <label class="form-check-label inline-block text-gray-800" for="checkbox-{{ $academicUnit->name }}">
                                            {{ $academicUnit->name }}
                                        </label>
                                    </div>
                                @endforeach
                                Confirmar Unidades academicas que valida el usuario {{ $user->name }}

                                <x-button class="h-full hover:bg-fogra-darkish" type=submit>
                                    Confirmar Unidades academicas que valida el usuario {{ $user->name }}
                                </x-button>
                            @endif
                        </div>
                      </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-jet-dialog-modal>
