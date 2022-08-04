<x-app-layout>
    {{-- Create Event Content --}}
    @auth
        <div class="create-event bg-[#0B0D19]">
            <div
                class="create-event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-[0.25rem] py-[3vh] px-[3vh]">
                <x-pink-header>Editar Evento {{$event->name}}</x-pink-header>
                <div class="create-event-body bg-[#EFEFEF] p-[1.25rem]">
                    <p class="text-center mb-4">Cambie la informacion que desee y luego aplique los cambios con el boton de
                        "Guardar Cambios" que se encuentra al final del formulario.</p>

                    <form method="POST" action="{{ route('update-event') }}" enctype="multipart/form-data">
                        @csrf

                        <input hidden name="eventId" id="eventId" value="{{ $event->id }}">
                        <input hidden id="hiddenDate" value="{{ $event->inscription_end_date }}">
                        <input id="hiddenVenue" hidden value="{{ $event->venue }}">
                        <input id="hiddenmeeting" hidden value="{{ $event->meeting_link }}">
                        {{-- Nombre --}}
                        <div class="mb-4">
                            <x-input id='name' class="w-full" type='text' name='name'
                                placeholder="Ingrese Nombre" value="{{ old('name', $event->name) }}" />
                            @error('name')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Nombre Corto --}}
                        <div class="mb-4">
                            <x-label for="short-name">Nombre corto del evento *</x-label>
                            <div id="automaticSlug" class=" shortNames"></div>
                            <x-input id="short-name" class="w-full" type="text" name="short-name"
                                placeholder='Ingrese nombre corto' value="{{ old('short-name', $event->short_name) }}" />
                            @error('short-name')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Descripcion --}}
                        <div class="mb-4">
                            <x-label for="description">Descripcion *</x-label>
                            <textarea id="description" class="block w-full" name="description" rows="10">
                                {{ old('description', $event->description) }}
                            </textarea>
                            @error('description')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Categoria --}}
                        @php
                            //$category = $event->event_category_id;
                            $eventCategoryId = $event->event_category_id;
                        @endphp
                        {{-- Categoria --}}
                        <div class="mb-4">
                            <x-label for="category">Categoria *</x-label>                            
                            <select id="category" class="block mt-1 w-full border-[#ced4da] rounded-[0.375rem]"
                                name="category">
                                <option disabled selected> Seleccione una categoria </option>

                                @isset($categories)
                                    @foreach ($categories as $category)
                                        @if ($category->category_status)
                                            @if ($category->id == $event->event_category_id &&
                                             $event->event_category_id != null)
                                                <option value="{{ $category->id }}" selected>
                                                    {{ $category->description }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->description }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endisset
                            </select>
                            @error('category')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Modalidad --}}
                        @php
                            $eventModalityId = $event->event_modality_id;
                        @endphp
                        {{-- Modalidad --}}
                        <div class="mb-4">
                            <x-label for="category">Modalidad *</x-label>
                            <select id="modality" class="block mt-1 w-full border-[#ced4da] rounded-[0.375rem]"
                                name="modality">
                                <option disabled selected> Seleccione una modalidad </option>
                                @isset($modalities)
                                    @foreach ($modalities as $modality)
                                        <option value="{{ $modality->id }}" {{ $eventModalityId == $modality->id ? 'selected' : '' }}>
                                            {{ $modality->description }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('modality')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- lugares y meet --}}

                        <div id='places-container' class='mt-2'>

                        </div>
                        {{-- Fecha de Inicio --}}
                        <div class="mb-4">
                            <x-label class="block" for="start-date">Fecha Inicio *</x-label>
                            <x-input class="block" id="start-date" type="date" name="start-date"
                                value="{{ old('start-date', $formatedStartDate) }}" />
                            @error('start-date')
                                <div class="flex items-center">
                                    <p class="text-red-600">* {{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Fecha de Fin --}}
                        <div class="mb-4">
                            <x-label class="block">Fecha Fin *</x-label>
                            <x-input class="block" id="end-date" type="date" name="end-date"
                                value="{{ old('end-date', $formatedEndDate) }}" />
                            @error('end-date')
                                <div class="flex items-center">
                                    <p class="text-red-600">* {{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Limite participantes --}}
                        <input id="hiddenCapacity" hidden value="{{ $event->capacity }}">
                        <div class="mb-4">
                            <fieldset id="participant-limit">
                                <x-label>¿Posee limite de participantes?</x-label>
                                <div>
                                    <input type="radio" id="no-limite-participantes" name="participants-limit"
                                        value="-1" {{ $event->capacity == -1 ? 'checked' : '' }}>
                                    <x-label class="mb-[0]" for="no-limite-participantes">No</x-label>
                                </div>
                                <div>
                                    <input type="radio" id="si-limite-participantes" name="participants-limit"
                                        value="1" {{ $event->capacity != -1 ? 'checked "' : '' }}>
                                    <x-label class="mb-[0]" for="si-limite-participantes">Si</x-label>


                                </div>
                            </fieldset>
                            @error('participants-limit')
                                <div class="flex items-center">
                                    <p class="text-red-600">* {{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Ingresar Numero de Participantes --}}
                        <div id='amount-of-participants-container' class='mt-2'>
                        </div>
                        @error('participants-limit')
                            <div class="flex items-center">
                                <p class="text-red-600">* {{ $message }}</p>
                            </div>
                        @enderror
                        {{-- Requiere preinscripcion --}}
                        <div class="mb-4">
                            <fieldset id="requires-preinscription">
                                <x-label>¿Requiere preinscripcion? *</x-label>
                                <div>
                                    <input type="radio" id="no-preinscription" name="preinscription" value="0"
                                        {{ !$event->pre_registration ? 'checked' : '' }} />
                                    <x-label class="mb-[0]" for="no-preinscripcion">No</x-label>
                                </div>
                                <div>
                                    <input type="radio" id="yes-preinscription" name="preinscription" value="1"
                                        {{ $event->pre_registration ? 'checked' : '' }} />

                                    <x-label class="mb-[0]" for="si-preinscripcion">Si</x-label>
                                </div>
                            </fieldset>
                            @error('participants-limit')
                                <div class="flex items-center">
                                    <p class="text-red-600">* {{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Ingresar preisnscripcion --}}
                        <div class="mb-4">
                            {{-- <input id='hiddenDate' hidden name='preinscription_date' type='date'
                                value="{{ old('preinscription-date', $formatedInscriptionEndDate) }}" /> --}}
                            <div id='preinscription-date-container' class='mt-2'>
                                <x-label for='preinscription-date'> Fecha límite de preinscripción * </x-label>
                                @if($event->pre_registration)
                                    <input id='preinscription-date' value='{{$formatedInscriptionEndDate}}' class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem]' name='preinscription-date' type='date'/>
                                @else
                                    <input id='preinscription-date' value="NULL" class='block border-[1px] border-solid border-[#CED4DA] rounded-[0.25rem] py-[0.375rem] px-[0.75rem] mb-[1rem]' name='preinscription-date' type='date'/>
                                @endif
                            </div>
                            @error('preinscription-date')
                                <div class="flex items-center">
                                    <p class="text-red-600">* {{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Codigo Acreditacion --}}
                        {{-- <div class="mb-4">
                            <x-label for="acreditation-code">Código Acreditación *</x-label>
                            <x-input id="acreditation-code" type="text" name="acreditation-code"
                                placeholder='Ingrese código de acreditación'
                                value="{{ old('acreditation-code', $event->accreditation_token) }}" />
                            @error('acreditation-code')
                                <div class="flex items-center">
                                    <p class="text-red-600">* {{ $message }}</p>
                                </div>
                            @enderror
                        </div> --}}
                        <p class="italic mb-[1rem]">Recordar: Los campos marcados con (*) son obligatorios.</p>
                        {{-- Cargar --}}
                        <x-button class="text-[13px]" type="submit"> Guardar Cambios </x-button>
                    </form>
                </div>
            </div>
        </div>
        </div>

    @else
        <script>
            window.location = "/login";
        </script>
    @endauth
    <x-slot name="pageScripts">
        <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace('description');
        </script>
        <script src="{{ asset('js/shortNameSuggestions.js') }}" defer></script>
    </x-slot>
</x-app-layout>
