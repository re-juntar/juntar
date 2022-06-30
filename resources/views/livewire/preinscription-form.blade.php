<div class="bg-[#0B0D19]">
    <div class="max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-lg py-[3vh] px-[3vh]">
        <x-pink-header>Formulario de preinscripción</x-pink-header>
        <div class="bg-white-ghost p-5">
            @foreach($inputs as $input)
                {{ $input['type']}}
            @endforeach
        </div>
    </div>
</div>