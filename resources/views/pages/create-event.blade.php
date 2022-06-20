<x-app-layout>
  {{-- Create Event Content --}}
  @auth
    <div class="create-event bg-[#0B0D19]">
      <div class="create-event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-[0.25rem] py-[3vh] px-[3vh]">
        <x-pink-header>Cargar Nuevo Evento</x-pink-header>
        <div class="create-event-body bg-[#EFEFEF] p-[1.25rem]">
          <p class="text-center mb-4">Complete los siguientes campos</p>
          <form method="POST" action="{{route('store-event')}}" enctype="multipart/form-data">
            @csrf
            {{-- Nombre --}}
            <div class="mb-4">
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
            <div class="mb-4">
              <x-label for="place">Lugar *</x-label>
              <x-input id="place" class="w-full" type="text" name="place" placeholder='Ingrese lugar' value="{{old('place')}}"/>
              @error('place')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
            </div>
            {{-- Categoria --}}
            <div class="mb-4">
              <x-label for="category">Categoria *</x-label>
              <select id="category"  class="block mt-1 w-full border-[#ced4da] rounded-[0.375rem]" name="category">
                <option disabled selected> Seleccione una categoria </option>
                <option value="otra" {{ old('category') == 'otra' ? 'selected' : '' }}> Otra </option>
                <option value="seminario" {{ old('category') == 'seminario' ? 'selected' : '' }}> Seminario </option>
                <option value="congreso" {{ old('category') == 'congreso' ? 'selected' : '' }}> Congreso </option>
                <option value="diplomatura" {{ old('category') == 'diplomatura' ? 'selected' : '' }}> Diplomatura </option>
                <option value="curso" {{ old('category') == 'curso' ? 'selected' : '' }}> Curso </option>
                <option value="taller" {{ old('category') == 'taller' ? 'selected' : '' }}> Taller </option>
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
                <option value="otra" {{ old('modality') == 'otra' ? 'selected' : '' }}> Otra </option>
                <option value="presencial" {{ old('modality') == 'presencial' ? 'selected' : '' }}> Presencial </option>
                <option value="online" {{ old('modality') == 'online' ? 'selected' : '' }}> Online </option>
                <option value="presencial-y-online" {{ old('modality') == 'presencial-y-online' ? 'selected' : '' }}> Presencial y Online </option>
              </select>
              @error('modality')
                  <div class="flex items-center">
                      <p class="text-red-600">{{$message}}</p>
                  </div>
              @enderror
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
              <fieldset>
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
            {{-- Requiere preinscripcion --}}  
            <div class="mb-4">
              <fieldset>
                <x-label>¿Requiere preinscripcion? *</x-label>
                <div>
                  <input type="radio" id="no-preinscripcion" name="preinscription" value="no-preinscripcion" checked {{ old('preinscription') == "no-preinscripcion" ? 'checked' : '' }}/>
                  <x-label class="mb-[0]" for="no-preinscripcion">No</x-label>
                </div>
                <div>
                  <input type="radio" id="si-preinscripcion" name="preinscription" value="si-preinscripcion" {{ old('preinscription') == "si-preinscripcion" ? 'checked' : '' }}/>
                  <x-label class="mb-[0]" for="si-preinscripcion">Si</x-label>
                </div>
              </fieldset>
              @error('participants-limit')
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