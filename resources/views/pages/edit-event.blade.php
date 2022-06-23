<x-app-layout>
    {{-- Create Event Content --}}
    @auth
        <div class="create-event bg-[#0B0D19]">
            <div
                class="create-event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-[0.25rem] py-[3vh] px-[3vh]">
                <x-pink-header>Editar Evento NOMBRE_EVENTO</x-pink-header>
                <div class="create-event-body bg-[#EFEFEF] p-[1.25rem]">
                    <p class="text-center mb-4">Cambie la informacion que desee y luego aplique los cambios con el boton de
                        "Guardar Cambios" que se encuentra al final del formulario.</p>
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf                        
                        {{ method_field('put') }}
                        <input hidden value="{{ Auth::user()->id }}" id="id">
                        {{-- Agregar Coorganizador --}}
                        <div class="mb-4">
                            <fieldset id="requires-coorganizer">
                                <x-label>¿Requiere coorganizador? *</x-label>
                                <div>
                                    <input type="radio" id="no-coorganizer" name="requires-coorganizer"
                                        value="no-coorganizer" checked
                                        {{ old('requires-coorganizer') == 'no-coorganizer' ? 'checked' : '' }} />
                                    <x-label class="mb-[0]" for="no-coorganizer">No</x-label>
                                </div>
                                <div>
                                    <input type="radio" id="yes-coorganizer" name="requires-coorganizer"
                                        value="yes-coorganizer"
                                        {{ old('requires-coorganizer') == 'yes-coorganizer' ? 'checked' : '' }} />
                                    <x-label class="mb-[0]" for="yes-coorganizer">Si</x-label>
                                </div>

                            </fieldset>
                        </div>
                        {{-- Ingresar Nombre del Coorganizador --}}
                        <div id="" class="mb-4">
                            <div id='coorganizer-container' class='mt-2'>
                            </div>
                            @error('coorganizer')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <!-- <div class="mb-4">
                      <select id='showCoorganizers' multiple="(multiple)" class='block mt-1 w-full border-[#ced4da] rounded-[0.375rem] showCoorganizers' name='showCoorganizers'>
                      </select>
                    </div> -->

                        <!-- <input type="text" list="cars" class="w-full" id="organizers"/> -->

                        {{-- Nombre --}}
                        <p class="text-3xl text-red-600">Falta el event-store para tener la accion de crear evento y
                            create-event para tener lo de los coorganizadores y arreglos no pusheados en dev</p>
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
                        {{-- ver para update --}}
                        @php
                            $category = $event->event_category_id;
                        @endphp
                        <div class="mb-4">
                            <x-label for="category">Categoria *</x-label>
                            <select id="category" class="block mt-1 w-full border-[#ced4da] rounded-[0.375rem]"
                                name="category">
                                <option value='seminario' @if ($category == 1) selected @endif>Seminario
                                </option>
                                <option value='congreso' @if ($category == 2) selected @endif>Congreso</option>
                                <option value='diplomatura' @if ($category == 3) selected @endif>Diplomatura
                                </option>
                                <option value='taller' @if ($category == 4) selected @endif>Taller</option>
                                <option value='otra' @if ($category == 5) selected @endif>Otra</option>
                                {{-- <option disabled selected> Seleccione una categoria </option>
                <option value="otra" {{ old('category') == 'otra' ? 'selected' : '' }}> Otra </option>
                <option value="seminario" {{ old('category') == 'seminario' ? 'selected' : '' }}> Seminario </option>
                <option value="congreso" {{ old('category') == 'congreso' ? 'selected' : '' }}> Congreso </option>
                <option value="diplomatura" {{ old('category') == 'diplomatura' ? 'selected' : '' }}> Diplomatura </option>
                <option value="curso" {{ old('category') == 'curso' ? 'selected' : '' }}> Curso </option>
                <option value="taller" {{ old('category') == 'taller' ? 'selected' : '' }}> Taller </option>
                <option value="festival" {{ old('category') == 'festival' ? 'selected' : '' }}> Festival </option> --}}
                            </select>
                            @error('category')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Modalidad --}}
                        @php
                            $modality = $event->event_modality_id;
                        @endphp
                        <div class="mb-4">
                            <x-label for="category">Modalidad *</x-label>
                            <select id="modality" class="block mt-1 w-full border-[#ced4da] rounded-[0.375rem]"
                                name="modality">
                                {{-- <option disabled selected> Seleccione una modalidad </option> --}}
                                <option value='1' @if ($modality == 1) selected @endif>Presencial</option>
                                <option value='2' @if ($modality == 2) selected @endif>Online
                                </option>
                                <option value='3' @if ($modality == 3) selected @endif>Presencial y Online</option>
                                <option value='otra' @if ($modality == 4) selected @endif>
                                    otra</option>
                                {{-- <option value="otra" {{ old('modality') == 'otra' ? 'selected' : '' }}> Otra </option>
                 <option value="presencial" {{ old('modality') == 'presencial' ? 'selected' : '' }}> Presencial </option>
                <option value="online" {{ old('modality') == 'online' ? 'selected' : '' }}> Online </option>
                <option value="presencial-y-online" {{ old('modality') == 'presencial-y-online' ? 'selected' : '' }}> Presencial y Online </option> --}}
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
                                value="{{ old('start-date', $event->start_date) }}" />
                            @error('start-date')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Fecha de Fin --}}
                        <div class="mb-4">
                            <x-label class="block">Fecha Fin *</x-label>
                            <x-input class="block" id="end-date" type="date" name="end-date"
                                value="{{ old('end-date', $event->end_date) }}" />
                            @error('end-date')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Logo --}}
                        <div class="mb-4">
                            <div class="mb-4">
                                <x-label for="logo">Ingrese logo [solo formato png, jpg y jpeg]</x-label>
                                @livewire('limpiar-input', ['img' => $event->image_logo, 'tipo' => "logo"] )                                
                                @error('logo')
                                    <div class="flex items-center">
                                        <p class="text-red-600">{{ $message }}</p>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Flyer --}}
                        <div class="mb-4">
                            <div class="mb-4">
                                <x-label for="flyer">Ingrese flyer [solo formato png, jpg y jpeg]</x-label>
                                
                                {{-- <input id="flyer" class="border-none p-0 block w-full" name="flyer" type="file"
                                    value="{{ $event->image_flyer }}" /> --}}
                                    @livewire('limpiar-input', ['img' => $event->image_flyer , 'tipo' => "flyer" ])
                                @error('flyer')
                                    <div class="flex items-center">
                                        <p class="text-red-600">{{ $message }}</p>
                                    </div>
                                @enderror

                            </div>
                        </div>
                        {{-- Limite participantes --}}
                        <div class="mb-4">
                            <fieldset  id="participant-limit">
                                <x-label>¿Posee limite de participantes?</x-label>
                                <div>
                                    <input type="radio" id="no-limite-participantes" name="participants-limit"
                                        value="no-limite-participantes" {{ $event->capacity == null ? 'checked' : '' }}>
                                    <x-label class="mb-[0]" for="no-limite-participantes">No</x-label>
                                </div>
                                <div>
                                    <input type="radio" id="si-limite-participantes" name="participants-limit"
                                        value="si-limite-participantes" {{ $event->capacity != null ? 'checked' : '' }}>
                                    <x-label class="mb-[0]" for="si-limite-participantes">Si</x-label>
                                </div>
                            </fieldset>
                            @error('participants-limit')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- </div> --}}
                        {{-- Ingresar Numero de Participantes --}}
                        <div id='amount-of-participants-container' class='mt-2'>

                        </div>
                        @error('participants-limit')
                            <div class="flex items-center">
                                <p class="text-red-600">{{ $message }}</p>
                            </div>
                        @enderror
                        {{-- Requiere preinscripcion --}}
                        <div class="mb-4">
                            <fieldset id="requires-preinscription">
                                <x-label>¿Requiere preinscripcion? *</x-label>
                                <div>
                                    <input type="radio" id="no-preinscription" name="preinscription"
                                        value="no-preinscripcion" {{ !$event->pre_registration ? 'checked' : '' }} />
                                    <x-label class="mb-[0]" for="no-preinscripcion">No</x-label>
                                </div>
                                <div>
                                    <input type="radio" id="yes-preinscription" name="preinscription"
                                        value="si-preinscripcion " {{ $event->pre_registration ? 'checked' : '' }} />

                                    <x-label class="mb-[0]" for="si-preinscripcion">Si</x-label>
                                </div>
                            </fieldset>
                            @error('participants-limit')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Ingresar preisnscripcion --}}
                        <div class="mb-4">
                            <div id='preinscription-date-container' class='mt-2'>

                            </div>
                            @error('preinscription-date')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        {{-- Codigo Acreditacion --}}
                        <div class="mb-4">
                            <x-label for="acreditation-code">Código Acreditación *</x-label>
                            <x-input id="acreditation-code" type="text" name="acreditation-code" placeholder='Ingrese código de acreditación' value="{{old('acreditation-code', $event->accreditation_token)}}"/>
                            @error('acreditation-code')
                                <div class="flex items-center">
                                    <p class="text-red-600">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <p class="italic mb-[1rem]">Recordar: Los campos marcados con (*) son obligatorios.</p>
                        {{-- Cargar --}}
                        <x-button class="text-[16px]" type="submit"> Guardar Cambios </x-button>
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

            {{-- SElect2 --}}
    </x-slot>
</x-app-layout>
