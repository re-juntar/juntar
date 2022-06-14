<div>
    <h2 class="mb-[1rem]">Equipo Programación Web Avanzada - 2020 (Juntar v1) </h2>
    <hr class="my-[1rem]">
    <div class="flex flex-wrap w-full gap-4">
        @foreach ($params as $dev)
            
        <x-about-us-card>
            <x-slot name='nombre' class="text-6xl">{{$dev['nombre']}}</x-slot>
            <x-slot name='descripcion'>{{$dev['descripcion']}}</x-slot>
            <x-slot name='link'>{{$dev['link']}}</x-slot>
        </x-about-us-card>
        @endforeach
        
    </div>
</div>
