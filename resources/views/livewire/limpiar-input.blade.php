@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
<div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
    <!-- Profile Photo File Input -->
    <input id="LimpiarInput{{$iteration}}" name="archivos{{$tipo}}" type="file" class="mb-3" wire:model="photo" x-ref="photo" x-on:change="                        
                        photoName = $refs.photo.files[0].name;
                        console.log($refs.photo.files[0].name);
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.photo.files[0]);

                " />

    

    <!-- Current Profile Photo -->
    <div id="oldphoto{{$tipo}}" class="mt-2" x-show="! photoPreview" wire:model="predeterminada">
        <x-label>{{$tipo}} nuevo</x-label>

        <img src="{{ $img}}" alt="{{$img}}"
            class="rounded-full h-20 w-20 object-cover">
    </div>
    
    <!-- New Profile Photo Preview -->
    <div id="newphoto{{$tipo}}" class="mt-2" x-show="photoPreview" style="display: none;">
        <x-label>{{$tipo}} nuevo</x-label>
        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
        </span>
    </div>

    {{-- <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
        {{ __('Seleccione un nuevo flyer') }}
    </x-jet-secondary-button> --}}


    {{-- <x-button id="remove-logo-wire" class="text-[14px] mt-3" type="button" wire:click=limpiar()>Limpiar cambio</x-button> --}}
    <x-button id="remove{{$tipo}}" class="text-[13px] mt-3 " type="button" wire:click=limpiar()>Limpiar cambio</x-button>
    <script>
         $(document).ready(function () {

            $("#removelogo").on("click", function () {

                 $("#newphotologo").css('display','none');
                 $("#oldphotologo").css('display','block');
                
             });
             $("input[name='archivoslogo']").on("change", function () {

                 $("#newphotologo").css('display','block');
                 $("#oldphotologo").hide();
             });


             $("#removeflyer").on("click", function () {

                 $("#newphotoflyer").css('display','none');
                 $("#oldphotoflyer").css('display','block');

             });
             $("input[name='archivosflyer']").on("change", function () {

                 $("#newphotoflyer").css('display','block');
                 $("#oldphotoflyer").hide();
             });



         })
    </script>

    <x-jet-input-error for="photo" class="mt-2" />
</div>
@endif