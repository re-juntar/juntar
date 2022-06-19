<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
        <x-jet-button class="bg-awesome uppercase text-lg text-white-ghost hover:bg-fogra-dark">Empezar</x-jet-button>
    </x-hero>

    <section class="bg-fogra-darkish w-full">
        @livewire('search-sort-form')
    </section>

    <section class="pt-16 pb-5 px-4 bg-fogra-dark">
        <div class="mx-auto infinite-scr">
            @foreach ($response as $event)
                <x-card id="{{ $event->id }}" class="grid-item mb-4 md:mx-2 w-[300px]">
                    {{-- <button class="bg-fogra-darkish text-white-ghost absolute top-2 right-2 rounded-full p-3 font-black">...</button> --}}
                    @livewire('event-card-desktop', ['event' => $event])
                    <div class="flex items-center bg-fogra-darkish rounded-lg mt-1">
                        <img class="w-10 h-10 rounded-full mr-2" src="{{asset('images/logos/logo-uncoma-w.svg')}}">
                        <div class="font-bold text-xl uppercase text-white-ghost">
                            Nombre Apellido
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    </section>

    <x-slot name="gridScripts">
        <script src="{{asset('js/masonry.pkgd.js')}}"></script>
        <script src="{{asset('js/infinite-scroll.pkgd.js')}}"></script>
        <script>
            var msnry = new Masonry( '.infinite-scr', {
                itemSelector: ".grid-item",
                horizontalOrder: true,
                fitWidth: true
            });
            let infScroll = new InfiniteScroll( '.infinite-scr', {
                path: "http://juntar.test/home?page=@{{#}}",
                append: '.grid-item',
                history: false,
                outlayer: msnry
            });
        </script>
    </x-slot>
    
</x-app-layout>
