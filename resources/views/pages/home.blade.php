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
                    @php
                        $src = $event['image_flyer'];
                        if($event['image_flyer'] == null){
                            $src = 'images/public/event-card-placeholder.png';
                        }
                    @endphp
                    <img class="rounded-lg" src="{{ asset($src) }}" alt="">
                </x-card>
            @endforeach
        </div>
        <div class="text-center">
            <x-button class="more">
                {{ __("Cargar más...")}}
            </x-button>
        </div>
    </section>

    <x-slot name="pageScripts">
        <script src="{{asset('vendor/masonry.pkgd.js')}}"></script>
        <script src="{{asset('vendor/infinite-scroll.pkgd.js')}}"></script>
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
                scrollThreshold: false,
                button: ".more",
                outlayer: msnry
            });
        </script>
    </x-slot>
    
</x-app-layout>
