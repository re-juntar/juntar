@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
<div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
    <!-- Profile Photo File Input -->
    <input id="LimpiarInput{{$iteration}}" name="archivos" type="file" class="mb-3" wire:model="photo" x-ref="photo" x-on:change="                        
                        photoName = $refs.photo.files[0].name;
                        console.log($refs.photo.files[0].name);
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);

                " />

    

    <!-- Current Profile Photo -->
    <div id="oldphoto" class="mt-2" x-show="! photoPreview" wire:model="predeterminada">
        <x-jet-label for="photo" value="{{ __('Flyer actual') }}" />
        <img src="{{ $event->image_flyer}}" alt="{{$event->image_flyer}}"
            class="rounded-full h-20 w-20 object-cover">
    </div>
    
    <!-- New Profile Photo Preview -->
    <div id="newphoto" class="mt-2" x-show="photoPreview" style="display: none;">
        <x-jet-label for="photo" value="{{ __('Flyer nueva') }}" />
        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
        </span>
    </div>

    {{-- <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
        {{ __('Seleccione un nuevo flyer') }}
    </x-jet-secondary-button> --}}

    
    {{-- <x-button id="remove-logo-wire" class="text-[14px] mt-3" type="button" wire:click=limpiar()>Limpiar cambio</x-button> --}}
    <x-button id="remove" class="text-[14px] mt-3" type="button" wire:click=limpiar()>Limpiar cambio</x-button>
    

    <script>
        $(document).ready(function () {
            console.log('asassa');
            $("#remove").on("click", function () {
                $("#newphoto").css('display','none');
                $("#oldphoto").css('display','block');
                console.log('borrar');
            });
            $("input[name='archivos']").on("change", function () {
                console.log("prueba");
                $("#newphoto").css('display','block');
                $("#oldphoto").hide();
            });
        })
    </script>

    <x-jet-input-error for="photo" class="mt-2" />
</div>
@endif