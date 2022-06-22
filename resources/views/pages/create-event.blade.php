<x-app-layout>
    {{-- Style for multiselect dropdown --}}
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

  {{-- Create Event Content --}}
  @auth
    <div class="create-event bg-[#0B0D19]">
      <div class="create-event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-[0.25rem] py-[3vh] px-[3vh]">
        <x-pink-header>Cargar Nuevo Evento</x-pink-header>
        <div class="create-event-body bg-[#EFEFEF] p-[1.25rem]">
          <p class="text-center mb-4">Complete los siguientes campos</p>
          <form method="POST" action="{{route('store-event')}}" enctype="multipart/form-data">
            @csrf
            <input hidden value="{{Auth::user()->id}}" id="id">
            {{-- Agregar Coorganizador --}}
            <div class="mb-4">
              <fieldset id="requires-coorganizer">
                <x-label>¿Requiere coorganizador? *</x-label>
                <div>
                  <input type="radio" id="no-coorganizer" name="requires-coorganizer" value="no-coorganizer" checked {{ old('requires-coorganizer') == "no-coorganizer" ? 'checked' : '' }} />
                  <x-label class="mb-[0]" for="no-coorganizer">No</x-label>
                </div>
                <div>
                  <input type="radio" id="yes-coorganizer" name="requires-coorganizer" value="yes-coorganizer" {{ old('requires-coorganizer') == "yes-coorganizer" ? 'checked' : '' }}/>
                  <x-label class="mb-[0]" for="yes-coorganizer">Si</x-label>
                </div>

                <!-- Dropdown multiselect -->
                <select x-cloak id="select">
                    <option value="1">Option 2</option>
                    <option value="2">Option 3</option>
                    <option value="3">Option 4</option>
                    <option value="4">Option 5</option>
                </select>

                <div x-data="dropdown()" x-init="loadOptions()" class="">
                    <input name="values" type="hidden" x-bind:value="selectedValues()">
                    <div class="inline-block relative w-64">
                        <div class="flex flex-col items-center relative">
                            <div x-on:click="open" class="w-full  svelte-1l8159u">
                                <div class="my-2 p-1 flex border border-gray-200 bg-white-ghost rounded svelte-1l8159u">
                                    <div class="flex flex-auto flex-wrap">
                                        <template x-for="(option,index) in selected" :key="options[option].value">
                                            <div
                                                class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white-ghost rounded-full text-teal-700 bg-teal-100 border border-teal-300 ">
                                                <div class="text-xs font-normal leading-none max-w-full flex-initial x-model="
                                                    options[option]" x-text="options[option].text"></div>
                                                <div class="flex flex-auto flex-row-reverse">
                                                    <div x-on:click="remove(index,option)">
                                                        <svg class="fill-current h-6 w-6 " role="button" viewBox="0 0 20 20">
                                                            <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                        c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                        l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                        C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                        </svg>

                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <div x-show="selected.length == 0" class="flex-1">
                                            <input placeholder="Select an option"
                                                class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800"
                                                x-bind:value="selectedValues()"
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                                        <button type="button" x-show="isOpen() === true" x-on:click="open"
                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                            <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                L17.418,6.109z" />
                                            </svg>
                                        </button>

                                        <button type="button" x-show="isOpen() === false" @click="close"
                                            class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                " />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-4">
                                <div x-show.transition.origin.top="isOpen()"
                                    class="absolute shadow top-100 bg-white-ghost z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj"
                                    x-on:click.away="close">
                                    <div class="flex flex-col w-full">
                                        <template x-for="(option,index) in options" :key="option">
                                            <div>
                                                <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100"
                                                    @click="select(index,$event)">
                                                    <div x-bind:class="option.selected ? 'border-teal-600' : ''"
                                                        class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                        <div class="w-full items-center flex">
                                                            <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              </fieldset>
            </div>
            {{-- Ingresar Nombre del Coorganizador --}}
            <div id="" class="mb-4">
              <div id='coorganizer-container' class='mt-2'>
              </div>
              @error('coorganizer')
                <div class="flex items-center">
                  <p class="text-red-600">{{$message}}</p>
                </div>
              @enderror
            </div>

            {{-- Nombre --}}
            <div class="mb-4">
                <x-label for="name">Nombre del evento *</x-label>
                <x-input id='name' class="w-full" type='text' name='name' placeholder="Ingrese Nombre" value="{{old('name')}}"/>
                @error('name')
                    <div class="flex items-center">
                        <p class="text-red-600">{{$message}}</p>
                    </div>
                @enderror
            </div>

            {{-- Nombre Corto --}}
            <div class="mb-4">
                <x-label for="short-name">Nombre corto del evento *</x-label>
                <x-input id="short-name" class="w-full" type="text" name="short-name" placeholder='Ingrese nombre corto' value="{{old('short-name')}}"/>
                @error('short-name')
                    <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            {{-- Descripcion --}}
            <div class="mb-4">
              <x-label for="description">Descripcion *</x-label>
              <textarea id="description" class="block w-full" name="description" rows="10">
                {{old('description')}}
              </textarea>
              @error('description')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>

            {{-- Lugar --}}

            {{-- Categoria --}}
            <div class="mb-4">
              <x-label for="category">Categoria *</x-label>
              <select id="category"  class="block mt-1 w-full border-[#ced4da] rounded-[0.375rem]" name="category">
                <option disabled selected> Seleccione una categoria </option>
                <option value="5" {{ old('category') == 'otra' ? 'selected' : '' }}> Otra </option>
                <option value="1" {{ old('category') == 'seminario' ? 'selected' : '' }}> Seminario </option>
                <option value="2" {{ old('category') == 'congreso' ? 'selected' : '' }}> Congreso </option>
                <option value="3" {{ old('category') == 'diplomatura' ? 'selected' : '' }}> Diplomatura </option>
                <option value="curso" {{ old('category') == 'curso' ? 'selected' : '' }}> Curso </option>
                <option value="4" {{ old('category') == 'taller' ? 'selected' : '' }}> Taller </option>
                <option value="festival" {{ old('category') == 'festival' ? 'selected' : '' }}> Festival </option>
              </select>
              @error('category')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>

            {{-- Modalidad --}}
            <div class="mb-4">
              <x-label for="category">Modalidad *</x-label>
              <select id="modality" class="block mt-1 w-full border-[#ced4da] rounded-[0.375rem]" name="modality">
                <option disabled selected> Seleccione una modalidad </option>
                <option value="4" {{ old('modality') == 'otra' ? 'selected' : '' }}> Otra </option>
                <option value="1" {{ old('modality') == 'presencial' ? 'selected' : '' }}> Presencial </option>
                <option value="2" {{ old('modality') == 'online' ? 'selected' : '' }}> Online </option>
                <option value="3" {{ old('modality') == 'presencial-y-online' ? 'selected' : '' }}> Presencial y Online </option>
              </select>
              @error('modality')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>

            {{-- lugares y meet --}}
            <div id='places-container' class='mt-2'>

            </div>

            {{-- Fecha de Inicio --}}
            <div class="mb-4">
              <x-label class="block" for="start-date">Fecha Inicio *</x-label>
              <x-input class="block" id="start-date" type="date" name="start-date" value="{{old('start-date')}}"/>
              @error('start-date')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>

            {{-- Fecha de Fin --}}
            <div class="mb-4">
              <x-label class="block">Fecha Fin *</x-label>
              <x-input class="block" id="end-date" type="date" name="end-date" value="{{old('end-date')}}"/>
              @error('end-date')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>

            {{-- Logo --}}
            <div class="mb-4">
              <div class="mb-4">
                <x-label for="logo">Ingrese logo [solo formato png, jpg y jpeg]</x-label>
                <input id="logo" class="border-none p-0 block w-full" name="logo" type="file" />
                @error('logo')
                    <div class="flex items-center">
                        <p class="text-red-600">{{$message}}</p>
                    </div>
                @enderror
                <x-button id="remove-logo" class="text-[14px] mt-3" type="button">Quitar</x-button>
              </div>
            </div>

            {{-- Flyer --}}
            <div class="mb-4">
              <div class="mb-4">
                <x-label for="flyer">Ingrese flyer [solo formato png, jpg y jpeg]</x-label>
                <input id="flyer" class="border-none p-0 block w-full" name="flyer" type="file" />
                @error('flyer')
                    <div class="flex items-center">
                        <p class="text-red-600">{{$message}}</p>
                    </div>
                @enderror
                <x-button id="remove-flyer" class="text-[14px] mt-3" type="button">Quitar</x-button>
              </div>
            </div>

            {{-- Limite participantes --}}
            <div class="mb-4">
              <fieldset id="participant-limit">
                <x-label>¿Posee limite de participantes?</x-label>
                <div>
                  <input type="radio" id="no-limite-participantes" name="participants-limit" value="no-limite-participantes" checked {{ old('participants-limit') == "no-limite-participantes" ? 'checked' : '' }}>
                  <x-label class="mb-[0]" for="no-limite-participantes">No</x-label>
                </div>
                <div>
                  <input type="radio" id="si-limite-participantes" name="participants-limit" value="si-limite-participantes" {{ old('participants-limit') == "si-limite-participantes" ? 'checked' : '' }}>
                  <x-label class="mb-[0]" for="si-limite-participantes">Si</x-label>
                </div>
              </fieldset>
              @error('participants-limit')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>

            {{-- Ingresar Numero de Participantes --}}
            <div id='amount-of-participants-container' class='mt-2'>

            </div>
            @error('participants-limit')
                <div class="flex items-center">
                    <p class="text-red-600">{{$message}}</p>
                </div>
            @enderror

            {{-- Requiere preinscripcion --}}
            <div class="mb-4">
              <fieldset id="requires-preinscription">
                <x-label>¿Requiere preinscripcion? *</x-label>
                <div>
                  <input type="radio" id="no-preinscription" name="preinscription" value="0" checked {{ old('preinscription') == "no-preinscription" ? 'checked' : '' }} />
                  <x-label class="mb-[0]" for="no-preinscription">No</x-label>
                </div>
                <div>
                  <input type="radio" id="yes-preinscription" name="preinscription" value="1" {{ old('preinscription') == "yes-preinscription" ? 'checked' : '' }}/>
                  <x-label class="mb-[0]" for="yes-preinscription">Si</x-label>
                </div>
              </fieldset>
            </div>

            {{-- Ingresar Numero de Participantes --}}
            <div class="mb-4">
              <div id='preinscription-date-container' class='mt-2'>

              </div>
              @error('preinscription-date')
                <div class="flex items-center">
                  <p class="text-red-600">{{$message}}</p>
                </div>
              @enderror
            </div>

            {{-- Codigo Acreditacion --}}
            <div class="mb-4">
              <x-label for="acreditation-code">Código Acreditación *</x-label>
              <x-input id="acreditation-code" type="text" name="acreditation-code" placeholder='Ingrese código de acreditación' value="{{old('acreditation-code')}}"/>
              @error('acreditation-code')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>
            <p class="italic mb-[1rem]">Los campos marcados con (*) son obligatorios.</p>

            {{-- Cargar --}}
            <x-button class="text-[16px]" type="submit"> Cargar </x-button>
          </form>
        </div>
      </div>
    </div>
  @else
    <script>window.location = "/login";</script>
  @endauth
  <x-slot name="pageScripts">
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script>CKEDITOR.replace( 'description' );</script>
  </x-slot>
</x-app-layout>
